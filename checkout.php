<?php
session_start();
include 'includes/db.php';
include 'includes/header.php'; 


if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT ci.*, p.name, p.price, p.image FROM cart_items ci JOIN products p ON ci.product_id = p.id WHERE ci.user_id = ?");
$stmt->execute([$user_id]);
$cartItems = $stmt->fetchAll();

$subtotal = 0;
foreach ($cartItems as $item) {
  $subtotal += $item['price'] * $item['quantity'];
}
$shipping = 50;
$total = $subtotal + $shipping;
?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Elegant & Handcrafted</p>
          <h1>Checkout Decorative Items</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- check out section -->
<div class="checkout-section mt-150 mb-150">
  <div class="container">
    <div class="row">
      <!-- Left Side -->
      <div class="col-lg-8">
        <div class="checkout-accordion-wrap">
          <form action="place_order.php" method="POST">
            <div class="accordion" id="accordionExample">
              <!-- Billing -->
              <div class="card single-accordion">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Billing Information
                    </button>
                  </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="billing-address-form">
                      <p><input type="text" name="name" placeholder="Full Name" required /></p>
                      <p><input type="email" name="email" placeholder="Email Address" required /></p>
                      <p><input type="text" name="address" placeholder="Shipping Address" required /></p>
                      <p><input type="tel" name="phone" placeholder="Phone Number" required /></p>
                      <p><textarea name="notes" cols="30" rows="10" placeholder="Additional Notes (e.g., delivery preferences)"></textarea></p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Shipping -->
              <div class="card single-accordion">
                <div class="card-header" id="headingTwo">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Shipping Details
                    </button>
                  </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="shipping-address-form">
                      <p>Shipping address will be the same as billing address unless otherwise specified.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Card -->
              <div class="card single-accordion">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Payment Method
                    </button>
                  </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="card-details">
                      <p>All orders are payable on delivery. No card information needed at this stage.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>

      <!-- Right Side: Order Summary -->
      <div class="col-lg-4">
        <div class="order-details-wrap">
          <table class="order-details">
            <thead>
              <tr>
                <th>Your Order Summary</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody class="order-details-body">
              <tr>
                <td>Item</td>
                <td>Total</td>
              </tr>
              <?php foreach ($cartItems as $item): ?>
                <tr>
                  <td><?= htmlspecialchars($item['name']) ?> × <?= $item['quantity'] ?></td>
                  <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tbody class="checkout-details">
              <tr>
                <td>Subtotal</td>
                <td>$<?= number_format($subtotal, 2) ?></td>
              </tr>
              <tr>
                <td>Shipping</td>
                <td>$<?= number_format($shipping, 2) ?></td>
              </tr>
              <tr>
                <td>Total</td>
                <td>$<?= number_format($total, 2) ?></td>
              </tr>
            </tbody>
          </table>

          <input type="hidden" name="total_price" value="<?= $total ?>">
          <input type="hidden" name="shipping" value="<?= $shipping ?>">

          <button type="submit" class="boxed-btn">Place Order</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- end check out section -->

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