<?php
require_once 'includes/db.php';
try {

    $logos = [
        ['image_path' => 'assets/img/company-logos/1.png', 'alt_text' => 'Logo 1'],
        ['image_path' => 'assets/img/company-logos/2.png', 'alt_text' => 'Logo 2'],
        ['image_path' => 'assets/img/company-logos/3.png', 'alt_text' => 'Logo 3'],
        ['image_path' => 'assets/img/company-logos/4.png', 'alt_text' => 'Logo 4'],
        ['image_path' => 'assets/img/company-logos/5.png', 'alt_text' => 'Logo 5'],
    ];

    $stmt = $pdo->prepare("INSERT INTO company_logos (image_path, alt_text) VALUES (:image_path, :alt_text)");

    foreach ($logos as $logo) {
        $stmt->execute([
            ':image_path' => $logo['image_path'],
            ':alt_text' => $logo['alt_text'],
        ]);
    }

    echo "Logos inserted successfully.";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
