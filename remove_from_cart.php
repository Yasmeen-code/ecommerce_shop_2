<?php

header('Content-Type: application/json');

require_once('includes/db.php');

if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'error' => 'No ID sent']);
    exit;
}

$id = $_POST['id'];
$stmt = $pdo->prepare("DELETE FROM cart_items WHERE id = ?");
if ($stmt->execute([$id])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to delete item']);
}
?>
