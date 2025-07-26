<?php
require_once('../includes/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fffaf3;
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-orange {
            background-color: #ff8800;
            color: white;
        }

        .btn-orange:hover {
            background-color: #e67600;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4 text-center">Add New Product</h2>

        <?php
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];

            if (!empty($image)) {
                $target = "../assets/img/products/" . basename($image);
                move_uploaded_file($tmp, $target);
            } else {
                $image = null;
            }

            try {
                $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category_id, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                $stmt->execute([$name, $desc, $price, $image, $category_id]);


                echo '<div class="alert alert-success text-center">✅ Product added successfully!</div>';
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger">❌ Error: ' . $e->getMessage() . '</div>';
            }
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" placeholder="Enter description"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" step="0.01" class="form-control" placeholder="Enter price" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select category</option>
                    <option value="1">1 - Pottery</option>
                    <option value="2">2 - Glass Art</option>
                    <option value="3">3 - Handmade</option>
                    <option value="4">4 - Ornaments</option>
                </select>
            </div>


            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="text-center">
                <button type="submit" name="add" class="btn btn-orange">Add Product</button>
            </div>
        </form>
    </div>
</body>

</html>