<?php
include 'includes/db.php';
include 'includes/header.php';
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("
  SELECT products.*, categories.category_name AS category_name 
  FROM products 
  JOIN categories ON products.category_id = categories.id
");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
$limit = 6;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($page - 1) * $limit;

$totalProductsStmt = $pdo->query("SELECT COUNT(*) FROM products");
$totalProducts = $totalProductsStmt->fetchColumn();

$totalPages = ceil($totalProducts / $limit);

$stmt = $pdo->prepare("
    SELECT products.*, categories.category_name
    FROM products
    JOIN categories ON products.category_id = categories.id
    ORDER BY products.id DESC
    LIMIT :limit OFFSET :offset
");

$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$catStmt = $pdo->query("SELECT * FROM categories");
$categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Fresh and Organic</p>
          <h1>Shop</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- products -->
<div class="product-section mt-150 mb-150">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="product-filters">
          <ul>
            <li class="active" data-filter="*">All</li>
            <?php foreach ($categories as $cat): ?>
              <?php $className = strtolower(str_replace([' ', '&'], ['-', 'and'], $cat['category_name'])); ?>
              <li data-filter=".<?= $className ?>"><?= htmlspecialchars($cat['category_name']) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="row product-lists">
      <?php foreach ($products as $product): ?>
        <?php
        $className = strtolower(str_replace([' ', '&'], ['-', 'and'], $product['category_name']));
        ?>
        <div class="col-lg-4 col-md-6 text-center <?= $className ?>">
          <div class="single-product-item">
            <div class="product-image">
              <a href="single-product.php?id=<?= $product['id'] ?>">
                <img src="assets/img/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
              </a>
            </div>
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p class="product-price"><?= $product['price'] ?>$</p>

            <form method="POST" action="add_to_cart.php">
              <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
              <button type="submit" class="cart-btn1" style="border-radius: 20px; border: none;"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <!-- pagination -->
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="pagination-wrap">
          <ul>
            <?php if ($page > 1): ?>
              <li><a href="?page=<?= $page - 1 ?>">Prev</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <li><a class="<?= $i == $page ? 'active' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
              <li><a href="?page=<?= $page + 1 ?>">Next</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end products -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.product-filters li').click(function() {
      var filterValue = $(this).attr('data-filter');

      $('.product-filters li').removeClass('active');
      $(this).addClass('active');

      if (filterValue == '*') {
        $('.product-lists > div').show(300);
      } else {
        $('.product-lists > div').hide(300);
        $('.product-lists > div' + filterValue).show(300);
      }
    });
  });
</script>
<!-- footer -->
<?php include 'includes/footer.php'; ?>
<!-- end footer -->