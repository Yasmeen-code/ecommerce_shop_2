<?php
require 'includes/db.php'; // أو عدلي حسب مكان الاتصال بقاعدة البيانات

$newsItems = [
    [
        'title' => 'Timeless Ceramic Art for Modern Spaces',
        'author' => 'Admin',
        'date' => '2025-03-12',
        'excerpt' => 'Explore how handcrafted ceramic pieces are adding warmth and character to contemporary interiors.',
        'image' => 'news-bg-1.jpg',
        'content' => 'Full article content about ceramic art for modern spaces...',
    ],
    [
        'title' => 'The Return of Vintage Glassware in Decor',
        'author' => 'Admin',
        'date' => '2025-03-08',
        'excerpt' => 'Discover how vintage glass designs are making a stunning comeback in decorative trends.',
        'image' => 'news-bg-2.jpg',
        'content' => 'Full article content about vintage glassware trends...',
    ],
    [
        'title' => 'Textile Wall Art: A Soft Touch of Tradition',
        'author' => 'Admin',
        'date' => '2025-03-05',
        'excerpt' => 'From tapestries to handwoven panels, textile decor is bringing stories and softness to walls.',
        'image' => 'news-bg-3.jpg',
        'content' => 'Full article content about textile wall art...',
    ],
    [
        'title' => 'Decorative Pottery That Tells a Story',
        'author' => 'Admin',
        'date' => '2025-03-02',
        'excerpt' => 'Dive into the world of pottery pieces that combine function and artistic storytelling.',
        'image' => 'news-bg-4.jpg',
        'content' => 'Full article content about story-telling pottery...',
    ],
    [
        'title' => 'How Handmade Decorations Add Soul to Homes',
        'author' => 'Admin',
        'date' => '2025-02-28',
        'excerpt' => 'Learn how hand-crafted ornaments make living spaces feel more personal and inviting.',
        'image' => 'news-bg-5.jpg',
        'content' => 'Full article content about handmade home decoration...',
    ],
    [
        'title' => 'Color Trends in Artistic Decorations 2025',
        'author' => 'Admin',
        'date' => '2025-02-25',
        'excerpt' => 'A look at the most popular color palettes being used by modern decor artists this year.',
        'image' => 'news-bg-6.jpg',
        'content' => 'Full article content about decoration color trends 2025...',
    ],
];

$stmt = $pdo->prepare("INSERT INTO news (title, author, date, excerpt, image, content, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");

foreach ($newsItems as $news) {
    $stmt->execute([$news['title'], $news['author'], $news['date'], $news['excerpt'], $news['image'], $news['content']]);
}

echo "News inserted successfully.";
