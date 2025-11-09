<?php
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $flag = $_GET['flag'] ?? '';
    // check if user agent only contains hex characters and length is 32
    if (preg_match('/^[0-9a-fA-F]{32}$/', $user_agent) && $flag) {
        $user_id = strtolower($user_agent);
        // verify flag via redis
        $redis = new Redis();
        $redis->connect('redis', 6379);
        $stored_flag = $redis->get("shellcode:http:$user_id");
        if ($stored_flag && $stored_flag === $flag) {
            echo "<h1>Congratulations!</h1>";
        } else {
            echo "<h1>Incorrect flag.</h1>";
        }
    } else {
        // redirect to home
        header('Location: /');
        exit;
    }
?>