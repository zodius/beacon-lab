<?php
/**
 * 資料庫操作類別
 * 使用 SQLite 避免 race condition
 */
class Database {
    private static $instance = null;
    private $db;
    private $db_file = 'ctf.db';
    
    private function __construct() {
        try {
            $this->db = new SQLite3($this->db_file);
            $this->db->busyTimeout(5000); // 設定 5 秒 busy timeout 避免鎖定問題
            $this->initDatabase();
        } catch (Exception $e) {
            die('資料庫連線失敗: ' . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function initDatabase() {
        // 建立使用者資料表
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS users (
                uid TEXT PRIMARY KEY NOT NULL,
                username TEXT UNIQUE NOT NULL,
                password TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                last_login DATETIME
            )
        ");
        
        // 建立徽章資料表
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS badges (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_uid TEXT NOT NULL,
                name TEXT NOT NULL,
                icon TEXT NOT NULL,
                earned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_uid) REFERENCES users(uid) ON DELETE CASCADE,
                UNIQUE(user_uid, name)
            )
        ");
        
        // 建立索引以提升查詢效能
        $this->db->exec("CREATE INDEX IF NOT EXISTS idx_badges_user_uid ON badges(user_uid)");
        $this->db->exec("CREATE INDEX IF NOT EXISTS idx_users_username ON users(username)");
    }
    
    /**
     * 取得使用者資料（包含徽章）
     */
    public function getUser($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindValue(1, $username, SQLITE3_TEXT);
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);
        
        if ($user) {
            // 取得該使用者的徽章
            $user['badges'] = $this->getUserBadges($user['uid']);
        }
        
        return $user;
    }
    
    /**
     * 取得使用者資料（依 UID）
     */
    public function getUserByUid($uid) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE uid = ?");
        $stmt->bindValue(1, $uid, SQLITE3_TEXT);
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);
        
        if ($user) {
            $user['badges'] = $this->getUserBadges($user['uid']);
        }
        
        return $user;
    }
    
    /**
     * 取得使用者的徽章
     */
    public function getUserBadges($uid) {
        $stmt = $this->db->prepare("
            SELECT name, icon, earned_at 
            FROM badges 
            WHERE user_uid = ? 
            ORDER BY earned_at ASC
        ");
        $stmt->bindValue(1, $uid, SQLITE3_TEXT);
        $result = $stmt->execute();
        
        $badges = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $badges[] = $row;
        }
        
        return $badges;
    }
    
    /**
     * 建立新使用者
     */
    public function createUser($username, $password) {
        try {
            // 生成 16 byte (32 字元) 的 hex UID
            $uid = bin2hex(random_bytes(16));
            
            $stmt = $this->db->prepare("
                INSERT INTO users (uid, username, password, created_at, last_login) 
                VALUES (?, ?, ?, datetime('now'), datetime('now'))
            ");
            $stmt->bindValue(1, $uid, SQLITE3_TEXT);
            $stmt->bindValue(2, $username, SQLITE3_TEXT);
            $stmt->bindValue(3, $password, SQLITE3_TEXT);
            
            if ($stmt->execute()) {
                return $uid;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * 更新最後登入時間
     */
    public function updateLastLogin($uid) {
        $stmt = $this->db->prepare("UPDATE users SET last_login = datetime('now') WHERE uid = ?");
        $stmt->bindValue(1, $uid, SQLITE3_TEXT);
        return $stmt->execute();
    }
    
    /**
     * 新增徽章給使用者（避免重複）
     */
    public function addBadge($uid, $badge_name, $badge_icon) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO badges (user_uid, name, icon) 
                VALUES (?, ?, ?)
            ");
            $stmt->bindValue(1, $uid, SQLITE3_TEXT);
            $stmt->bindValue(2, $badge_name, SQLITE3_TEXT);
            $stmt->bindValue(3, $badge_icon, SQLITE3_TEXT);
            
            return $stmt->execute();
        } catch (Exception $e) {
            return false; // 已有此徽章或其他錯誤
        }
    }
    
    /**
     * 檢查使用者是否已有此徽章
     */
    public function hasBadge($uid, $badge_name) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count FROM badges 
            WHERE user_uid = ? AND name = ?
        ");
        $stmt->bindValue(1, $uid, SQLITE3_TEXT);
        $stmt->bindValue(2, $badge_name, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        return $row['count'] > 0;
    }
    
    /**
     * 取得所有使用者排行榜（依徽章數量排序）
     */
    public function getScoreboard() {
        $result = $this->db->query("
            SELECT 
                u.uid,
                u.username,
                u.created_at,
                u.last_login,
                COUNT(b.id) as badge_count
            FROM users u
            LEFT JOIN badges b ON u.uid = b.user_uid
            GROUP BY u.uid
            ORDER BY badge_count DESC, u.username ASC
        ");
        
        $users = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $row['badges'] = $this->getUserBadges($row['uid']);
            $users[] = $row;
        }
        
        return $users;
    }
    
    /**
     * 取得徽章總數統計
     */
    public function getBadgeStats() {
        $result = $this->db->query("
            SELECT 
                name,
                icon,
                COUNT(*) as count
            FROM badges
            GROUP BY name, icon
            ORDER BY count DESC
        ");
        
        $stats = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $stats[] = $row;
        }
        
        return $stats;
    }
}

