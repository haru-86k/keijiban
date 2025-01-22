<?php
session_start(); // セッション開始

// ログインしていない場合はログインページへリダイレクト
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// ログアウト処理
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: admin_login.php");
    exit;
}

// ここでDB接続やデータの取得を行う部分を記述します（例として）
include 'db.php';

// お問い合わせデータ取得
try {
    $contacts = $pdo->query("SELECT * FROM contacts ORDER BY date DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("お問い合わせデータの取得に失敗しました: " . $e->getMessage());
}

// 質問データ取得
try {
    $questions = $pdo->query("SELECT * FROM questions ORDER BY date DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("質問データの取得に失敗しました: " . $e->getMessage());
}

// お問い合わせ削除処理
if (isset($_POST['delete_contact'])) {
    $contact_id = (int)$_POST['contact_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
        $stmt->execute([':id' => $contact_id]);
        header("Location: admin_dashboard.php");
        exit;
    } catch (PDOException $e) {
        die("お問い合わせの削除に失敗しました: " . $e->getMessage());
    }
}

// 質問削除処理
if (isset($_POST['delete_question'])) {
    $question_id = (int)$_POST['question_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM questions WHERE id = :id");
        $stmt->execute([':id' => $question_id]);
        header("Location: admin_dashboard.php");
        exit;
    } catch (PDOException $e) {
        die("質問の削除に失敗しました: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ダッシュボード</title>
</head>
<body>
    <h2>管理者ダッシュボード</h2>

    <p>ようこそ、<?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>さん！</p>

    <!-- ログアウトボタン -->
    <form action="admin_dashboard.php" method="post">
        <button type="submit" name="logout">ログアウト</button>
    </form>

    <!-- お問い合わせ内容の表示 -->
    <h3>お問い合わせ内容</h3>
    <?php if (count($contacts) > 0): ?>
        <?php foreach ($contacts as $contact): ?>
            <div>
                <p><strong>名前:</strong> <?= htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>メールアドレス:</strong> <?= htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>メッセージ:</strong><br><?= nl2br(htmlspecialchars($contact['message'], ENT_QUOTES, 'UTF-8')); ?></p>
                <p><strong>投稿日:</strong> <?= htmlspecialchars($contact['date'], ENT_QUOTES, 'UTF-8'); ?></p>
                <form action="admin_dashboard.php" method="post">
                    <input type="hidden" name="contact_id" value="<?= $contact['id']; ?>">
                    <button type="submit" name="delete_contact">削除</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>現在、お問い合わせはありません。</p>
    <?php endif; ?>

    <!-- 質問コーナーの表示 -->
    <h3>質問コーナー</h3>
    <?php if (count($questions) > 0): ?>
        <?php foreach ($questions as $question): ?>
            <div>
                <p><strong>作品名:</strong> <?= htmlspecialchars($question['work_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>質問内容:</strong><br><?= nl2br(htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8')); ?></p>
                <p><strong>投稿日時:</strong> <?= htmlspecialchars($question['date'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php if ($question['reply']): ?>
                    <p><strong>返答:</strong><br><?= nl2br(htmlspecialchars($question['reply'], ENT_QUOTES, 'UTF-8')); ?></p>
                <?php else: ?>
                    <p><strong>返答なし</strong></p>
                <?php endif; ?>
                <form action="admin_dashboard.php" method="post">
                    <input type="hidden" name="question_id" value="<?= $question['id']; ?>">
                    <button type="submit" name="delete_question">削除</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>現在、質問はありません。</p>
    <?php endif; ?>
</body>
</html>
