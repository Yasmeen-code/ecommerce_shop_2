<?php
require_once '../includes/db.php';

$stmt = $pdo->prepare("SELECT * FROM news ORDER BY created_at DESC");
$stmt->execute();
$newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🗞️ View News</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f6f9fc;
    }

    .wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar */
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

    /* Main content */
    .main-content {
      margin-left: 230px;
      padding: 30px;
      width: calc(100% - 230px);
    }

    h1 {
      color: #2d3436;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
      text-align: left;
      vertical-align: top;
    }

    th {
      background-color: #007BFF;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #e9f5ff;
    }

    img {
      max-width: 100px;
      height: auto;
    }

    .excerpt {
      max-width: 300px;
    }
  </style>
</head>
<body>

<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    <?php include 'sidebar.php'; ?>
  </div>

  <!-- Main content -->
  <div class="main-content">
    <h1>🗞️ View News</h1>

    <?php if (count($newsList) === 0): ?>
      <p>No news available.</p>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Author</th>
              <th>Date</th>
              <th>Excerpt</th>
              <th>Image</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($newsList as $news): ?>
              <tr>
                <td><?= htmlspecialchars($news['id']) ?></td>
                <td><?= htmlspecialchars($news['title']) ?></td>
                <td><?= htmlspecialchars($news['author']) ?></td>
                <td><?= htmlspecialchars($news['date']) ?></td>
                <td class="excerpt"><?= nl2br(htmlspecialchars($news['excerpt'])) ?></td>
                <td>
                  <?php if (!empty($news['image'])): ?>
                    <img src="../assets/img/latest-news/<?= htmlspecialchars($news['image']) ?>" alt="News Image">
                  <?php else: ?>
                    No image
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($news['created_at']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
