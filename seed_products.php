<?php
require_once 'includes/db.php';

$products = [
    [
        'name' => 'Handcrafted Ceramic Vase',
        'description' => 'A beautifully designed handmade ceramic vase perfect for flowers or as a home decor piece.',
        'price' => 250.00,
        'image' => 'vase1.jpg'
    ],
    [
        'name' => 'Ceramic Tea Set',
        'description' => 'Elegant ceramic tea set including 4 cups and a teapot with traditional patterns.',
        'price' => 420.00,
        'image' => 'tea-set.jpg'
    ],
    [
        'name' => 'Blue Pottery Bowl',
        'description' => 'A deep ceramic bowl with intricate blue designs, ideal for serving or display.',
        'price' => 180.00,
        'image' => 'bowl-blue.jpg'
    ],
    [
        'name' => 'Decorative Ceramic Plate',
        'description' => 'Wall-hanging decorative plate with hand-painted ceramic floral motifs.',
        'price' => 200.00,
        'image' => 'plate-decor.jpg'
    ],
    [
        'name' => 'Rustic Ceramic Mug',
        'description' => 'Rustic handmade ceramic mug with earthy tones, perfect for coffee or tea.',
        'price' => 90.00,
        'image' => 'mug1.jpg'
    ]
];

foreach ($products as $product) {
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $product['name'],
        $product['description'],
        $product['price'],
        $product['image']
    ]);
}

echo "Products seeded successfully.";
?>
