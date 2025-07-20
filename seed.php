<?php
require_once 'includes/db.php';
$testimonials = [
    [
        'client_name' => 'Saira Hakim',
        'role' => 'Local shop owner',
        'avatar' => 'avatar1.png',
        'message' => 'Sed ut perspiciatis unde omnis iste natus error veritatis et quasi architecto...'
    ],
    [
        'client_name' => 'David Niph',
        'role' => 'Local shop owner',
        'avatar' => 'avatar2.png',
        'message' => 'Sed ut perspiciatis unde omnis iste natus error veritatis et quasi architecto...'
    ],
    [
        'client_name' => 'Jacob Sikim',
        'role' => 'Local shop owner',
        'avatar' => 'avatar3.png',
        'message' => 'Sed ut perspiciatis unde omnis iste natus error veritatis et quasi architecto...'
    ]
];

$stmt = $pdo->prepare("INSERT INTO testimonials (client_name, role, avatar, message) VALUES (?, ?, ?, ?)");

foreach ($testimonials as $t) {
    $stmt->execute([$t['client_name'], $t['role'], $t['avatar'], $t['message']]);
}

echo "Testimonials inserted successfully.";
?>
