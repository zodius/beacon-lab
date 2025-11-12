<?php
session_start();
require_once 'db.php';

// 檢查是否登入
if (!isset($_SESSION['user_uid'])) {
    header('Location: login.php');
    exit;
}

$current_username = $_SESSION['username'] ?? '訪客';
$user_uid = $_SESSION['user_uid'];

// 取得資料庫實例
$db = Database::getInstance();

// 取得使用者已獲得的徽章
$user_badges = $db->getUserBadges($user_uid);

// 載入題目資料
require_once 'challenges.php';

// 計算已完成的題目數量
$completed_badges = array_column($user_badges, 'name');
$completed_count = 0;
foreach ($challenges as $challenge) {
    if (in_array($challenge['badge'], $completed_badges)) {
        $completed_count++;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wow C2 - 挑戰題目</title>
    
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

        .main-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .user-info {
            position: fixed;
            top: 20px;
            left: 20px;
            background: var(--card-bg);
            border: 2px solid var(--primary-color);
            border-radius: 12px;
            padding: 15px 25px;
            color: var(--text-primary);
            font-weight: 600;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 4px 20px rgba(0, 255, 65, 0.3);
            backdrop-filter: blur(10px);
            max-width: 400px;
        }

        .user-info i {
            color: var(--primary-color);
        }

        .user-info-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info-label {
            color: var(--text-secondary);
            font-size: 0.85rem;
            min-width: 45px;
        }

        .user-info-value {
            color: var(--text-primary);
            font-size: 1rem;
        }

        .uid-display {
            background: rgba(0, 255, 65, 0.1);
            border: 1px solid var(--primary-color);
            border-radius: 6px;
            padding: 8px 12px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            color: var(--primary-color);
            word-break: break-all;
            letter-spacing: 0.5px;
            text-shadow: 0 0 10px rgba(0, 255, 65, 0.3);
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

        .btn-logout {
            background: linear-gradient(135deg, var(--accent-color), #cc0055);
            box-shadow: 0 4px 15px rgba(255, 0, 110, 0.3);
        }

        .btn-logout:hover {
            box-shadow: 0 6px 20px rgba(255, 0, 110, 0.5);
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

        .challenges-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .challenge-card {
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .challenge-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
            box-shadow: 0 10px 30px rgba(0, 255, 65, 0.2);
        }

        .challenge-card.completed {
            border-color: var(--primary-color);
            background: linear-gradient(135deg, rgba(0, 255, 65, 0.05) 0%, var(--card-bg) 100%);
        }

        .challenge-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            gap: 15px;
        }

        .challenge-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-primary);
            flex: 1;
        }

        .challenge-badge-preview {
            background: linear-gradient(135deg, var(--primary-color), #00cc33);
            color: var(--secondary-color);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(0, 255, 65, 0.3);
            white-space: nowrap;
        }

        .challenge-card.completed .challenge-badge-preview {
            opacity: 0.6;
        }

        .challenge-description {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .challenge-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
        }

        .completed-badge {
            background: linear-gradient(135deg, var(--primary-color), #00cc33);
            color: var(--dark-bg);
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .badge-reward {
            margin-top: 20px;
            padding: 20px;
            background: rgba(0, 212, 170, 0.1);
            border-left: 4px solid #00d4aa;
            border-radius: 5px;
        }

        .badge-reward-title {
            color: #00d4aa;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-preview-large {
            background: linear-gradient(135deg, var(--primary-color), #00cc33);
            color: var(--secondary-color);
            padding: 12px 24px;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(0, 255, 65, 0.4);
        }

        .badge-preview-large i {
            font-size: 1.3rem;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: var(--card-bg);
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            margin: 5% auto;
            padding: 40px;
            max-width: 700px;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 255, 65, 0.3);
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 2rem;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            color: var(--accent-color);
            transform: rotate(90deg);
        }

        .modal-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .modal-info {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .modal-description {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .challenge-url {
            background: rgba(0, 255, 65, 0.1);
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .challenge-url a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            word-break: break-all;
        }

        .challenge-url a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 2rem;
            }

            .challenges-grid {
                grid-template-columns: 1fr;
            }

            .user-info, .nav-buttons {
                position: relative;
                top: auto;
                left: auto;
                right: auto;
                margin: 10px auto;
                justify-content: center;
            }

            .modal-content {
                margin: 10% 5%;
                padding: 25px;
            }

            .challenge-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .challenge-badge-preview {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- User Info -->
    <div class="user-info">
        <div class="user-info-row">
            <i class="fas fa-user-shield"></i>
            <span class="user-info-label">使用者:</span>
            <span class="user-info-value"><?php echo htmlspecialchars($current_username); ?></span>
        </div>
        <div class="user-info-row">
            <i class="fas fa-fingerprint"></i>
            <span class="user-info-label">UID:</span>
        </div>
        <div class="uid-display"><?php echo htmlspecialchars($user_uid); ?></div>
    </div>

    <!-- Navigation Buttons -->
    <div class="nav-buttons">
        <a href="scoreboard.php" class="btn-nav">
            <i class="fas fa-trophy"></i>
            <span>排行榜</span>
        </a>
        <button class="btn-nav btn-logout" onclick="logout()">
            <i class="fas fa-sign-out-alt"></i>
            <span>登出</span>
        </button>
    </div>

    <div class="container main-container">
        <!-- Header Section -->
        <div class="header-section">
            <h1><i class="fas fa-flag-checkered"></i> WOW C2</h1>
            <p>Capture The Flag Challenge</p>
        </div>

        <!-- Statistics Bar -->
        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-value"><?php echo $completed_count; ?></div>
                <div class="stat-label">已完成</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo count($challenges); ?></div>
                <div class="stat-label">題目總數</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo count($user_badges); ?></div>
                <div class="stat-label">獲得徽章</div>
            </div>
        </div>

        <!-- Challenges Grid -->
        <div class="challenges-grid">
            <?php foreach ($challenges as $challenge): ?>
                <?php $is_completed = in_array($challenge['badge'], $completed_badges); ?>
                <div class="challenge-card <?php echo $is_completed ? 'completed' : ''; ?>" 
                     onclick='showChallenge(<?php echo json_encode($challenge, JSON_UNESCAPED_UNICODE); ?>)'>
                    <div class="challenge-header">
                        <div class="challenge-title">
                            <?php echo htmlspecialchars($challenge['title']); ?>
                        </div>
                        <div class="challenge-badge-preview">
                            <i class="fas <?php echo htmlspecialchars($challenge['badge_icon']); ?>"></i>
                            <?php echo htmlspecialchars($challenge['badge']); ?>
                        </div>
                    </div>
                    
                    <div class="challenge-description">
                        <?php echo htmlspecialchars($challenge['description']); ?>
                    </div>
                    
                    <?php if ($is_completed): ?>
                    <div class="challenge-footer">
                        <div class="completed-badge">
                            <i class="fas fa-check-circle"></i> 已完成
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Challenge Detail Modal -->
    <div id="challengeModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div id="modalBody"></div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function showChallenge(challenge) {
            let urlSection = '';
            if (challenge.url) {
                urlSection = `
                    <div class="challenge-url">
                        <i class="fas fa-link"></i> C2位置: 
                        <a href="${challenge.url}" target="_blank">${challenge.url}</a>
                    </div>
                `;
            }
            
            const modalContent = `
                <div class="modal-title">${challenge.title}</div>
                <div class="modal-description">
                    ${challenge.description}
                </div>
                ${urlSection}
                <div class="badge-reward">
                    <div class="badge-reward-title">
                        <i class="fas fa-trophy"></i> 完成後獲得徽章
                    </div>
                    <div class="badge-preview-large">
                        <i class="fas ${challenge.badge_icon}"></i>
                        ${challenge.badge}
                    </div>
                </div>
            `;
            
            document.getElementById('modalBody').innerHTML = modalContent;
            document.getElementById('challengeModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('challengeModal').style.display = 'none';
        }

        function logout() {
            if (confirm('確定要登出嗎？')) {
                window.location.href = 'logout.php';
            }
        }

        // 點擊模態框外部關閉
        window.onclick = function(event) {
            const modal = document.getElementById('challengeModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // ESC 鍵關閉模態框
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>