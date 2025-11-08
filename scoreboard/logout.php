<?php
session_start();

// 清除所有 session 資料
$_SESSION = array();

// 刪除 session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// 銷毀 session
session_destroy();

// 重新導向到登入頁面
header('Location: login.php');
exit;
?>
