<?php
session_start();
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
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f7f7f7;
    }
    h1 {
      color: #333;
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
      background-color: #eee;
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

  <h1>🗞️ View News</h1>

  <?php if (count($newsList) === 0): ?>
    <p>No news available.</p>
  <?php else: ?>
    <table>
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
  <?php endif; ?>

</body>
</html>

