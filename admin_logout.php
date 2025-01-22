<?php
session_start(); // セッション開始

// セッションを破棄
session_unset();
session_destroy();

// ログイン画面にリダイレクト
header('Location: index.php');
exit();