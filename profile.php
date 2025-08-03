<?php
session_start();
include 'includes/db.php';

// Check if user is not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$user_id = $_SESSION['user_id'];

// Handle logout
if (isset($_POST['logout'])) {
  session_destroy();
  header('Location: login.php');
  exit;
}

// Get user information
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Get user's orders
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Welcome Back</p>
          <h1>My Profile</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- profile section -->
<div class="cart-section mt-150 mb-150">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>Account Information</h2>
        </div>
        <div class="profile-info">
          <div class="row">
            <div class="col-lg-6">
              <div class="profile-details">
                <h3>Personal Information</h3>
                <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Member Since:</strong> <?= date('F j, Y', strtotime($user['created_at'])) ?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="logout-section">
                <h3>Account Actions</h3>
                <form method="post">
                  <button type="submit" name="logout" class="boxed-btn" style="background-color: #dc3545; border: none; padding: 10px 20px; border-radius: 50px; color: white; cursor: pointer;">Logout</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>My Order History</h2>
        </div>
        <?php if ($orders): ?>
          <?php foreach ($orders as $order): ?>
            <div class="order-history">
              <div class="cart-table-wrap">
                <div class="order-header">
                  <h3>Order #<?= $order['id'] ?> - <?= date('F j, Y', strtotime($order['created_at'])) ?></h3>
                  <p><strong>Total:</strong> $<?= number_format($order['total_price'], 2) ?></p>
                </div>
                <?php
                  $stmt_items = $pdo->prepare("
                    SELECT oi.*, p.name AS product_name, p.image AS product_image
                    FROM order_items oi 
                    JOIN products p ON oi.product_id = p.id 
                    WHERE oi.order_id = ?
                  ");
                  $stmt_items->execute([$order['id']]);
                  $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php if ($items): ?>
                  <table class="cart-table">
                    <thead class="cart-table-head">
                      <tr class="table-head-row">
                        <th class="product-image">Product</th>
                        <th class="product-name">Name</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-total">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($items as $item): ?>
                        <tr class="table-body-row">
                          <td class="product-image">
                            <img src="assets/img/products/<?= htmlspecialchars($item['product_image'] ?? 'product-01.jpg') ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" width="100">
                          </td>
                          <td class="product-name"><?= htmlspecialchars($item['product_name']) ?></td>
                          <td class="product-price">$<?= number_format($item['price'], 2) ?></td>
                          <td class="product-quantity"><?= $item['quantity'] ?></td>
                          <td class="product-total">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                <?php else: ?>
                  <p>No items for this order.</p>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>You haven't placed any orders yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- end profile section -->

<?php include 'includes/footer.php'; ?>
