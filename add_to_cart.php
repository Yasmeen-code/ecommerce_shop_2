<?php
session_start();
require_once 'includes/db.php';

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($product_id <= 0 || $quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product_id or quantity.']);
        exit;
    }

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'You must be logged in.']);
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    $item = $stmt->fetch();

    if ($item) {
        $updateStmt = $pdo->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE id = ?");
        $updateStmt->execute([$quantity, $item['id']]);
    } else {
        $insertStmt = $pdo->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insertStmt->execute([$user_id, $product_id, $quantity]);
    }

    echo json_encode(['success' => true, 'message' => 'Item added to cart.']);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid Request: Missing product_id.']);
    exit;
}
