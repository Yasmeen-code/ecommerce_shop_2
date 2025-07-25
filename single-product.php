<?php
session_start();
include 'includes/header.php';
require_once 'includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // لو مفيش ID أو مش رقم، رجعه للصفحة الرئيسية أو اعرض رسالة خطأ
    header("Location: shop.php");
    exit;
}

$product_id = (int) $_GET['id'];

// جلب بيانات المنتج
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "<div class='container text-center my-5'><h3>المنتج غير موجود.</h3></div>";
    include 'includes/footer.php';
    exit;
}
?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>See more Details</p>
          <h1><?= htmlspecialchars($product['name']) ?></h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- single product -->
<div class="single-product mt-150 mb-150">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="single-product-img">
          <img src="assets/img/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
        </div>
      </div>
      <div class="col-md-7">
        <div class="single-product-content">
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <p class="single-product-pricing"><span>Per Piece</span> $<?= number_format($product['price'], 2) ?></p>
          <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
          <div class="single-product-form">
            <form action="add_to_cart.php" method="POST">
              <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
              <input type="number" name="quantity" placeholder="1" min="1" value="1" required />
              <button type="submit" class="cart-btn1" style="border-radius: 20px; border: none;">Add to Cart</button>
            </form>
            <p><strong>Category ID: </strong><?= $product['category_id'] ?></p>
          </div>
          <h4>Share:</h4>
          <ul class="product-share">
            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
            <li><a href=""><i class="fab fa-twitter"></i></a></li>
            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end single product -->

<!-- more products -->
<div class="more-products mb-150">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="section-title">
          <h3><span class="orange-text">Related</span> Products</h3>
          <p>Samiller products </p>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      $stmt_related = $pdo->prepare("SELECT * FROM products WHERE category_id = ? AND id != ? ORDER BY created_at DESC LIMIT 3");
      $stmt_related->execute([$product['category_id'], $product['id']]);
      while ($related = $stmt_related->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="col-lg-4 col-md-6 text-center">
          <div class="single-product-item">
            <div class="product-image">
              <a href="single-product.php?id=<?= $related['id'] ?>"><img src="assets/img/products/<?= htmlspecialchars($related['image']) ?>" alt="<?= htmlspecialchars($related['name']) ?>" /></a>
            </div>
            <h3><?= htmlspecialchars($related['name']) ?></h3>
            <p class="product-price"><span>Per Piece</span> $<?= number_format($related['price'], 2) ?></p>
            <a href="single-product.php?id=<?= $related['id'] ?>" class="cart-btn1" style="border-radius: 20px;"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<!-- end more products -->

<?php include 'includes/footer.php'; ?>
