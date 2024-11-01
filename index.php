<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForecastFashion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff0f5; 
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            max-width: 600px;
            padding: 30px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .login-options a {
            display: inline-block;
            width: 150px;
            padding: 12px;
            color: #fff;
            font-weight: bold;
            background: #ff69b4; 
            border-radius: 8px;
            transition: background 0.3s ease;
            text-decoration: none;
        }
        .login-options a:hover {
            background: #ff1493;
        }
        .promo {
            margin-top: 25px;
            background: #ffe6f2; 
            border-radius: 10px;
            padding: 20px;
            color: #d63384;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="display-6 mb-3 text-primary">Welcome to ForecastFashion</h1>
    <p class="lead text-muted">Your personalized fashion recommendation app based on real-time weather and seasonal trends!</p>

    <div class="login-options d-flex justify-content-center gap-3 mt-4">
        <a href="user/login.php" class="btn"><i class="fas fa-user"></i> Login as User</a>
        <a href="admin/login.php" class="btn"><i class="fas fa-user-shield"></i> Login as Admin</a>
    </div>

    <div class="promo mt-4">
        <h2 class="h5 fw-bold text-center">Why ForecastFashion?</h2>
        <p>Discover the perfect outfit for any weather! Our advanced recommendation system suggests the best styles tailored to local climate and seasonal trends, so you always look and feel your best.</p>
        <p>Join our community, stay updated with the latest fashion news, and never worry about dressing for the weather again!</p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>
