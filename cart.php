<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT c.*, p.name, p.price, p.image 
    FROM cart_items c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();
?>


<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Fresh and Organic</p>
          <h1>Cart</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- cart -->

<div class="cart">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2>Your Cart</h2>
        <?php if (count($cart_items) > 0): ?>
          <table class="table">
            <thead>
              <tr>
                <th>Product</th>
                <th>image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cart_items as $item): ?>
                <tr>
                  <td><?= htmlspecialchars($item['name']) ?></td>
                  <td><img src="assets/img/products/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 50px; height: 50px;"></td>
                  <td><?= number_format($item['price'], 2) ?>$</td>
                  <td><?= $item['quantity'] ?></td>
                  <td><?= number_format($item['price'] * $item['quantity'], 2) ?>$</td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>Your cart is empty.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
<!-- end cart -->

<!-- logo carousel -->
<div class="logo-carousel-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="logo-carousel-inner">
          <div class="single-logo-item">
            <img src="assets/img/company-logos/1.png" alt="" />
          </div>
          <div class="single-logo-item">
            <img src="assets/img/company-logos/2.png" alt="" />
          </div>
          <div class="single-logo-item">
            <img src="assets/img/company-logos/3.png" alt="" />
          </div>
          <div class="single-logo-item">
            <img src="assets/img/company-logos/4.png" alt="" />
          </div>
          <div class="single-logo-item">
            <img src="assets/img/company-logos/5.png" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end logo carousel -->
<?php include 'includes/footer.php'; ?>
<!-- jquery -->
<script src="assets/js/jquery-1.11.3.min.js"></script>
<!-- bootstrap -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- count down -->
<script src="assets/js/jquery.countdown.js"></script>
<!-- isotope -->
<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
<!-- waypoints -->
<script src="assets/js/waypoints.js"></script>
<!-- owl carousel -->
<script src="assets/js/owl.carousel.min.js"></script>
<!-- magnific popup -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- mean menu -->
<script src="assets/js/jquery.meanmenu.min.js"></script>
<!-- sticker js -->
<script src="assets/js/sticker.js"></script>
<!-- main js -->
<script src="assets/js/main.js"></script>
</body>

</html>