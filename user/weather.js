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
                    <h3 style="font-size: 2em; margin-bottom: 10px;">Weather in ${data.name}</h3>
                    <p style="font-size: 1.5em;">Temperature: ${temperature}°C</p>
                    <p style="font-size: 1.5em;">Condition: ${weather}</p>
                `;

                // Fashion recommendation
                if (temperature >= 30) {
                    fashionRecommendation.innerHTML = `
                        <h3 style="font-size: 2em; margin-bottom: 10px;">Fashion Recommendation</h3>
                        <p style="font-size: 1.8em;">It's hot! Wear light and breathable clothes like:</p>
                        <ul style="font-size: 1.5em; text-align: left; display: inline-block;">
                            <li>T-shirts or tank tops</li>
                            <li>Shorts or skirts</li>
                            <li>Sandals</li>
                            <li>Sunglasses and a hat</li>
                        </ul>
                    `;
                } else if (temperature < 30 && temperature >= 20) {
                    fashionRecommendation.innerHTML = `
                        <h3 style="font-size: 2em; margin-bottom: 10px;">Fashion Recommendation</h3>
                        <p style="font-size: 1.8em;">The weather is mild. Consider wearing:</p>
                        <ul style="font-size: 1.5em; text-align: left; display: inline-block;">
                            <li>Long-sleeve shirts</li>
                            <li>Jeans or pants</li>
                            <li>Sneakers</li>
                            <li>A light jacket</li>
                        </ul>
                    `;
                } else {
                    fashionRecommendation.innerHTML = `
                        <h3 style="font-size: 2em; margin-bottom: 10px;">Fashion Recommendation</h3>
                        <p style="font-size: 1.8em;">It's cold! Stay warm with:</p>
                        <ul style="font-size: 1.5em; text-align: left; display: inline-block;">
                            <li>Jackets or coats</li>
                            <li>Scarves and gloves</li>
                            <li>Warm hats</li>
                            <li>Boots</li>
                        </ul>
                    `;
                }
            } else {
                weatherResult.innerHTML = `<p style="font-size: 1.5em;">Location not found. Please try again.</p>`;
            }
        })
        .catch(() => {
            weatherResult.innerHTML = `<p style="font-size: 1.5em;">Error retrieving weather data. Please try again later.</p>`;
        });
});
