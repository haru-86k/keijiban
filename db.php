<?php
$host = 'localhost';
$dbname = 'ガンダム'; // データベース名
$username = 'root';
$password = ''; // XAMPPのデフォルトは空白

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
