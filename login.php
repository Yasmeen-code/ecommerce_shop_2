<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}

include 'includes/header.php';
?>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Sign in to your account</p>
                    <h1>Login</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- login form -->
<div class="mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form-wrap">
                    <div class="form-title text-center mb-30">
                        <i class="fas fa-user-lock" style="font-size: 60px; color: #f28123; margin-bottom: 20px;"></i>
                        <h2>Welcome Back</h2>
                        <p>Sign in to access your account and continue shopping our beautiful collection.</p>
                    </div>
                    <div class="login-form">
                        <form method="post">
                            <?php if (!empty($error)): ?>
                                <p style="color: #a94442; background: #f2dede; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 20px;">
                                    <?= htmlspecialchars($error) ?>
                                </p>
                            <?php endif; ?>
                            <p>
                                <input type="email" placeholder="Your Email" name="email" required style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 3px;" />
                            </p>
                            <p>
                                <input type="password" placeholder="Password" name="password" required style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 3px;" />
                            </p>
                            <p>
                                <input type="submit" value="Login" class="boxed-btn" style="width: 100%; background-color: #f28123; color: #051922; font-weight: 700; text-transform: uppercase; font-size: 15px; border: none; padding: 15px; border-radius: 3px; cursor: pointer;">
                            </p>
                            <p class="text-center">
                                Don't have an account? <a href="register.php">Register here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end login form -->

<?php include 'includes/footer.php'; ?>
