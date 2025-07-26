<!-- sidebar.php -->
<style>
    .sidebar {
        width: 230px;
        background-color: #2d3436;
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        padding-top: 20px;
        font-family: Arial, sans-serif;
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
</style>

<div class="sidebar">
    <h2>🛠️ Control Panel</h2>
    <ul>
        <li><a href="dashboard.php">🏠 Dashboard</a></li>
        <li><a href="add_product.php">➕ Add Product</a></li>
        <li><a href="view_products.php">📦 View Products</a></li>
        <li><a href="view_orders.php">📋 View Orders</a></li>
        <li><a href="view_customers.php">👥 View Customers</a></li>
        <li><a href="view_news.php">🗞️ View News</a></li>
        <li><a href="add_news.php">➕ Add News</a></li>
        <li><a href="view_comments.php">💬 View Comments</a></li>
        <li><a href="view_messages.php">📨 Contact Messages</a></li>
        <li><a href="../index.php">🌐 Back to Site</a></li>
    </ul>
</div>
