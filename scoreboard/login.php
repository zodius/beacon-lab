<?php
session_start();
require_once 'db.php';

// 取得資料庫實例
$db = Database::getInstance();

// 處理 POST 請求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $rememberMe = isset($_POST['rememberMe']);
    
    // 驗證輸入
    if (empty($username) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => '請輸入使用者名稱和密碼'
        ]);
        exit;
    }
    
    // 驗證長度
    if (strlen($username) < 3 || strlen($username) > 20) {
        echo json_encode([
            'success' => false,
            'message' => '使用者名稱長度必須在 3-20 個字元之間'
        ]);
        exit;
    }
    
    if (strlen($password) < 4) {
        echo json_encode([
            'success' => false,
            'message' => '密碼長度至少需要 4 個字元'
        ]);
        exit;
    }
    
    // 檢查使用者是否存在
    $user = $db->getUser($username);
    
    if ($user) {
        // 使用者存在 - 驗證密碼（明文比對）
        if ($password === $user['password']) {
            // 登入成功
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['login_time'] = time();
            
            // 更新最後登入時間
            $db->updateLastLogin($user['id']);
            
            echo json_encode([
                'success' => true,
                'message' => '歡迎回來，' . htmlspecialchars($username) . '！',
                'redirect' => 'index.php'
            ]);
        } else {
            // 密碼錯誤
            echo json_encode([
                'success' => false,
                'message' => '密碼錯誤，請重試'
            ]);
        }
    } else {
        // 使用者不存在 - 自動註冊
        $user_id = $db->createUser($username, $password);
        
        if ($user_id) {
            // 設定 session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['login_time'] = time();
            
            echo json_encode([
                'success' => true,
                'message' => '歡迎參賽，' . htmlspecialchars($username) . '！',
                'redirect' => 'index.php'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => '註冊失敗，請稍後再試'
            ]);
        }
    }
    
    exit;
}

