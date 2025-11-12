<?php
// 定義題目資料
$challenges = [
    [
        'id' => 1,
        'title' => 'Challenge 1 - HTTP',
        'badge' => 'HTTP Beacon',
        'badge_icon' => 'fa-database',
        'description' => '將使用者 ID 放在 User-Agent 標頭向伺服器取得 shellcode，於本地執行後，將執行結果提交到 flag.php?flag=<result>。提交時記得 flag.php 也要附帶相同的 User-Agent。',
        'url' => 'http://http.zodius.cc'
    ],
    [
        'id' => 2,
        'title' => 'Challenge 2 - TCP',
        'badge' => 'TCP Beacon',
        'badge_icon' => 'fa-network-wired',
        'description' => '透過客製化封包格式與 C2 進行通訊；封包欄位定義與流程請參考講義。請正確依規格打包/解析封包並完成任務回傳。',
        'url' => 'tcp://tcp.zodius.cc:9002'
    ],
    [
        'id' => 3,
        'title' => 'Challenge 3 - Babyshark',
        'badge' => 'Translate Beacon',
        'badge_icon' => 'fa-language',
        'description' => '使用 Google Translate 的網站「翻譯網頁」功能讀取指定 URL 以取得 shellcode，請在請求中設置 User-Agent（包含你的使用者 ID）。取得結果後，需透過翻譯回傳通道將結果送回 index.php?flag=<...>。',
        'url' => 'http://translate.zodius.cc'
    ]
];
?>