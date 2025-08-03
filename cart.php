<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT 
        ci.id AS cart_item_id,
        ci.quantity,
        p.id AS product_id,
        p.name,
        p.price,
        p.image
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.id
    WHERE ci.user_id = ?
");
$stmt->execute([$user_id]);
$cartItems = $stmt->fetchAll();


$subtotal = 0;
foreach ($cartItems as $item) {
  $subtotal += $item['price'] * $item['quantity'];
}
$shipping = 45;
$total = $subtotal + $shipping;

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $stmt = $pdo->prepare("DELETE FROM cart_items WHERE id = ?");
  if ($stmt->execute([$id])) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'error' => 'Failed to delete from DB']);
  }
  exit;
} 

include 'includes/header.php';
?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Elegant & Artistic</p>
          <h1>Your Decorative Items Cart</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- cart -->
<div class="cart-section mt-150 mb-150">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="cart-table-wrap">
          <table class="cart-table">
            <thead class="cart-table-head">
              <tr class="table-head-row">
                <th class="product-remove"></th>
                <th class="product-image">Item Image</th>
                <th class="product-name">Item Name</th>
                <th class="product-price">Price</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-total">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cartItems as $item): ?>
                <tr class="table-body-row">
                  <td class="product-remove">
                    <a href="#" class="remove-from-cart" data-id="<?= $item['cart_item_id'] ?>">
                      <i class="far fa-window-close"></i>
                    </a>
                  </td>


                  <td class="product-image">
                    <img src="assets/img/products/<?= htmlspecialchars($item['image']) ?>" alt="">
                  </td>
                  <td class="product-name"><?= htmlspecialchars($item['name']) ?></td>
                  <td class="product-price">$<?= number_format($item['price'], 2) ?></td>
                  <td class="product-quantity">
                    <input type="number" value="<?= $item['quantity'] ?>" readonly>
                  </td>
                  <td class="product-total">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
              <?php endforeach; ?>
              <?php if (empty($cartItems)): ?>
                <tr>
                  <td colspan="6">Your cart is currently empty.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="total-section">
          <table class="total-table">
            <thead class="total-table-head">
              <tr class="table-total-row">
                <th>Total</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr class="total-data">
                <td><strong>Subtotal:</strong></td>
                <td>$<?= number_format($subtotal, 2) ?></td>
              </tr>
              <tr class="total-data">
                <td><strong>Shipping:</strong></td>
                <td>$<?= number_format($shipping, 2) ?></td>
              </tr>
              <tr class="total-data">
                <td><strong>Total:</strong></td>
                <td>$<?= number_format($total, 2) ?></td>
              </tr>
            </tbody>
          </table>
          <div class="cart-buttons">
            <a href="cart.php" class="boxed-btn">Update Cart</a>
            <a href="checkout.php" class="boxed-btn black">Proceed to Checkout</a>
          </div>
        </div>

        <div class="coupon-section">
          <h3>Use Your Promo Code</h3>
          <div class="coupon-form-wrap">
            <form action="apply_coupon.php" method="POST">
              <p><input type="text" name="coupon_code" placeholder="Enter your code"></p>
              <p><input type="submit" value="Apply"></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.querySelectorAll('.remove-from-cart').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();

      const row = this.closest('tr');
      const id = this.dataset.id;

      fetch('remove_from_cart.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `id=${encodeURIComponent(id)}`
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            row.remove();
          } else {
            alert('Error occurred while removing item: ' + data.error);
          }
        })
        .catch(err => {
          alert('AJAX error: ' + err);
        });
    });
  });
</script>

<!-- end cart -->

<?php include 'includes/footer.php'; ?>