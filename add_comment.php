<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $news_id = $_POST['news_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    // لو اليوزر مسجل دخوله ناخد ID بتاعه
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // إدخال التعليق في قاعدة البيانات
    $stmt = $pdo->prepare("INSERT INTO comments (user_id, news_id, comment) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $news_id, $comment]);

    // بعد الإدخال نرجع لصفحة الخبر (ممكن تعملي redirect للصفحة الصح)
    header("Location: single-news.php?id=" . $news_id);
    exit();
}
?>
