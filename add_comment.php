<?php
session_start();

require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $news_id = $_POST['news_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    
    $stmt = $pdo->prepare("INSERT INTO comments (user_id, news_id, comment) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $news_id, $comment]);

    header("Location: single-news.php?id=" . $news_id);
    exit();
}
?>
