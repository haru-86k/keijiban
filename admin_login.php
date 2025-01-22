<?php
session_start(); // セッション開始

// ログインしている場合は管理者ダッシュボードにリダイレクト
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: admin_dashboard.php");
    exit;
}

// ログインフォームが送信された場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 管理者のユーザー名とパスワードを設定（これはデモのため固定ですが、実際にはDBから取得します）
    $admin_username = 'admin';  // 管理者のユーザー名
    $admin_password = 'password';  // 管理者のパスワード（平文でも問題ない場合もありますが、実際の運用ではハッシュ化してください）

    // フォームから送信されたユーザー名とパスワードを取得
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ユーザー名とパスワードの検証
    if ($username === $admin_username && $password === $admin_password) {
        // ログイン成功: セッションにユーザー情報を保存
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        // ダッシュボードへリダイレクト
        header("Location: admin_dashboard.php");
        exit;
    } else {
        // ログイン失敗: エラーメッセージを表示
        $error_message = "ユーザー名またはパスワードが間違っています。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ログイン</title>
</head>
<body>
    <h2>管理者ログイン</h2>

    <!-- ログインフォーム -->
<form action="admin_login.php" method="post">
    <div>
        <label for="username">ユーザー名:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit">ログイン</button>
    </div>
</form>

<!-- ホームに戻るボタン -->
<form action="index.php" method="get">
    <button type="submit">ホームに戻る</button>
</form>


    <?php
    // エラーメッセージの表示
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

</body>
</html>
