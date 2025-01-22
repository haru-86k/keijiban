<header>
        <h1>ガンダムアニメ作品掲示板</h1>
        <nav>
            <ul>
                <li><a href="index.php">ホーム</a></li>
                <li><a href="question.php">作品についての質問コーナー</a></li>
            </ul>
        </nav>
<main>
    <h2>お問い合わせ</h2>
    <form action="send_contact.php" method="post">
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="message">お問い合わせ内容:</label>
        <textarea id="message" name="message" required></textarea><br>
        
        <button type="submit">送信</button>
    </form>
</main>
<p>&copy; 2025 Gundam掲示板. All rights reserved.</p>
