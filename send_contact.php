<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
    $date = date("Y-m-d H:i:s");

    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message, date) VALUES (:name, :email, :message, :date)");
    $stmt->execute([':name' => $name, ':email' => $email, ':message' => $message, ':date' => $date]);

    echo "<p>お問い合わせを受け付けました。</p>";
} else {
    echo "<p>フォームに入力されたデータが不足しています。</p>";
}
?>
