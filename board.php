<?php
// db.phpファイルをインクルードしてデータベース接続
include('db.php');  // データベース接続

// フォームがPOSTされた場合、データを保存する
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question'])) {
    // フォームからのデータ取得
    $question = $_POST['question'];

    // データベースに保存
    $sql = "INSERT INTO questions (question) VALUES ('$question')";
    
    if ($conn->query($sql) === TRUE) {
        echo "質問が投稿されました！";
    } else {
        echo "エラー: " . $conn->error;
    }
}
?>

<?php include('header.php'); ?>

<main>
    <h2>質問コーナー</h2>
    
    <!-- 質問を投稿するフォーム -->
    <section>
        <h3>質問を投稿する</h3>
        <form action="board.php" method="post">
            <label for="question">質問内容:</label>
            <textarea id="question" name="question" required></textarea><br>
            <button type="submit">投稿</button>
        </form>
    </section>
    
    <!-- 質問一覧を表示するセクション（仮にデータベースから取得） -->
    <section>
        <h3>質問一覧</h3>
        <?php
        // 質問一覧をデータベースから取得して表示
        $result = $conn->query("SELECT * FROM questions ORDER BY created_at DESC");

        if ($result->num_rows > 0) {
            // 各質問を表示
            while($row = $result->fetch_assoc()) {
                echo "<p><strong>質問: </strong>" . htmlspecialchars($row['question']) . "</p>";
            }
        } else {
            echo "<p>投稿された質問はありません。</p>";
        }
        ?>
    </section>
</main>

<?php include('footer.php'); ?>
