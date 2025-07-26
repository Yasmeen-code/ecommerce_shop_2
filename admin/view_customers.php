<?php
require_once '../includes/db.php';

try {
    $stmt = $pdo->query("SELECT id, name, email, created_at, role, avatar FROM users");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching customers: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
 .avatar-img {
            border-radius: 50%;
            object-fit: cover;
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
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>All Customers</h2>
        <table class="table table-bordered table-striped bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Role</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= htmlspecialchars($customer['id']) ?></td>
                        <td><?= htmlspecialchars($customer['name']) ?></td>
                        <td><?= htmlspecialchars($customer['email']) ?></td>
                        <td>
                            <?php if (!empty($customer['avatar'])): ?>
                                <img src="../uploads/<?= htmlspecialchars($customer['avatar']) ?>" alt="Avatar" width="50" height="50" class="avatar-img">
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($customer['role']) ?></td>
                        <td><?= htmlspecialchars($customer['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
