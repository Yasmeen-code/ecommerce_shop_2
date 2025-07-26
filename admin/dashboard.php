<?php
require_once('../includes/db.php');

// 🛍️ جلب بيانات المنتجات حسب التصنيف
$productData = $pdo->query("
  SELECT categories.category_name, COUNT(products.id) as count
  FROM products 
  JOIN categories ON products.category_id = categories.id 
  GROUP BY category_id
")->fetchAll(PDO::FETCH_ASSOC);

// 📦 عدد الأخبار حسب الشهر (آخر 6 شهور)
$newsData = $pdo->query("
  SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(*) AS count 
  FROM news 
  GROUP BY month 
  ORDER BY month DESC 
  LIMIT 6
")->fetchAll(PDO::FETCH_ASSOC);

// 🗨️ عدد التعليقات حسب الشهر (آخر 6 شهور)
$commentData = $pdo->query("
  SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(*) AS count 
  FROM comments 
  GROUP BY month 
  ORDER BY month DESC 
  LIMIT 6
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
      display: flex;
    }

    /* مكان للـ sidebar */
    .sidebar-placeholder {
      width: 240px;
    }

    .main-content {
      flex-grow: 1;
      padding: 30px;
    }

    .main-content h1 {
      color: #333;
    }

    .chart-container {
      margin: 30px 0;
      padding: 20px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .chart-container h3 {
      margin-bottom: 10px;
      color: #444;
    }

    #piechart, #barchart, #linechart {
      width: 100%;
      height: 400px;
    }
  </style>

  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawAllCharts);

    function drawAllCharts() {
      drawProductChart();
      drawNewsChart();
      drawCommentChart();
    }

    function drawProductChart() {
      var data = google.visualization.arrayToDataTable([
        ['Category', 'Count'],
        <?php foreach($productData as $row): ?>
          ['<?= $row['category_name'] ?>', <?= $row['count'] ?>],
        <?php endforeach; ?>
      ]);

      var options = {
        title: 'Products by Category',
        pieHole: 0.4,
        colors: ['#f39c12', '#e74c3c', '#2ecc71', '#9b59b6']
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }

    function drawNewsChart() {
      var data = google.visualization.arrayToDataTable([
        ['Month', 'News Posted'],
        <?php foreach(array_reverse($newsData) as $row): ?>
          ['<?= $row['month'] ?>', <?= $row['count'] ?>],
        <?php endforeach; ?>
      ]);

      var options = {
        title: 'News Over Time',
        curveType: 'function',
        legend: { position: 'bottom' },
        colors: ['#3498db']
      };

      var chart = new google.visualization.LineChart(document.getElementById('barchart'));
      chart.draw(data, options);
    }

    function drawCommentChart() {
      var data = google.visualization.arrayToDataTable([
        ['Month', 'Comments'],
        <?php foreach(array_reverse($commentData) as $row): ?>
          ['<?= $row['month'] ?>', <?= $row['count'] ?>],
        <?php endforeach; ?>
      ]);

      var options = {
        title: 'Comments Over Time',
        colors: ['#9b59b6'],
        hAxis: { title: 'Month' },
        vAxis: { title: 'Comments' }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('linechart'));
      chart.draw(data, options);
    }
  </script>
</head>
<body>

  <div class="sidebar-placeholder">
    <?php include('sidebar.php'); ?>
  </div>

  <div class="main-content">
    <h1>Welcome to the Admin Dashboard</h1>
    <p>Visual overview of your system data:</p>

    <div class="chart-container">
      <h3>🛍️ Product Distribution</h3>
      <div id="piechart"></div>
    </div>

    <div class="chart-container">
      <h3>📰 News per Month</h3>
      <div id="barchart"></div>
    </div>

    <div class="chart-container">
      <h3>💬 Comments Activity</h3>
      <div id="linechart"></div>
    </div>
  </div>

</body>
</html>
