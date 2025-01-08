<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForecastFashion</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: rgba(255, 111, 145, 0.9);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 10px 10px;
        }
        .navbar .logo {
            font-size: 1.6rem;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }
        .navbar .logo:hover {
            color: #ff4676;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 10px;
        }
        .nav-links li {
            display: inline;
        }
        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }
        .nav-links a:hover {
            color: #ff4676;
        }
        .container {
            max-width: 700px;
            margin: 120px auto;
            padding: 25px;
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            animation: fadeIn 2s ease-in-out;
        }
        h1 {
            color: #ff6f91;
            font-size: 2.5em;
            margin-bottom: 15px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
        p.lead {
            font-size: 1.1em;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .weather-result, .fashion-recommendation {
            margin-top: 20px;
            font-size: 1.1em;
            color: #444;
        }
        .weather-result h3, .fashion-recommendation h3 {
            font-size: 1.4em;
            color: #ff6f91;
        }
        .fashion-recommendation ul {
            text-align: center;
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }

        .fashion-recommendation li {
            margin: 6px 0;
            font-weight: 500;
            position: relative;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin-top: 100px;
            }
            h1 {
                font-size: 2.2em;
            }
            p.lead {
                font-size: 1em;
            }
            .weather-result, .fashion-recommendation {
                font-size: 1em;
            }
            .navbar .logo {
                font-size: 1.4rem;
            }
            .nav-links a {
                font-size: 0.8rem;
            }
        }
        @media (max-width: 480px) {
            .container {
                padding: 15px;
                margin-top: 80px;
            }
            h1 {
                font-size: 1.8em;
            }
            .nav-links {
                flex-direction: column;
                gap: 10px;
            }
            .nav-links a {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="logo">ForecastFashion</a>
        <ul class="nav-links">
            <li><a href="location.php">Cari Lokasi</a></li>
            <li><a href="article.php">Article</a></li>
            <!-- <li><a href="user/login.php"><i class="fas fa-user"></i> User Login</a></li> -->
        </ul>
    </nav>

    <div class="container">
        <h1>Welcome to ForecastFashion</h1>
        <p class="lead">Get real-time weather updates and perfect outfit recommendations!</p>

        <!-- Weather Result -->
        <div id="weatherResult" class="weather-result"></div>

        <!-- Fashion Recommendation -->
        <div id="fashionRecommendation" class="fashion-recommendation"></div>
    </div>

    <script>
        const weatherResult = document.getElementById("weatherResult");
        const fashionRecommendation = document.getElementById("fashionRecommendation");
        const apiKey = 'c86f8cddcf6690ea9ca1b65555b31bd8';

        function getWeather(lat, lon) {
            fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`)
                .then(response => response.json())
                .then(data => {
                    if (data.cod === 200) {
                        const temperature = data.main.temp;
                        const weather = data.weather[0].description;

                        weatherResult.innerHTML = `
                            <h3>Weather in ${data.name}</h3>
                            <p>Temperature: ${temperature}°C</p>
                            <p>Condition: ${weather}</p>
                        `;

                        if (temperature >= 30) {
                            fashionRecommendation.innerHTML = `
                                <h3>Outfit Recommendation</h3>
                                <ul>
                                    <li>T-shirts or tank tops</li>
                                    <li>Shorts or skirts</li>
                                    <li>Sandals</li>
                                    <li>Sunglasses and a hat</li>
                                </ul>
                            `;
                        } else if (temperature < 30 && temperature >= 20) {
                            fashionRecommendation.innerHTML = `
                                <h3>Outfit Recommendation</h3>
                                <ul>
                                    <li>Long-sleeve shirts</li>
                                    <li>Jeans or pants</li>
                                    <li>Sneakers</li>
                                    <li>A light jacket</li>
                                </ul>
                            `;
                        } else {
                            fashionRecommendation.innerHTML = `
                                <h3>Outfit Recommendation</h3>
                                <ul>
                                    <li>Jackets or coats</li>
                                    <li>Scarves and gloves</li>
                                    <li>Warm hats</li>
                                    <li>Boots</li>
                                </ul>
                            `;
                        }
                    } else {
                        weatherResult.innerHTML = `<p>Location not found. Please try again.</p>`;
                    }
                })
                .catch(() => {
                    weatherResult.innerHTML = `<p>Error retrieving weather data. Please try again later.</p>`;
                });
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    getWeather(lat, lon);
                }, () => {
                    weatherResult.innerHTML = `<p>Unable to retrieve your location.</p>`;
                });
            } else {
                weatherResult.innerHTML = `<p>Geolocation is not supported by your browser.</p>`;
            }
        }

        window.onload = getLocation;
    </script>
</body>
</html>
