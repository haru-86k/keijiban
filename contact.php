<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ - ガンダム掲示板</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>お問い合わせ</h2>
        <form action="send_contact.php" method="post">
            <label for="name">名前:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="message">お問い合わせ内容:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
            
            <button type="submit">送信</button>
        </form>
        <div class="footer">&copy; 2025 Gundam掲示板. All rights reserved.</div>
    </div>
</body>
</html>
