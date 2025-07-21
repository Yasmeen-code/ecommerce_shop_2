<?php
require_once 'includes/db.php';

try {

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"])) {
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM subscriptions WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->fetchColumn() == 0) {
                $stmt = $pdo->prepare("INSERT INTO subscriptions (email) VALUES (?)");
                $stmt->execute([$email]);
                echo "Subscription successful! Thank you for subscribing.";
            } else {
                echo "You are already subscribed with this email.";
            }
        } else {
            echo "Invalid email format. Please enter a valid email address.";
        }
    }
} catch (PDOException $e) {
    echo " Error: " . $e->getMessage();
}
?>
