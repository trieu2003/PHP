<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <style>
        :root {
            --gradient: linear-gradient(135deg, #72EDF2 10%, #5151E5 100%);
        }

        * {
            box-sizing: border-box;
            line-height: 1.25em;
        }

        .clear {
            clear: both;
        }

        body {
            margin: 0;
            width: 100%;
            height: 100vh;
            font-family: 'Montserrat', sans-serif;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            border-radius: 25px;
            box-shadow: 0 0 70px -10px rgba(0, 0, 0, 0.2);
            background-color: #222831;
            color: #ffffff;
            height: 400px;
            display: flex;
            overflow: hidden;
        }

        .weather-side {
            position: relative;
            height: 100%;
            border-radius: 25px;
            background-image: url("https://img.freepik.com/free-photo/sunset-beach-sea-wave_1150-11145.jpg");
            width: 300px;
            box-shadow: 0 0 20px -10px rgba(0, 0, 0, 0.2);
            transition: transform 300ms ease;
            transform: translateZ(0) scale(1.02) perspective(1000px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 25px;
        }

        .weather-side:hover {
            transform: scale(1.1) perspective(1500px) rotateY(10deg);
        }

        .weather-gradient {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image: var(--gradient);
            border-radius: 25px;
            opacity: 0.4;
        }

        .date-container {
            z-index: 1;
        }

        .date-dayname {
            margin: 0;
        }

        .date-day {
            display: block;
        }

        .location {
            display: inline-block;
            margin-top: 10px;
        }

        .weather-container {
            z-index: 1;
            text-align: center;
        }

        .weather-icon {
            margin-bottom: 15px;
        }

        .weather-icon img {
            filter: drop-shadow(0 0 2px #fff);
            width: 100px;
        }

        .weather-temp {
            margin: 0;
            font-weight: 700;
            font-size: 4em;
        }

        .weather-desc {
            margin: 0;
        }

        .info-side {
            flex: 1;
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .today-info-container, .week-container, .location-container {
            margin-bottom: 20px;
        }

        .today-info {
            padding: 15px;
            margin: 0 25px 25px 25px;
            box-shadow: 0 0 50px -5px rgba(0, 0, 0);
            border-radius: 10px;
        }

        .today-info>div:not(:last-child) {
            margin: 0 0 10px 0;
        }

        .today-info>div .title {
            float: left;
            font-weight: 700;
        }

        .today-info>div .value {
            float: right;
        }

        .week-list {
            list-style-type: none;
            padding: 0;
            margin: 10px 35px;
            box-shadow: 0 0 50px -5px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
        }

        .week-list>li {
            padding: 15px;
            cursor: pointer;
            transition: 200ms ease;
            border-radius: 10px;
            text-align: center;
        }

        .week-list>li:hover {
            transform: scale(1.1);
            background: #fff;
            color: #222831;
            box-shadow: 0 0 40px -5px rgba(0, 0, 0, 0.2);
        }

        .week-list>li.active {
            background: #fff;
            color: #222831;
            border-radius: 10px;
        }

        .day-name, .day-temp {
            display: block;
            margin: 10px 0;
        }

        .day-icon img {
            filter: drop-shadow(0 0 2px white);
            width: 50px;
        }

        .location-container {
            padding: 25px 35px;
        }

        .location-input {
            width: 100%;
            border: none;
            border-radius: 25px;
            padding: 10px;
            font-family: 'Montserrat', sans-serif;
            background-image: var(--gradient);
            color: #000000;
            font-weight: 700;
            box-shadow: 0 0 30px -5px rgba(0, 0, 0, 0.25);
            transition: transform 200ms ease;
        }

        .location-input:hover {
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <a href="../../index.php" target="_blank">Trang chu</a>
    <div class="container">
        <div class="weather-side">
            <div class="weather-gradient"></div>
            <div class="date-container">
                <h2 class="date-dayname"></h2>
                <span class="date-day"></span>
                <i class="fa-solid fa-location-dot"></i>
                <span class="location"></span>
            </div>
            <div class="weather-container">
                <span class="weather-icon"></span>
                <h1 class="weather-temp"></h1>
                <h3 class="weather-desc"></h3>
            </div>
        </div>
        <div class="info-side">
            <div class="today-info-container">
                <div class="today-info">
                    <div class="humidity">
                        <span class="title"><i class="fa-solid fa-droplet"></i> HUMIDITY</span>
                        <span class="value"></span>
                        <div class="clear"></div>
                    </div>
                    <div class="wind">
                        <span class="title"><i class="fa-solid fa-wind"></i> WIND</span>
                        <span class="value"></span>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="week-container">
                <ul class="week-list">
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="location-container">
                <input class="location-input" type="text" id="city" value="New York">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('city').addEventListener('input', function () {
            var city = this.value;
            getWeather(city);
        });

        async function getWeather() {
            try {
                var city = document.getElementById('city').value;
                console.log('City name:', city);

                const response = await axios.get('https://api.openweathermap.org/data/2.5/forecast', {
                    params: {
                        q: city,
                        appid: '54a57bc234ad752a4f59e59cd372201d',
                        units: 'metric'
                    },
                });
                const currentTemperature = response.data.list[0].main.temp;

                document.querySelector('.weather-temp').textContent = Math.round(currentTemperature) + 'ºC';

                const forecastData = response.data.list;

                const dailyForecast = {};
                forecastData.forEach((data) => {
                    const day = new Date(data.dt * 1000).toLocaleDateString('en-US', { weekday: 'long' });
                    if (!dailyForecast[day]) {
                        dailyForecast[day] = {
                            minTemp: data.main.temp_min,
                            maxTemp: data.main.temp_max,
                            description: data.weather[0].description,
                            humidity: data.main.humidity,
                            windSpeed: data.wind.speed,
                            icon: data.weather[0].icon,
                        };
                    } else {
                        dailyForecast[day].minTemp = Math.min(dailyForecast[day].minTemp, data.main.temp_min);
                        dailyForecast[day].maxTemp = Math.max(dailyForecast[day].maxTemp, data.main.temp_max);
                    }
                });

                document.querySelector('.date-dayname').textContent = new Date().toLocaleDateString('en-US', { weekday: 'long' });

                const date = new Date().toUTCString();
                const extractedDateTime = date.slice(5, 16);
                document.querySelector('.date-day').textContent = extractedDateTime.toLocaleString('en-US');

                const currentWeatherIconCode = dailyForecast[new Date().toLocaleDateString('en-US', { weekday: 'long' })].icon;
                const weatherIconElement = document.querySelector('.weather-icon');
                weatherIconElement.innerHTML = getWeatherIcon(currentWeatherIconCode);

                document.querySelector('.location').textContent = response.data.city.name;
                document.querySelector('.weather-desc').textContent = dailyForecast[new Date().toLocaleDateString('en-US', { weekday: 'long' })].description.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

                document.querySelector('.humidity .value').textContent = dailyForecast[new Date().toLocaleDateString('en-US', { weekday: 'long' })].humidity + ' %';
                document.querySelector('.wind .value').textContent = dailyForecast[new Date().toLocaleDateString('en-US', { weekday: 'long' })].windSpeed + ' m/s';

                const dayElements = document.querySelectorAll('.day-name');
                const tempElements = document.querySelectorAll('.day-temp');
                const iconElements = document.querySelectorAll('.day-icon');

                dayElements.forEach((dayElement, index) => {
                    const day = Object.keys(dailyForecast)[index];
                    const data = dailyForecast[day];
                    dayElement.textContent = day;
                    tempElements[index].textContent = `${Math.round(data.minTemp)}º / ${Math.round(data.maxTemp)}º`;
                    iconElements[index].innerHTML = getWeatherIcon(data.icon);
                });

            } catch (error) {
                console.error('Error fetching data:', error.message);
            }
        }

        function getWeatherIcon(iconCode) {
            const iconBaseUrl = 'https://openweathermap.org/img/wn/';
            const iconSize = '@2x.png';
            return `<img src="${iconBaseUrl}${iconCode}${iconSize}" alt="Weather Icon">`;
        }

        document.addEventListener("DOMContentLoaded", function () {
            getWeather();
            setInterval(getWeather, 900000); // Refresh every 15 minutes
        });
    </script>
</body>
</html>
