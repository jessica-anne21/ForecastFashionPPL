<?php
include '../includes/db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        header("Location: home.php");
        exit;
    } else {
        $error_message = "Email atau password salah. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login User - ForecastFashion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffe6f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-card {
            max-width: 400px;
            padding: 2rem;
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            color: #ff69b4;
        }
        .login-card .card-title {
            font-weight: bold;
            color: #ff69b4;
            text-align: center;
        }
        .login-card .btn-primary {
            background-color: #ff69b4;
            border: none;
            width: 100%;
        }
        .login-card .btn-primary:hover {
            background-color: #ff1493;
        }
        .register-link {
            text-align: center;
            display: block;
            margin-top: 1rem;
            color: #ff69b4;
            text-decoration: none;
        }
        .register-link:hover {
            color: #ff1493;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-card card">
        <a href="#" class="d-block mb-3">
            <img src="../images/logo.png" alt="Logo" width="80" height="80" class="mx-auto d-block">
        </a>
        <h2 class="card-title">Login User</h2>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="register-link">Register Now</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
