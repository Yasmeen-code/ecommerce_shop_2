<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);

    header("Location: login.php");
    exit();
}

include 'includes/header.php';
?>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Create a new account</p>
                    <h1>Register</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- register form -->
<div class="mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="register-form-wrap">
                    <div class="form-title text-center mb-30">
                        <i class="fas fa-user-plus" style="font-size: 60px; color: #f28123; margin-bottom: 20px;"></i>
                        <h2>Create Account</h2>
                        <p>Join our community and start shopping our beautiful collection of handmade crafts.</p>
                    </div>
                    <div class="register-form">
                        <form method="post">
                            <p>
                                <input type="text" placeholder="Full Name" name="name" required style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 3px;" />
                            </p>
                            <p>
                                <input type="email" placeholder="Your Email" name="email" required style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 3px;" />
                            </p>
                            <p>
                                <input type="password" placeholder="Password" name="password" required style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 3px;" />
                            </p>
                            <p>
                                <input type="submit" value="Register" class="boxed-btn" style="width: 100%; background-color: #f28123; color: #051922; font-weight: 700; text-transform: uppercase; font-size: 15px; border: none; padding: 15px; border-radius: 3px; cursor: pointer;">
                            </p>
                            <p class="text-center">
                                Already have an account? <a href="login.php">Login here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end register form -->

<?php include 'includes/footer.php'; ?>
