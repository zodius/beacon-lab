<?php 
session_start();
require_once 'db.php';
require_once 'challenges.php';

// 檢查是否登入
if (!isset($_SESSION['user_uid'])) {
    header('Location: login.php');
    exit;
}

// 取得資料庫實例
$db = Database::getInstance();

// 取得所有玩家資料（已按徽章數量排序）
$players_data = $db->getScoreboard();
$current_username = $_SESSION['username'] ?? '訪客';

// 定義挑戰總數
$total_challenges = count($challenges);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wow C2</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #00ff41;
            --secondary-color: #0a0e27;
            --accent-color: #ff006e;
            --dark-bg: #0d1117;
            --card-bg: #161b22;
            --text-primary: #c9d1d9;
            --text-secondary: #8b949e;
            --border-color: #30363d;
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--secondary-color) 100%);
            font-family: 'Roboto', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
            padding: 20px 0;
        }

        .header-section {
            text-align: center;
            padding: 40px 0;
            margin-bottom: 30px;
            background: rgba(22, 27, 34, 0.6);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
        }

        .header-section h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--primary-color);
            margin-bottom: 10px;
            text-shadow: 0 0 40px rgba(0, 255, 65, 0.6), 0 0 20px rgba(0, 255, 65, 0.4);
            filter: drop-shadow(0 0 10px rgba(0, 255, 65, 0.8));
        }

        .header-section p {
            color: var(--text-secondary);
            font-size: 1.2rem;
        }

        .scoreboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .rank-card {
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 20px;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .rank-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
            box-shadow: 0 10px 30px rgba(0, 255, 65, 0.2);
        }

        .rank-card.rank-1 {
            border-color: #ffd700;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, var(--card-bg) 100%);
        }

        .rank-card.rank-2 {
            border-color: #c0c0c0;
            background: linear-gradient(135deg, rgba(192, 192, 192, 0.1) 0%, var(--card-bg) 100%);
        }

        .rank-card.rank-3 {
            border-color: #cd7f32;
            background: linear-gradient(135deg, rgba(205, 127, 50, 0.1) 0%, var(--card-bg) 100%);
        }

        .rank-number {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            min-width: 80px;
            text-align: center;
        }

        .rank-1 .rank-number {
            color: #ffd700;
            text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
        }

        .rank-2 .rank-number {
            color: #c0c0c0;
            text-shadow: 0 0 20px rgba(192, 192, 192, 0.5);
        }

        .rank-3 .rank-number {
            color: #cd7f32;
            text-shadow: 0 0 20px rgba(205, 127, 50, 0.5);
        }

        .player-info {
            display: flex;
            align-items: center;
            gap: 30px;
            flex: 1;
        }

        .player-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            min-width: 200px;
            white-space: nowrap;
        }

        .badges-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 10px;
            flex: 1;
        }

        .badge-item {
            background: linear-gradient(135deg, var(--primary-color), #00cc33);
            color: var(--secondary-color);
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(0, 255, 65, 0.3);
            white-space: nowrap;
            text-align: center;
            min-height: 32px;
        }

        .badge-count {
            background: linear-gradient(135deg, #667eea, #764ba2);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            color: white;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            padding: 10px 25px;
            border-radius: 50px;
            min-width: 100px;
            text-align: center;
        }

        .trophy-icon {
            font-size: 2rem;
            min-width: 40px;
            text-align: center;
        }

        .rank-1 .trophy-icon {
            color: #ffd700;
        }

        .rank-2 .trophy-icon {
            color: #c0c0c0;
        }

        .rank-3 .trophy-icon {
            color: #cd7f32;
        }

        .rank-section {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 140px;
        }

        .stats-bar {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .last-update {
            text-align: center;
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 30px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 2rem;
            }

            .rank-card {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .rank-number {
                text-align: center;
            }

            .player-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .player-name {
                min-width: auto;
                text-align: center;
                width: 100%;
            }

            .badges-container {
                width: 100%;
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .badge-count {
                margin: 0 auto;
            }
        }

        .loading {
            text-align: center;
            padding: 50px;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .nav-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }

        .btn-nav {
            background: linear-gradient(135deg, #00d4aa, #00a8cc);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 212, 170, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 212, 170, 0.5);
            filter: brightness(1.1);
            color: white;
        }

        .logout-btn {
            background: linear-gradient(135deg, var(--accent-color), #cc0055);
            box-shadow: 0 4px 15px rgba(255, 0, 110, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 0, 110, 0.5);
            filter: brightness(1.1);
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        .user-info {
            position: fixed;
            top: 20px;
            left: 20px;
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 20px;
            color: var(--text-primary);
            font-weight: 600;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info i {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .nav-buttons, .user-info {
                position: relative;
                top: auto;
                right: auto;
                left: auto;
                margin: 10px auto;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- User Info -->
    <div class="user-info">
        <i class="fas fa-user-shield"></i>
        <span id="currentUser">訪客</span>
    </div>

    <!-- Navigation Buttons -->
    <div class="nav-buttons">
        <a href="index.php" class="btn-nav">
            <i class="fas fa-list"></i>
            <span>題目列表</span>
        </a>
        <button class="btn-nav logout-btn" id="logoutBtn">
            <i class="fas fa-sign-out-alt"></i>
            <span>登出</span>
        </button>
    </div>

    <div class="container scoreboard-container">
        <!-- Header Section -->
        <div class="header-section">
            <h1><i class="fas fa-flag-checkered"></i>WOW C2</h1>
            <p>Capture The Flag Challenge</p>
        </div>

        <!-- Statistics Bar -->
        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-value" id="totalPlayers">0</div>
                <div class="stat-label">參賽者</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="totalBadges">0</div>
                <div class="stat-label">已獲得徽章</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="totalChallenges">0</div>
                <div class="stat-label">挑戰總數</div>
            </div>
        </div>

        <!-- Loading State -->
        <div id="loading" class="loading pulse">
            <i class="fas fa-spinner fa-spin"></i> 載入排行榜中...
        </div>

        <!-- Scoreboard List -->
        <div id="scoreboardList"></div>

        <!-- Last Update Time -->
        <div class="last-update">
            <i class="far fa-clock"></i> 最後更新: <span id="lastUpdate">-</span>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // 從 PHP 獲取真實資料
        const scoreboardData = {
            players: <?php echo json_encode($players_data, JSON_UNESCAPED_UNICODE); ?>,
            totalChallenges: <?php echo $total_challenges; ?>
        };

        // 初始化頁面
        function initScoreboard() {
            // 顯示載入中
            $('#loading').show();
            $('#scoreboardList').hide();

            // 載入資料
            setTimeout(() => {
                loadScoreboardData(scoreboardData);
            }, 300);
        }

        // 載入排行榜資料
        function loadScoreboardData(data) {
            // 按照 badge 數量排序
            const sortedPlayers = data.players.sort((a, b) => b.badges.length - a.badges.length);

            // 計算統計資料
            const totalPlayers = sortedPlayers.length;
            const totalBadges = sortedPlayers.reduce((sum, player) => sum + player.badges.length, 0);
            const totalChallenges = data.totalChallenges;

            // 更新統計資料
            animateValue('totalPlayers', 0, totalPlayers, 1000);
            animateValue('totalBadges', 0, totalBadges, 1000);
            animateValue('totalChallenges', 0, totalChallenges, 1000);

            // 生成排行榜 HTML
            let html = '';
            sortedPlayers.forEach((player, index) => {
                const rank = index + 1;
                const rankClass = rank <= 3 ? `rank-${rank}` : '';
                const trophyIcon = rank === 1 ? '<i class="fas fa-trophy trophy-icon"></i>' :
                                 rank === 2 ? '<i class="fas fa-medal trophy-icon"></i>' :
                                 rank === 3 ? '<i class="fas fa-award trophy-icon"></i>' : 
                                 '<span class="trophy-icon"></span>'; // 為其他排名保留空白空間

                const badgesHtml = player.badges.map(badge => 
                    `<span class="badge-item">
                        <i class="fas ${badge.icon}"></i> ${badge.name}
                    </span>`
                ).join('');

                html += `
                    <div class="rank-card ${rankClass}">
                        <div class="rank-section">
                            ${trophyIcon}
                            <div class="rank-number">#${rank}</div>
                        </div>
                        <div class="player-info">
                            <div class="player-name">
                                <i class="fas fa-user-shield"></i> ${player.username}
                            </div>
                            <div class="badges-container">
                                ${badgesHtml}
                            </div>
                        </div>
                        <div class="badge-count">
                            ${player.badges.length}
                        </div>
                    </div>
                `;
            });

            $('#scoreboardList').html(html);
            $('#loading').hide();
            $('#scoreboardList').fadeIn();

            // 更新時間
            updateLastUpdateTime();
        }

        // 數字動畫效果
        function animateValue(id, start, end, duration) {
            const element = document.getElementById(id);
            const range = end - start;
            const increment = range / (duration / 16);
            let current = start;

            const timer = setInterval(() => {
                current += increment;
                if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                    current = end;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 16);
        }

        // 更新最後更新時間
        function updateLastUpdateTime() {
            const now = new Date();
            const timeString = now.toLocaleString('zh-TW', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            $('#lastUpdate').text(timeString);
        }

        // 自動重新整理 (每 30 秒)
        function startAutoRefresh() {
            setInterval(() => {
                // 實際使用時，這裡應該是從 API 獲取最新資料
                // $.ajax({ url: '/api/scoreboard', method: 'GET', success: loadScoreboardData });
                loadScoreboardData(mockData);
            }, 30000);
        }

        // 頁面載入完成後初始化
        $(document).ready(function() {
            initScoreboard();
            // startAutoRefresh(); // 取消註解以啟用自動重新整理
            
            // 設定當前使用者名稱
            const username = '<?php echo htmlspecialchars($current_username); ?>';
            $('#currentUser').text(username);
            
            // 登出按鈕事件
            $('#logoutBtn').on('click', function() {
                if (confirm('確定要登出嗎？')) {
                    window.location.href = 'logout.php';
                }
            });
        });
    </script>
</body>
</html>
