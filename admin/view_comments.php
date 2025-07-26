<?php
require_once('../includes/db.php');

$stmt = $pdo->query("SELECT comments.*, users.name AS user_name, news.title AS news_title 
                     FROM comments 
                     JOIN users ON comments.user_id = users.id 
                     JOIN news ON comments.news_id = news.id 
                     ORDER BY comments.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Comments</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f2f6;
            margin: 0;
        }

        .main-content {
            margin-left: 230px;
            padding: 40px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h2 {
            color: #2d3436;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #2d3436;
            color: #fff;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        @media screen and (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                background: #fff;
                border-radius: 8px;
                padding: 10px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="main-content">
    <div class="container">
        <h2>💬 All Comments</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>News</th>
                    <th>Comment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch()) : ?>
                    <tr>
                        <td data-label="ID"><?= htmlspecialchars($row['id']) ?></td>
                        <td data-label="User"><?= htmlspecialchars($row['user_name']) ?></td>
                        <td data-label="News"><?= htmlspecialchars($row['news_title']) ?></td>
                        <td data-label="Comment"><?= htmlspecialchars($row['comment']) ?></td>
                        <td data-label="Date"><?= htmlspecialchars($row['created_at']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
