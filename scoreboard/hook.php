<?php
require_once 'db.php';

// API endpoint for badge submission
$API_KEY = $_ENV['API_KEY'] ?? '';
if ($API_KEY === '') {
    http_response_code(500);
    echo "API key not configured.";
    exit;
}

$provided_key = $_SERVER['HTTP_X_API_KEY'] ?? '';
if ($provided_key !== $API_KEY) {
    http_response_code(403);
    echo "Forbidden: Invalid API key.";
    exit;
}

$challenge = $_POST['challenge'] ?? '';
$userid = $_POST['userid'] ?? '';

// insert badge into scoreboard
$db = Database::getInstance();
$user = $db->getUserByUid($userid);
if (!$user) {
    http_response_code(400);
    echo "Invalid user ID.";
    exit;
}

$db->addBadge($userid, $challenge, 'fa-star');
http_response_code(200);
?>