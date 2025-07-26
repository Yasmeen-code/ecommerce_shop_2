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
    <title>📋 View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f6f9fc;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 230px;
            background-color: #2d3436;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.2);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
            color: #fdcb6e;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 12px 20px;
            border-bottom: 1px solid #444;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            font-size: 15px;
        }

        .sidebar ul li:hover {
            background-color: #636e72;
        }

        .sidebar ul li a:hover {
            color: #ffeaa7;
        }

        .main-content {
            margin-left: 230px;
            padding: 30px;
            width: calc(100% - 230px);
        }

        h2 {
            color: #2d3436;
            margin-bottom: 20px;
        }

        .order {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .order h3 {
            margin-top: 0;
            color: #007BFF;
        }

        .info {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: white;
        }

        table th, table td {
            padding: 10px 14px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #007BFF;
            color: white;
        }

        .search-form {
            margin-bottom: 25px;
        }

        .search-form input[type="text"] {
            padding: 8px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-form button {
            padding: 8px 14px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            margin-left: 5px;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

    </style>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <h2>📋 All Orders</h2>

        <form method="get" class="search-form">
            <input type="text" name="search" placeholder="Search by name or email" value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Search</button>
        </form>

        <?php if ($orders): ?>
            <?php foreach ($orders as $order): ?>
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
                    ?>

                    <?php if ($items): ?>
                        <table>
                            <thead>
                                <tr><th>Product</th><th>Quantity</th><th>Price</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= $item['price'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No items for this order.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
