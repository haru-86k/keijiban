<?php include('header.php'); ?>

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

<?php include('footer.php'); ?>
