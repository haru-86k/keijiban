<?php
// db.php: データベース接続設定

$servername = "localhost";
$username = "root";  // XAMPPのデフォルト設定
$password = "";      // XAMPPのデフォルト設定（パスワードなし）
$dbname = "gundam_board";  // 作成したデータベース名

// MySQL接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}
?>
