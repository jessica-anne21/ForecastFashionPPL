<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForecastFashion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #ff9a9e, #fecfef);
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #ff6f91;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            font-size: 1.8rem;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            white-space: nowrap; 
        }

        .navbar .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 10px;
            white-space: nowrap; 
        }

        .navbar .nav-links li {
            display: inline;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .navbar .nav-links a:hover {
            background: #ff4676;
        }

        .container {
            max-width: 800px;
            margin: 100px auto 0;
            padding: 30px;
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #ff6f91;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        p.lead {
            font-size: 1.2em;
            color: #555;
        }

        .input-group input {
            border-radius: 20px 0 0 20px;
            border: 2px solid #ff6f91;
            padding: 10px;
            width: 70%;
        }

        .input-group button {
            border-radius: 0 20px 20px 0;
            border: 2px solid #ff6f91;
            background-color: #ff6f91;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
        }

        .weather-result, .fashion-recommendation {
            margin-top: 20px;
        }

        .weather-result h3, .fashion-recommendation h3 {
            color: #ff6f91;
            font-size: 1.8em;
        }

        .weather-result p, .fashion-recommendation p {
            font-size: 1.2em;
            color: #444;
        }

        .fashion-recommendation ul {
            list-style-type: none;
            padding: 0;
        }

        .fashion-recommendation ul li {
            font-size: 1.2em;
            color: #444;
            margin-bottom: 5px;
        }

        .fashion-recommendation ul li::before {
            content: '✔ ';
            color: #ff6f91;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="logo">ForecastFashion</a>
        <ul class="nav-links">
            <li><a href="location.php">Cari Lokasi</a></li>
            <li><a href="article.php">Article</a></li>
            <!-- <li><a href="user/login.php"><i class="fas fa-user"></i> User Login</a></li> -->
        </ul>
    </nav>

    <!-- Weather and Fashion Recommendation -->
    <div class="container">
        <h1>Welcome to ForecastFashion</h1>
        <p class="lead">Get real-time weather updates and perfect outfit recommendations!</p>

        <!-- Weather Input Form -->
        <form id="locationForm" class="mb-4">
            <div class="input-group">
                <input type="text" id="locationInput" placeholder="Enter your location" required>
                <button type="submit">Get Weather</button>
            </div>
        </form>

        <!-- Weather Result -->
        <div id="weatherResult" class="weather-result"></div>

        <!-- Fashion Recommendation -->
        <div id="fashionRecommendation" class="fashion-recommendation"></div>
    </div>

    <script>
        document.getElementById("locationForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const location = document.getElementById('locationInput').value;
            const apiKey = 'c86f8cddcf6690ea9ca1b65555b31bd8';
            const weatherResult = document.getElementById("weatherResult");
            const fashionRecommendation = document.getElementById("fashionRecommendation");

            // Clear previous results
            weatherResult.innerHTML = "Loading...";
            fashionRecommendation.innerHTML = "";

            // Fetch weather data
            fetch(`https://api.openweathermap.org/data/2.5/weather?q=${location}&appid=${apiKey}&units=metric`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.cod === 200) {
                        const temperature = data.main.temp;
                        const weather = data.weather[0].description;

                        weatherResult.innerHTML = `
                            <h3>Weather in ${data.name}</h3>
                            <p>Temperature: ${temperature}°C</p>
                            <p>Condition: ${weather}</p>
                        `;

                        // Fashion recommendation
                        if (temperature >= 30) {
                            fashionRecommendation.innerHTML = `
                                <h3>Outfit Recommendation</h3>
                                <p>It's hot! Wear light and breathable clothes like:</p>
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
                                <p>The weather is mild. Consider wearing:</p>
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
                                <p>It's cold! Stay warm with:</p>
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
        });
    </script>
</body>
</html>