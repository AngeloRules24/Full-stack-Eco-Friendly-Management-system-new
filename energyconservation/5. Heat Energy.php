<!-- MAHALIA'S PART  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Heat Energy Tips</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>


<?php include "../header.php"; ?>


  <!-- Hero Banner -->
  <section class="hero energy-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('heat.png') no-repeat center/cover;">
    <div class="hero-text">
      <h2>🔥 Heat Energy</h2>
      <p>
        Heat energy powers homes and industries. Learn how to conserve heat 
        and use it efficiently for a greener lifestyle.
      </p>
    </div>
  </section>

  <!-- Tips Section -->
  <section class="intro">
    <h2>Tips to Conserve and Use Heat Energy Efficiently</h2>
    <p>Here are some practical ways to save heat energy and reduce waste:</p>
  </section>

  <section class="tips-grid">
    <div class="tip-card">
      <span class="tip-icon">🏠</span>
      <div class="tip-content">
        <h3>Insulate Your Home</h3>
        <p>Proper insulation prevents heat loss in winter and keeps cool air inside during summer.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🌡️</span>
      <div class="tip-content">
        <h3>Smart Thermostats</h3>
        <p>Use programmable thermostats to optimize heating and cooling schedules.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🔥</span>
      <div class="tip-content">
        <h3>Efficient Heating Systems</h3>
        <p>Upgrade to modern heating systems like heat pumps for better energy efficiency.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🪟</span>
      <div class="tip-content">
        <h3>Seal Windows and Doors</h3>
        <p>Prevent drafts with weatherstrips and double-glazed windows to reduce heat waste.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🌞</span>
      <div class="tip-content">
        <h3>Use Passive Solar Heating</h3>
        <p>Maximize sunlight through windows to naturally warm living spaces.</p>
      </div>
    </div>
  </section>


<!-- Floating Household Heat Calculator Widget -->
<div id="heat-widget">

  <!-- Start Screen -->
  <div id="heat-start" class="heat-screen active">
    <h3>🔥 Estimate Your Household Heat Energy</h3>
    <p>Find out your approximate monthly energy consumption for heating and hot water.</p>
    <button type="button" class="heat-btn" onclick="showHeatStep('heat-form')">Start ▶</button>
  </div>

  <!-- Form Screen -->
  <div id="heat-form" class="heat-screen">
    <h3>🔥 Household Heat Calculator</h3>
    <form id="heatCalc">
      <div class="form-group">
        <label>Number of People in Household:</label>
        <input type="number" id="numPeopleHeat" placeholder="e.g. 4" required>
      </div>

      <div class="form-group">
        <label>Average Heating Hours per Day:</label>
        <input type="number" id="heatingHours" placeholder="e.g. 5" required>
      </div>

      <div class="form-group">
        <label>Average Cooking Hours per Day:</label>
        <input type="number" id="cookingHours" placeholder="e.g. 2" required>
      </div>

      <div class="form-group">
        <label>Hot Water Usage per Person per Day (Liters):</label>
        <input type="number" id="hotWater" placeholder="e.g. 50" required>
      </div>

      <div class="form-group">
        <label>Energy Cost ($ per kWh):</label>
        <input type="number" id="energyCost" step="0.01" placeholder="e.g. 0.15" required>
      </div>

      <div class="solar-nav">
        <button type="button" class="heat-btn back" onclick="backHeat()">⬅ Back</button>
        <button type="button" class="heat-btn" onclick="calcHeat()">Calculate ✅</button>
      </div>
    </form>
  </div>

  <!-- Result Screen -->
  <div id="heat-result" class="heat-screen"></div>

</div>

<style>
/* =========================
   HEAT CALCULATOR SECTION
========================= */

#heat-widget {
  position: relative;       /* no longer fixed */
  max-width: 900px;         /* flexible max width */
  width: 90%;               /* responsive width */
  margin: 2rem auto;        /* center horizontally, add space top/bottom */
  padding: 2rem;            /* internal padding */
  background: #fff3e0;
  border: 3px solid #ff9800;
  border-radius: 16px;
  box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
  font-family: Arial, sans-serif;
  overflow: hidden;
}

/* Screens */
.heat-screen {
  display: none;
  text-align: center;
  padding: 1rem;
}
.heat-screen.active {
  display: block;
}

/* Headings */
#heat-widget h3 {
  font-size: 1.4rem;
  color: #ef6c00;
  margin-bottom: 0.8rem;
}

#heat-widget p {
  font-size: 0.95rem;
  color: #444;
  margin-bottom: 1rem;
}

/* Inputs */
.form-group {
  margin-bottom: 1rem;
  text-align: left;
}
.form-group label {
  display: block;
  font-size: 0.9rem;
  font-weight: bold;
  color: #ef6c00;
  margin-bottom: 0.3rem;
}
.form-group input {
  width: 100%;
  padding: 0.5rem;
  font-size: 0.95rem;
  border: 1px solid #ffcc80;
  border-radius: 6px;
}
.form-group input:focus {
  border-color: #ef6c00;
  box-shadow: 0 0 4px rgba(239,108,0,0.3);
}

