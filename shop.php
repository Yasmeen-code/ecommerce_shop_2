<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Get search query if provided
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : 0;

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Build query based on filters
$whereClause = "WHERE 1=1";
$params = [];

if (!empty($search)) {
    $whereClause .= " AND (p.name LIKE ? OR p.description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($category_filter > 0) {
    $whereClause .= " AND p.category_id = ?";
    $params[] = $category_filter;
}

if ($min_price > 0) {
    $whereClause .= " AND p.price >= ?";
    $params[] = $min_price;
}

if ($max_price > 0) {
    $whereClause .= " AND p.price <= ?";
    $params[] = $max_price;
}

// Get total products count for pagination
$totalProductsStmt = $pdo->prepare("SELECT COUNT(*) FROM products p $whereClause");
$totalProductsStmt->execute($params);
$totalProducts = $totalProductsStmt->fetchColumn();
$totalPages = ceil($totalProducts / $limit);

// Get products with filters
$stmt = $pdo->prepare("
    SELECT p.*, c.category_name
    FROM products p
    JOIN categories c ON p.category_id = c.id
    $whereClause
    ORDER BY p.id DESC
    LIMIT ? OFFSET ?
");

// Add limit and offset to params
$params[] = $limit;
$params[] = $offset;

$stmt->execute($params);
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

    <!-- Search and Filter Form -->
    <div class="row mb-4">
      <div class="col-lg-12">
        <form method="GET" class="search-form">
          <div class="row">
            <div class="col-md-4">
              <input type="text" name="search" class="form-control" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="col-md-3">
              <select name="category" class="form-control">
                <option value="0">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                  <option value="<?= $cat['id'] ?>" <?= $category_filter == $cat['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['category_name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <input type="number" name="min_price" class="form-control" placeholder="Min Price" min="0" value="<?= $min_price > 0 ? $min_price : '' ?>">
            </div>
            <div class="col-md-2">
              <input type="number" name="max_price" class="form-control" placeholder="Max Price" min="0" value="<?= $max_price > 0 ? $max_price : '' ?>">
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn btn-primary">Filter</button>
            </div>
          </div>
        </form>
      </div>
    </div>

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
      <?php if (count($products) > 0): ?>
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

              <form>
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit" class="cart-btn1" style="border-radius: 20px; border: none;"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-lg-12 text-center">
          <h3>No products found matching your criteria.</h3>
          <p>Try adjusting your search or filter options.</p>
        </div>
      <?php endif; ?>
    </div>
    
    <!-- pagination -->
    <?php if ($totalProducts > 0): ?>
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="pagination-wrap">
          <ul>
            <?php if ($page > 1): ?>
              <li><a href="?search=<?= urlencode($search) ?>&category=<?= $category_filter ?>&min_price=<?= $min_price ?>&max_price=<?= $max_price ?>&page=<?= $page - 1 ?>">Prev</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
