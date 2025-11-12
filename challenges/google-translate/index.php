<?php
    // const
    $valid_host = $_ENV['VALID_HOST'] ?? '';

    // args
    $via = $_SERVER['HTTP_VIA'] ?? '';
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $host = $_SERVER['HTTP_HOST'] ?? '';

    $is_agent = false;

    if (strpos($via, "translate.google.com") !== false &&
        strpos($host, $valid_host) !== false &&
        // check 32 byte hex characters is in user agent
        preg_match('/[a-f0-9]{32}/', $ua, $matches) === 1) {
        $is_agent = true;
        // extract the 32 byte hex characters
        $agent_id = $matches[0];
    }

    $is_submit = isset($_GET['flag']);
    if ($is_agent && $is_submit) {
        $flag = $_GET['flag'];
        // perform some basic validation to avoid DoS
        if (strlen($flag) !== 32 || !preg_match('/^[0-9a-fA-F]{32}$/', $flag)) {
            echo "<h1>Invalid flag format.</h1>";
            exit;
        }
        $redis = new Redis();
        $redis->connect('redis', 6379);
        $stored_flag = $redis->get("shellcode:googletranslate:$agent_id");
        if ($stored_flag && $stored_flag === $flag) {
            // call scoreboard API to submit flag
            $api_key = $_ENV['API_KEY'] ?? '';
            if ($api_key) {
                $ch = curl_init('http://scoreboard/hook.php');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                    'userid' => $agent_id,
                    'challenge' => 'Translate Beacon',
                ]));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'X-API-KEY: ' . $api_key
                ]);
                curl_exec($ch);
                curl_close($ch);
            }
        }
    } else if ($is_agent) {
        // get shellcode
        $ch = curl_init('http://shellcode:5000/generate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['userid' => $agent_id, 'challenge' => 'googletranslate']));
        $shellcode = curl_exec($ch);
        curl_close($ch);
    }
?>

<?php if ($is_agent && $is_submit): ?>
    <?php if ($stored_flag && $stored_flag === $flag): ?>
        <h1>Congratulations!</h1>
    <?php else: ?>
        <h1>Incorrect flag.</h1>
    <?php endif; ?>
    <a href="/google-translate/">Go back</a>
    <?php exit; ?>
<?php elseif ($is_agent): ?>
    <h1>Welcome, Google Translate Beacon!</h1>
    <p>Shellcode: <?php echo htmlspecialchars($shellcode); ?></p>
<?php else: ?>
    <h1>Access Denied</h1>
    <p>This page is only accessible via Google Translate.</p>
<?php endif; ?>