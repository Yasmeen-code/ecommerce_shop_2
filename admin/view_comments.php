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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f7f9;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fafafa;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2d89ef;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            color: #333;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            td {
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                top: 12px;
                font-weight: bold;
                text-align: left;
                color: #2d89ef;
            }
        }
    </style>
</head>
<body>
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
</body>
</html>
