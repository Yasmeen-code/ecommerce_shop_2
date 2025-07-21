<?php
require_once 'includes/db.php';
// لما المستخدم يضغط تسجيل
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // تشفير

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);

    echo "تم إنشاء الحساب! <a href='login.php'>سجّل الدخول</a>";
}
?>

<form method="post">
    <h2>Register</h2>
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
