<?php
include 'db.php';

// 質問投稿処理
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question'], $_POST['work_name'])) {
    $work_name = htmlspecialchars($_POST['work_name'], ENT_QUOTES, 'UTF-8');
    $question = htmlspecialchars($_POST['question'], ENT_QUOTES, 'UTF-8');
    $date = date("Y-m-d H:i:s");

    $stmt = $pdo->prepare("INSERT INTO questions (work_name, question, date) VALUES (:work_name, :question, :date)");
    $stmt->execute([':work_name' => $work_name, ':question' => $question, ':date' => $date]);

    header("Location: question.php");
    exit;
}

// 返答投稿処理
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply'], $_POST['question_id'])) {
    $reply = htmlspecialchars($_POST['reply'], ENT_QUOTES, 'UTF-8');
    $question_id = (int)$_POST['question_id'];
    $date = date("Y-m-d H:i:s");

    $stmt = $pdo->prepare("UPDATE questions SET reply = :reply, reply_date = :reply_date WHERE id = :id");
    $stmt->execute([':reply' => $reply, ':reply_date' => $date, ':id' => $question_id]);

    header("Location: question.php");
    exit;
}

// 質問データ取得
$questions = $pdo->query("SELECT * FROM questions ORDER BY date DESC")->fetchAll(PDO::FETCH_ASSOC);

include('header.php');
?>

<link rel="stylesheet" href="style.css">

<main>
    <h2>質問コーナー</h2>

    <!-- 質問を投稿するフォーム -->
    <section>
        <h3>質問を投稿する</h3>
        <form action="question.php" method="post">
            <label for="work_name">作品名:</label>
            <select id="work_name" name="work_name" required>
                <option value="機動戦士ガンダム">機動戦士ガンダム</option>
                <option value="機動戦士ガンダムZ">機動戦士ガンダムZ</option>
                <option value="機動戦士ガンダムΖΖ">機動戦士ガンダムΖΖ</option>
                <option value="機動戦士ガンダム 逆襲のシャア">機動戦士ガンダム 逆襲のシャア</option>
                <option value="機動戦士ガンダム0080 ポケットの中の戦争">機動戦士ガンダム0080 ポケットの中の戦争</option>
                <option value="機動戦士ガンダム0083 STARDUST MEMORY">機動戦士ガンダム0083 STARDUST MEMORY</option>
                <option value="機動戦士ガンダムF91">機動戦士ガンダムF91</option>
                <option value="機動戦士Vガンダム">機動戦士Vガンダム</option>
                <option value="機動武闘伝Gガンダム">機動武闘伝Gガンダム</option>
                <option value="新機動戦記ガンダムW">新機動戦記ガンダムW</option>
                <option value="機動戦士ガンダム 第08MS小隊">機動戦士ガンダム 第08MS小隊</option>
                <option value="機動新世紀ガンダムX">機動新世紀ガンダムX</option>
                <option value="∀ガンダム">∀ガンダム</option>
                <option value="機動戦士ガンダム SEED">機動戦士ガンダム SEED</option>
                <option value="機動戦士ガンダム MS IGLOO">機動戦士ガンダム MS IGLOO</option>
                <option value="機動戦士ガンダムOO">機動戦士ガンダムOO</option>
                <option value="機動戦士ガンダムAGE">機動戦士ガンダムAGE</option>
                <option value="ガンダムビルドファイターズ">ガンダムビルドファイターズ</option>
                <option value="Gのレコンギスタ">Gのレコンギスタ</option>
                <option value="機動戦士ガンダム THE ORIGIN">機動戦士ガンダム THE ORIGIN</option>
                <option value="機動戦士ガンダム 鉄血のオルフェンズ">機動戦士ガンダム 鉄血のオルフェンズ</option>
                <option value="機動戦士ガンダム サンダーボルト">機動戦士ガンダム サンダーボルト</option>
                <option value="機動戦士ガンダムUC RE:0096">機動戦士ガンダムUC RE:0096</option>
                <option value="機動戦士ガンダム 水星の魔女">機動戦士ガンダム 水星の魔女</option>
            </select>
            <label for="question">質問内容:</label>
            <textarea id="question" name="question" required></textarea><br>
            <button type="submit">投稿</button>
        </form>
    </section>

    <!-- 質問とその返答を表示 -->
    <section>
        <h3>投稿された質問と返答</h3>
        <?php foreach ($questions as $q): ?>
            <p><strong>作品名: <?= htmlspecialchars($q['work_name'], ENT_QUOTES, 'UTF-8') ?></strong></p>
            <p>質問: <?= htmlspecialchars($q['question'], ENT_QUOTES, 'UTF-8') ?> (<?= $q['date'] ?>)</p>
            <p>
                <?= $q['reply'] ? "返答: " . htmlspecialchars($q['reply'], ENT_QUOTES, 'UTF-8') . " (" . $q['reply_date'] . ")" : "返答なし" ?>
            </p>
            <?php if (!$q['reply']): ?>
                <form action="question.php" method="post">
                    <input type="hidden" name="question_id" value="<?= $q['id'] ?>">
                    <label for="reply">返答:</label>
                    <textarea id="reply" name="reply" required></textarea><br>
                    <button type="submit">返答する</button>
                </form>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>
</main>

<footer>
    <p>&copy; 2025 Gundam掲示板. All rights reserved.</p>
</footer>
