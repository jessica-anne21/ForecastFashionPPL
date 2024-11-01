document.getElementById('locationForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    
    const location = document.getElementById('locationInput').value;
    const apiKey = 'c86f8cddcf6690ea9ca1b65555b31bd8'; 
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${location}&appid=${apiKey}&units=metric`;

    try {
        const response = await fetch(url);
        if (!response.ok) throw new Error("Location not found");
        
        const weatherData = await response.json();
        displayWeather(weatherData);
    } catch (error) {
        document.getElementById('weatherResult').innerHTML = `<p>Unable to fetch weather data: ${error.message}</p>`;
    }
});

function displayWeather(data) {
    const weatherResult = document.getElementById('weatherResult');
    const { name, main, weather } = data;
    
    weatherResult.innerHTML = `
        <h2>Weather in ${name}</h2>
        <p>Temperature: ${main.temp} °C</p>
        <p>Humidity: ${main.humidity}%</p>
        <p>Condition: ${weather[0].description}</p>
        <img src="https://openweathermap.org/img/wn/${weather[0].icon}.png" alt="${weather[0].description}">
    `;
}


