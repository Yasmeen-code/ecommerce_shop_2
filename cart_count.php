<?php
session_start();
require_once 'includes/db.php';

header('Content-Type: application/json'); 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['count' => 0]);
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT SUM(quantity) AS total FROM cart_items WHERE user_id = ?");
$stmt->execute([$user_id]);
$row = $stmt->fetch();

$count = $row['total'] ?? 0;
echo json_encode(['count' => $count]);
