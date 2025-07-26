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

    // handle image
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

    $message = 'News has been added successfully!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #444;
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
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add News</h2>
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

            <button type="submit">Add News</button>
        </form>
    </div>
</body>
</html>
