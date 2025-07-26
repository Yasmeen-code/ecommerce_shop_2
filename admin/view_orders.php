<?php
require_once('../includes/db.php');

if (isset($_POST['delete_order'])) {
    $orderId = $_POST['delete_order'];

    $stmt = $pdo->prepare("DELETE FROM order_items WHERE order_id = ?");
    $stmt->execute([$orderId]);

    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$orderId]);

    echo "<p style='color: green;'>✅ Order deleted successfully.</p>";
}

$search = $_GET['search'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM orders WHERE name LIKE :search OR email LIKE :search ORDER BY created_at DESC");
$stmt->execute(['search' => "%$search%"]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        h2 {
            color: #333;
        }
        .order {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #fff;
        }
        .order h3 {
            margin-top: 0;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .info {
            margin-bottom: 10px;
        }
        form.search-form {
            margin-bottom: 20px;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
    </style>
</head>
<body>

<h2>All Orders</h2>

<form method="get" class="search-form">
    <input type="text" name="search" placeholder="Search by name or email" value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>

<?php
if ($orders):
    foreach ($orders as $order):
?>
    <div class="order">
        <form method="post" onsubmit="return confirm('Are you sure you want to delete this order?');">
            <input type="hidden" name="delete_order" value="<?= $order['id'] ?>">
            <button type="submit" class="delete-btn">🗑 Delete</button>
        </form>

        <h3>Order ID: <?= $order['id'] ?></h3>
        <div class="info">
            <strong>Name:</strong> <?= htmlspecialchars($order['name']) ?><br>
            <strong>Email:</strong> <?= htmlspecialchars($order['email']) ?><br>
            <strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?><br>
            <strong>Address:</strong> <?= htmlspecialchars($order['address']) ?><br>
            <strong>Shipping:</strong> <?= htmlspecialchars($order['shipping']) ?><br>
            <strong>Total Price:</strong> <?= htmlspecialchars($order['total_price']) ?><br>
            <strong>Notes:</strong> <?= nl2br(htmlspecialchars($order['notes'])) ?><br>
            <strong>Date:</strong> <?= htmlspecialchars($order['created_at']) ?>
        </div>

        <?php
            $stmt_items = $pdo->prepare("
                SELECT oi.*, p.name AS product_name 
                FROM order_items oi 
                JOIN products p ON oi.product_id = p.id 
                WHERE oi.order_id = ?
            ");
            $stmt_items->execute([$order['id']]);
            $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

            if ($items):
        ?>
            <table>
                <tr><th>Product</th><th>Quantity</th><th>Price</th></tr>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['price'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No items for this order.</p>
        <?php endif; ?>
    </div>
<?php
    endforeach;
else:
    echo "<p>No orders found.</p>";
endif;
?>

</body>
</html>