// 如果已登入，直接跳轉
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wow C2 - 登入</title>
    
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* 背景動畫效果 */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0, 255, 65, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveGrid 20s linear infinite;
            z-index: 0;
        }

        @keyframes moveGrid {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(50px, 50px);
            }
        }

        .login-container {
            position: relative;
            z-index: 1;
            max-width: 450px;
            width: 100%;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-color);
            margin-bottom: 10px;
            text-shadow: 0 0 40px rgba(0, 255, 65, 0.6), 0 0 20px rgba(0, 255, 65, 0.4);
            filter: drop-shadow(0 0 10px rgba(0, 255, 65, 0.8));
        }

        .login-header p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin: 0;
        }

        .login-card {
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            animation: borderScan 3s linear infinite;
        }

        @keyframes borderScan {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

        .form-label {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: var(--primary-color);
        }

        .form-control {
            background: rgba(13, 17, 23, 0.6);
            border: 2px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(13, 17, 23, 0.8);
            border-color: var(--primary-color);
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.2);
            color: var(--text-primary);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            background: rgba(13, 17, 23, 0.6);
            border: 2px solid var(--border-color);
            border-right: none;
            color: var(--primary-color);
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color), #00cc33);
            border: none;
            border-radius: 8px;
            color: var(--dark-bg);
            font-size: 1.1rem;
            font-weight: 700;
            padding: 14px;
            margin-top: 20px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0, 255, 65, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 255, 65, 0.5);
            filter: brightness(1.1);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .form-check {
            margin-top: 15px;
        }

        .form-check-input {
            background-color: rgba(13, 17, 23, 0.6);
            border: 2px solid var(--border-color);
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 255, 65, 0.25);
        }

        .form-check-label {
            color: var(--text-secondary);
            cursor: pointer;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: var(--text-secondary);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }

        .divider span {
            padding: 0 15px;
            font-size: 0.9rem;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .register-link p {
            color: var(--text-secondary);
            margin: 0;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            color: #00cc33;
            text-shadow: 0 0 10px rgba(0, 255, 65, 0.5);
        }

        .alert {
            border: none;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: rgba(255, 0, 110, 0.2);
            color: #ff6b9d;
            border-left: 4px solid var(--accent-color);
        }

        .alert-success {
            background: rgba(0, 255, 65, 0.2);
            color: var(--primary-color);
            border-left: 4px solid var(--primary-color);
        }

        .social-login {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-social {
            flex: 1;
            padding: 10px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background: rgba(13, 17, 23, 0.6);
            color: var(--text-primary);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-social:hover {
            border-color: var(--primary-color);
            background: rgba(0, 255, 65, 0.1);
        }

        .btn-social i {
            font-size: 1.2rem;
        }

        @media (max-width: 576px) {
            .login-header h1 {
                font-size: 2rem;
            }

            .login-card {
                padding: 25px;
            }

            .btn-login {
                font-size: 1rem;
                padding: 12px;
            }
        }

        .loading {
            display: none;
            text-align: center;
            margin-top: 10px;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(0, 255, 65, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <h1><i class="fas fa-shield-halved"></i> WOW C2</h1>
            <p>Capture The Flag Challenge</p>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <!-- Alert Messages (Hidden by default) -->
            <div id="alertBox" style="display: none;"></div>

            <form id="loginForm" method="POST" action="">
                <!-- Username Field -->
                <div class="mb-3">
                    <label for="username" class="form-label">
                        <i class="fas fa-user"></i> 使用者名稱
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </span>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="username" 
                            name="username" 
                            placeholder="設定您的使用者名稱" 
                            required
                            autocomplete="username"
                        >
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> 密碼
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-key"></i>
                        </span>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="password" 
                            name="password" 
                            placeholder="設定您的密碼" 
                            required
                            autocomplete="current-password"
                        >
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        記住我
                    </label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i> 進入比賽
                </button>

                <!-- Loading Indicator -->
                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <span style="margin-left: 10px; color: var(--primary-color);">處理中...</span>
                </div>
            </form>

            <!-- Info Text -->
            <div class="register-link">
                <p style="color: var(--text-secondary); font-size: 0.9rem;">
                    <i class="fas fa-info-circle"></i> 輸入使用者名稱與密碼即可開始比賽
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // 處理表單提交
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                // 顯示載入中
                $('#loading').show();
                $('.btn-login').prop('disabled', true);
                
                // 取得表單資料
                const formData = {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    rememberMe: $('#rememberMe').is(':checked')
                };

                // 實際使用時請取消註解，並調整後端 API
                $.ajax({
                    url: 'login.php',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showAlert('success', response.message || '驗證成功！正在進入比賽...');
                            setTimeout(function() {
                                window.location.href = response.redirect || 'index.php';
                            }, 1500);
                        } else {
                            showAlert('danger', response.message || '驗證失敗，請重試');
                            $('#loading').hide();
                            $('.btn-login').prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        showAlert('danger', '發生錯誤，請稍後再試');
                        $('#loading').hide();
                        $('.btn-login').prop('disabled', false);
                    }
                });
                

                // 模擬登入過程（開發測試用 - 實際使用時請刪除此段）
                /*
                setTimeout(function() {
                    if (formData.username && formData.password) {
                        showAlert('success', '驗證成功！正在進入比賽...');
                        setTimeout(function() {
                            window.location.href = 'scoreboard.php';
                        }, 1500);
                    } else {
                        showAlert('danger', '請輸入使用者名稱和密碼');
                        $('#loading').hide();
                        $('.btn-login').prop('disabled', false);
                    }
                }, 1000);
                */
            });

            // 顯示提示訊息
            function showAlert(type, message) {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
                
                $('#alertBox').html(`
                    <div class="alert ${alertClass}">
                        <i class="fas ${icon}"></i> ${message}
                    </div>
                `).fadeIn();

                if (type === 'danger') {
                    setTimeout(function() {
                        $('#alertBox').fadeOut();
                    }, 5000);
                }
            }

            // Enter 鍵提交表單
            $('#username, #password').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#loginForm').submit();
                }
            });
        });
    </script>
</body>
</html>
