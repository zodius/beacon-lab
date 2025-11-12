<?php
// 定義題目資料
$challenges = [
    [
        'id' => 1,
        'title' => 'Challenge 1 - HTTP',
        'badge' => 'HTTP Beacon',
        'badge_icon' => 'fa-database',
        'description' => 'HTTP Beacon 是一個基本的 C2 通訊挑戰。您的目標是利用 HTTP 協議與 C2 伺服器進行通訊，並成功接收指令和回傳資料。請確保您的請求格式正確，並能處理伺服器的回應。',
        'url' => 'http://http.zodius.cc'
    ],
    [
        'id' => 2,
        'title' => 'Challenge 2 - TCP',
        'badge' => 'TCP Beacon',
        'badge_icon' => 'fa-network-wired',
        'description' => 'TCP Beacon 挑戰要求您建立一個能夠與 C2 伺服器進行 TCP 通訊的客戶端。您需要處理低層次的網路連接，並確保資料能夠正確地傳送和接收。這個挑戰將測試您對 TCP 協議的理解以及網路編程的能力。',
        'url' => 'tcp://tcp.zodius.cc:9002'
    ],
    [
        'id' => 3,
        'title' => 'Challenge 3 - Google Translate C2',
        'badge' => 'Translate Beacon',
        'badge_icon' => 'fa-language',
        'description' => '在這個挑戰中，您需要利用 Google Translate API 作為 C2 通訊的媒介。您的任務是設計一個系統，能夠通過翻譯請求來隱藏與 C2 伺服器的通訊。這將測試您對 API 整合和資料編碼的能力。',
        'url' => 'http://translate.zodius.cc'
    ]
];
?>