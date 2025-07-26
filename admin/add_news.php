<?php
require_once '../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date = $_POST['date'];
    $excerpt = $_POST['excerpt'];
    $content = $_POST['content'];
    $created_at = date('Y-m-d H:i:s');

    $imageName = '';
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/latest-news/' . $imageName);
    }

    $stmt = $pdo->prepare("INSERT INTO news (title, author, date, excerpt, image, content, created_at) 
                           VALUES (:title, :author, :date, :excerpt, :image, :content, :created_at)");

    $stmt->execute([
        ':title' => $title,
        ':author' => $author,
        ':date' => $date,
        ':excerpt' => $excerpt,
        ':image' => $imageName,
        ':content' => $content,
        ':created_at' => $created_at
    ]);

    $message = '✅ News has been added successfully!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add News</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f2f6;
            margin: 0;
            padding: 0;
        }

        .main-content {
            margin-left: 230px;
            padding: 40px;
        }

        .container {
            max-width: 800px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: auto;
        }

        h2 {
            text-align: center;
            color: #2d3436;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #2d3436;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        button {
            margin-top: 25px;
            padding: 12px;
            background-color: #0984e3;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #0652dd;
        }

        .success {
            background-color: #dff9fb;
            color: #27ae60;
            text-align: center;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid #7bed9f;
        }
    </style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="main-content">
    <div class="container">
        <h2>📝 Add News</h2>

        <?php if ($message): ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" required>

            <label>Author:</label>
            <input type="text" name="author" required>

            <label>Date:</label>
            <input type="date" name="date" required>

            <label>Excerpt:</label>
            <textarea name="excerpt" required></textarea>

            <label>Image:</label>
            <input type="file" name="image">

            <label>Content:</label>
            <textarea name="content" required></textarea>

            <button type="submit">➕ Add News</button>
        </form>
    </div>
</div>

</body>
</html>
