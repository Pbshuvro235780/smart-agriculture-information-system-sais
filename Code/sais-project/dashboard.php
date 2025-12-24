<?php 
include "includes/header.php"; 
include "includes/nav.php"; 
include "backend/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="container mt-5">
  <h2 class="text-success">
    Welcome, <?php echo $_SESSION['user']['fullname'] ?? $_SESSION['user']['username']; ?> 👋
  </h2>
  <p class="lead">Here’s your personalized farming dashboard.</p>

<div class="text-center mb-4">
  <img src="images/images.jpg" 
       alt="Dashboard Banner" 
       class="img-fluid rounded shadow" 
       style="max-height:300px; width:100%; object-fit:cover;">
</div>  


  <div class="row">
    <!-- Weather Update -->
    <div class="col-md-6 mt-3">
      <div class="card shadow p-3">
        <h5>🌦 Weather Update</h5>
        <input type="text" id="city" class="form-control mb-2" placeholder="Enter city (e.g. Dhaka)">
        <button onclick="getWeather()" class="btn btn-success w-100">Get Weather</button>
        <div id="weatherResult" class="mt-3"></div>
      </div>
    </div>

    <!-- Alerts -->
    <div class="col-md-6 mt-3">
      <div class="card shadow p-3">
        <h5>⚠️ Alerts</h5>
        <p id="alertText">No alerts yet.</p>
        <button onclick="checkAlerts()" class="btn btn-danger w-100">Check Alerts</button>
      </div>
    </div>
  </div>
</div>

<!-- ✅ Weather & Alerts Script -->
<script>
async function getWeather() {
    let city = document.getElementById("city").value.trim();
    if (!city) {
        alert("Please enter a city name");
        return;
    }

    // ✅ No API key needed
    let url = `https://wttr.in/${city}?format=j1`;

    try {
        let res = await fetch(url);
        let data = await res.json();

        let weather = data.current_condition[0];
        document.getElementById("weatherResult").innerHTML = `
            <h6>🌍 ${city}</h6>
            <p>🌡 Temp: ${weather.temp_C}°C</p>
            <p>☁️ Condition: ${weather.weatherDesc[0].value}</p>
            <p>💧 Humidity: ${weather.humidity}%</p>
            <p>🌬 Wind: ${weather.windspeedKmph} km/h</p>
        `;
    } catch (err) {
        document.getElementById("weatherResult").innerHTML = 
            `<span class="text-danger">⚠️ Error fetching weather data</span>`;
    }
}

function checkAlerts() {
    let alerts = [
        "⚠️ Heavy Rain expected tomorrow.",
        "🌡 Heatwave Alert in your region.",
        "💧 Irrigation required for paddy fields."
    ];
    document.getElementById("alertText").innerHTML = alerts.join("<br>");
}
</script>

<?php include "includes/footer.php"; ?>
