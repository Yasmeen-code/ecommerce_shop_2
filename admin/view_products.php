<?php
require_once('../includes/db.php');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($product && !empty($product['image'])) {
        $imgPath = "../assets/img/products/" . $product['image'];
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }
    }

    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    $message = "✅ Product deleted successfully!";
}

$stmt = $pdo->prepare("SELECT * FROM products ORDER BY id ");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Products</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f7f4ef;
      font-family: Arial, sans-serif;
    }
    .container {
      background: #fff;
      padding: 30px;
      margin-top: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    h2 {
      color: #ff8800;
    }
    .product-img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 5px;
    }
    .btn-delete {
      background-color: #dc3545;
      color: white;
    }
    .btn-delete:hover {
      background-color: #c82333;
    }
  </style>
</head>
<body>
<div class="container">
  <h2 class="mb-4 text-center">🛍️ All Products</h2>

  <?php if (!empty($message)): ?>
    <div class="alert alert-success text-center"><?= $message ?></div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered align-middle table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th>#ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price (EGP)</th>
          <th>Category ID</th>
          <th>Image</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($products): ?>
          <?php foreach ($products as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td style="max-width: 200px;"><?= nl2br(htmlspecialchars($row['description'])) ?></td>
              <td><?= htmlspecialchars($row['price']) ?></td>
              <td><?= htmlspecialchars($row['category_id']) ?></td>
              <td>
                <?php if ($row['image']): ?>
                  <img src="../assets/img/products/<?= $row['image'] ?>" class="product-img" alt="Image">
                <?php else: ?>
                  <span class="text-muted">No Image</span>
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($row['created_at']) ?></td>
              <td>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-sm btn-delete">🗑 Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-muted">No products found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