/* Buttons */
.heat-btn {
  background: #ff9800;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 0.6rem 1rem;
  font-size: 0.95rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}
.heat-btn:hover {
  background: #ef6c00;
}
.heat-btn.back {
  background: #777;
}
.heat-btn.back:hover {
  background: #555;
}

.solar-nav {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}

/* Result Box */
#heat-result {
  padding: 1rem;
  text-align: left;
  margin-top: 1rem;
}
#heat-result h3 {
  color: #ef6c00;
  margin-bottom: 0.5rem;
}
#heat-result p {
  font-size: 0.9rem;
  margin: 0.3rem 0;
}

/* Responsive */
@media (max-width: 768px) {
  #heat-widget {
    width: 95%;
    padding: 1.5rem;
    margin: 1.5rem auto;
  }

  .heat-btn {
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
}

</style>

<script>
function showHeatStep(step) {
  document.querySelectorAll('#heat-widget .heat-screen').forEach(screen => {
    screen.classList.remove('active');
  });
  document.getElementById(step).classList.add('active');
}

function backHeat() {
  document.getElementById('heatCalc').reset();
  showHeatStep('heat-start');
}

function calcHeat() {
  const numPeople = parseInt(document.getElementById('numPeopleHeat').value);
  const heatingHours = parseFloat(document.getElementById('heatingHours').value);
  const cookingHours = parseFloat(document.getElementById('cookingHours').value);
  const hotWater = parseFloat(document.getElementById('hotWater').value);
  const energyCost = parseFloat(document.getElementById('energyCost').value);

  if(isNaN(numPeople) || isNaN(heatingHours) || isNaN(cookingHours) || isNaN(hotWater) || isNaN(energyCost)) {
    showHeatStep('heat-result');
    document.getElementById('heat-result').innerHTML = "<p style='color:red;'>⚠️ Please fill in all fields.</p><button class='heat-btn back' onclick=\"showHeatStep('heat-form')\">⬅ Back</button>";
    return;
  }

  // Constants
  const heatingKWhPerHour = 1.5;
  const cookingKWhPerHour = 1.0;
  const hotWaterKWhPerLiter = 0.05;

  const dailyHeating = heatingHours * heatingKWhPerHour;
  const dailyCooking = cookingHours * cookingKWhPerHour;
  const dailyHotWater = hotWater * hotWaterKWhPerLiter * numPeople;

  const dailyTotal = dailyHeating + dailyCooking + dailyHotWater;
  const monthlyTotal = dailyTotal * 30;
  const monthlyCost = (monthlyTotal * energyCost).toFixed(2);

  // Efficiency rating
  let usageText = '';
  let usageColor = '';
  if(monthlyTotal <= 200) {
    usageText = '✅ Low energy usage. Good job!';
    usageColor = 'green';
  } else if(monthlyTotal <= 500) {
    usageText = '⚠️ Moderate energy usage. Can improve.';
    usageColor = 'orange';
  } else {
    usageText = '❌ High energy usage. Consider saving energy.';
    usageColor = 'red';
  }

  showHeatStep('heat-result');
  document.getElementById('heat-result').innerHTML = `
    <h3>🔥 Your Heat Energy Usage</h3>
    <p>🌡️ Heating: <b>${dailyHeating.toFixed(1)} kWh/day</b></p>
    <p>🍳 Cooking: <b>${dailyCooking.toFixed(1)} kWh/day</b></p>
    <p>🚿 Hot Water: <b>${dailyHotWater.toFixed(1)} kWh/day</b></p>
    <p>⚡ Total Daily Energy Use: <b>${dailyTotal.toFixed(1)} kWh</b></p>
    <p>📅 Estimated Monthly Energy Use: <b>${monthlyTotal.toFixed(1)} kWh</b></p>
    <p>💰 Estimated Monthly Cost: <b>$${monthlyCost}</b></p>
    <p style="margin-top:0.5rem; font-weight:bold; color:${usageColor};">${usageText}</p>
    <div style="margin-top:1rem;">
      <button class="heat-btn back" onclick="showHeatStep('heat-form')">⬅ Back</button>
    </div>
  `;
}
</script>



  <!-- Call to Action -->
  <section class="cta">
    <h2>Take Action Today</h2>
    <p>
      Small steps like insulation and efficient heating make a huge difference 
      in conserving heat energy and reducing emissions.
    </p>
    <a href="register.html" class="cta-btn">Join the Community</a>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 EcoNest Community | Sustainable Living Project</p>
  </footer>

  <script src="1. Main Script.js"></script>
</body>
</html>
