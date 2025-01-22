<?php
// board.php

// 質問がPOSTされている場合に処理
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question'])) {
    // フォームからのデータ取得
    $question = $_POST['question'];
    $name = $_POST['name']; // 質問者名を取得

    // 質問をテキストファイルに保存
    $file = 'questions.txt'; // 質問を保存するファイル
    $date = date("Y-m-d H:i:s"); // 投稿日時を記録

    // 質問をファイルに追加（改行を加えて追加）
    $content = "質問者: $name\n質問: $question\n投稿日: $date\n\n";
    file_put_contents($file, $content, FILE_APPEND);

    echo "質問が投稿されました！";
}
?>

<?php include('header.php'); ?>

<main>
    <h2>質問コーナー</h2>
    
    <!-- 質問を投稿するフォーム -->
    <section>
        <h3>質問を投稿する</h3>
        <form action="board.php" method="post">
            <label for="name">名前:</label>
            <input type="text" id="name" name="name" required><br>
            
            <label for="question">質問内容:</label>
            <textarea id="question" name="question" required></textarea><br>
            <button type="submit">投稿</button>
        </form>
    </section>
    
    <!-- 質問一覧を表示するセクション -->
    <section>
        <h3>質問一覧</h3>
        <?php
        // 質問をファイルから読み込んで表示
        $file = 'questions.txt';

        if (file_exists($file)) {
            $questions = file_get_contents($file);
            if (!empty($questions)) {
                // 質問があれば表示
                echo nl2br($questions); // 改行をHTMLの<br>タグに変換
            } else {
                echo "<p>投稿された質問はありません。</p>";
            }
        } else {
            echo "<p>投稿された質問はありません。</p>";
        }
        ?>
    </section>
</main>

<?php include('footer.php'); ?>
