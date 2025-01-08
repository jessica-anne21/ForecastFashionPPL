<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForecastFashion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100vh; 
        }
        .content h1 {
            color: #ff69b4;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 2em;
            color: #555;
            margin-bottom: 20px;
        }
        .content .btn {
            background-color: #ff69b4;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 2em;
            border-radius: 5px;
            text-decoration: none;
        }
        .content .btn:hover {
            background-color: #ff1493;
        }

    </style>
</head>
<body>

    <!-- header -->
    <header>
        <a href="#" class="logo"><img src="../images/logo.png" width=auto height="100px"></a>

        <div id="menu-bar" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="article.php">Article</a>
            <a href="about.php">About</a>
            <a href="../index.php">Logout</a>

        </nav>
    </header>
    
    <!-- About Section -->
    <section class="content">
        <h1>Tentang ForecastFashion</h1>
        <p>
            <strong>ForecastFashion</strong> adalah platform inovatif yang dirancang untuk membantu Anda memilih pakaian 
            yang tepat berdasarkan cuaca dan tren musiman. Kami percaya bahwa gaya berpakaian tidak hanya 
            mencerminkan kepribadian Anda, tetapi juga harus memberikan kenyamanan dalam menghadapi 
            perubahan iklim.
        </p>
        <p>
            Dengan sistem rekomendasi kami yang canggih, Anda dapat mengetahui pakaian yang cocok untuk 
            setiap hari, apakah itu cerah, hujan, atau berawan. 
        </p>
        <a href="home.php" class="btn">Kembali ke Home</a>
    </section>

</body>
</html>
