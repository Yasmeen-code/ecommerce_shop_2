<?php
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$name     = $_POST['name'];
$email    = $_POST['email'];
$address  = $_POST['address'];
$phone    = $_POST['phone'];
$notes    = $_POST['notes'];
$total    = $_POST['total_price'];
$shipping = $_POST['shipping'];

$stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price, shipping, name, email, address, phone, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$user_id, $total, $shipping, $name, $email, $address, $phone, $notes]);
$order_id = $pdo->lastInsertId();

$stmt = $pdo->prepare("
    SELECT ci.*, p.price
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.id
    WHERE ci.user_id = ?
");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll();

$insertItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
foreach ($items as $item) {
    $insertItem->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
}

$pdo->prepare("DELETE FROM cart_items WHERE user_id = ?")->execute([$user_id]);

header("Location: index.php");
exit;
