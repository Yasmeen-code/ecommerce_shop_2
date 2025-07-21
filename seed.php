<?php
require_once 'includes/db.php';

try {
    // بيانات الفوتر الرئيسية
    $stmt = $pdo->prepare("
        INSERT INTO footer_settings 
        (about_title, about_text, contact_title, address, email, phone, pages_title, subscribe_title, subscribe_text)
        VALUES
        (:about_title, :about_text, :contact_title, :address, :email, :phone, :pages_title, :subscribe_title, :subscribe_text)
    ");

    $stmt->execute([
        ':about_title' => 'About us',
        ':about_text' => 'Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.',
        ':contact_title' => 'Get in Touch',
        ':address' => '34/8, East Hukupara, Gifirtok, Sadan.',
        ':email' => 'support@fruitkha.com',
        ':phone' => '+00 111 222 3333',
        ':pages_title' => 'Pages',
        ':subscribe_title' => 'Subscribe',
        ':subscribe_text' => 'Subscribe to our mailing list to get the latest updates.',
    ]);

    // الصفحات
    $pages = [
        ['Home', 'index.php'],
        ['About', 'about.php'],
        ['Shop', 'services.html'],
        ['News', 'news.php'],
        ['Contact', 'contact.php'],
    ];

    $stmtPage = $pdo->prepare("INSERT INTO footer_pages (page_name, page_link) VALUES (:name, :link)");
    foreach ($pages as $page) {
        $stmtPage->execute([
            ':name' => $page[0],
            ':link' => $page[1]
        ]);
    }

    echo "Footer data inserted successfully.";
} catch (PDOException $e) {
    echo "Error seeding footer data: " . $e->getMessage();
}
?>
