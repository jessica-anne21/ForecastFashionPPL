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
        .recommendation {
            margin-top: 20px;
            background: #ffe6f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <!-- header -->
    <header>
        <a href="#" class="logo"><img src="../images/logo.png" width="auto" height="100px"></a>

        <div id="menu-bar" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="article.php">Article</a>
            <a href="about.php">About</a>
            <a href="../index.php">Logout</a>
        </nav>
    </header>

    <!-- Home Section -->
    <section class="home" id="home">
        <div class="content text-center mt-5">
            <h3>Welcome to ForecastFashion</h3>
            <p>Your personalized fashion recommendation based on weather!</p>
        </div>
    </section>

    <!-- Weather Section -->
    <section class="weather" id="weather">
        <h1 class="heading text-center">Check Weather in Your Location</h1>
        <form id="locationForm" class="text-center">
            <div class="inputBox">
                <input type="text" id="locationInput" placeholder="Enter your location" required>
                <button type="submit" class="btn btn-primary">Get Weather</button>
            </div>
        </form>
        <div id="weatherResult" class="weather-result text-center mt-3"></div>
        <div id="fashionRecommendation" class="recommendation text-center"></div>
    </section>

    <section class="footer">
        <!-- <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
        </div> -->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="weather.js"></script>
</body>
</html>
