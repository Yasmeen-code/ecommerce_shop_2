<?php
require_once('../includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .dashboard-container {
      max-width: 900px;
      margin: 50px auto;
      padding: 30px;
      background-color: #fff;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
    }

    h2 {
      text-align: center;
      color: #d35400;
      margin-bottom: 30px;
    }

    ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    li {
      margin: 15px 0;
    }

    a {
      text-decoration: none;
      display: block;
      padding: 12px 20px;
      background-color: #f39c12;
      color: white;
      border-radius: 8px;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }

    a:hover {
      background-color: #e67e22;
    }

    a::before {
      margin-right: 8px;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <h2>Admin Dashboard</h2>
    <ul>
      <li><a href="add_product.php">➕ Add Product</a></li>
      <li><a href="view_products.php">📦 View Products</a></li>
      <li><a href="view_orders.php">📋 View Orders</a></li>
      <li><a href="view_customers.php">👥 View Customers</a></li>
      <li><a href="add_news.php">📰 Add News</a></li>
      <li><a href="view_news.php">🗞️ View News</a></li>
      <li><a href="view_comments.php">💬 View Comments</a></li>
      <li><a href="view_messages.php">📨 Contact Messages</a></li>
    </ul>
  </div>
</body>
</html>
