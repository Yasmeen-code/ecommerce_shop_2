<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tags = ['Glass', 'Ornament', 'Mosaic', 'Handcraft', 'Decoration', 'Culture', 'Art', 'Design', 'Ceramic', 'Vintage', 'Modern', 'Traditional', 'Contemporary', 'Craftsmanship'];
    $stmt = $conn->prepare("INSERT INTO news_tags (name) VALUES (:name)");

    foreach ($tags as $tag) {
        $stmt->execute(['name' => $tag]);
    }

    echo "✅ Tags inserted successfully.<br>";

    $relations = [
        ['news_id' => 1, 'tag_id' => 1], 
        ['news_id' => 1, 'tag_id' => 5], 
        ['news_id' => 2, 'tag_id' => 2], 
        ['news_id' => 2, 'tag_id' => 4], 
        ['news_id' => 3, 'tag_id' => 3], 
    ];

    $stmt = $conn->prepare("INSERT INTO news_tag_relation (news_id, tag_id) VALUES (:news_id, :tag_id)");

    foreach ($relations as $rel) {
        $stmt->execute([
            'news_id' => $rel['news_id'],
            'tag_id' => $rel['tag_id']
        ]);
    }

    echo "✅ Tag relations inserted successfully.<br>";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}

$conn = null;
?>
