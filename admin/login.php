<?php
include '../includes/db.php'; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ambil data admin dari database berdasarkan email dan password
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Simpan ID admin di sesi
        $_SESSION['admin_id'] = $admin['id']; 
        header("Location: home.php"); // Redirect ke halaman admin
        exit;
    } else {
        $error_message = "Email atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - ForecastFashion</title>
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
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-card card">
        <a href="#" class="d-block mb-3">
            <img src="../images/logo.png" alt="Logo" width="80" height="80" class="mx-auto d-block">
        </a>
        <h2 class="card-title">Login Admin</h2>

        <?php if (!empty($error_message)): ?>
            <div class="error-message">
                <?= htmlspecialchars($error_message) ?>
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
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
