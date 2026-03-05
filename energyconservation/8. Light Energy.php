<!-- MAHALIA'S PART  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Light Energy Tips</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>


<?php include "../header.php"; ?>

  <!-- Hero Banner -->
  <section class="hero energy-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('light.png') no-repeat center/cover;">
    <div class="hero-text">
      <h2>💡 Light Energy</h2>
      <p>
        Light energy is essential for vision, health, and daily living. 
        Using it efficiently reduces energy waste and promotes sustainability.
      </p>
    </div>
  </section>

  <!-- Tips Section -->
  <section class="intro">
    <h2>Tips for Conserving and Using Light Energy Wisely</h2>
    <p>Here are some simple and effective ways to manage light energy at home and in the community:</p>
  </section>

  <section class="tips-grid">
    <div class="tip-card">
      <span class="tip-icon">💡</span>
      <div class="tip-content">
        <h3>Switch to LED Bulbs</h3>
        <p>LEDs consume less energy, last longer, and provide better lighting compared to traditional bulbs.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">☀️</span>
      <div class="tip-content">
        <h3>Use Natural Daylight</h3>
        <p>Open curtains and blinds during the day to reduce the need for artificial lighting.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🔌</span>
      <div class="tip-content">
        <h3>Turn Off When Not in Use</h3>
        <p>Get into the habit of switching off lights when leaving a room to prevent unnecessary energy waste.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🎛️</span>
      <div class="tip-content">
        <h3>Install Dimmers and Sensors</h3>
        <p>Use smart lighting systems to adjust brightness automatically based on time or occupancy.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🌍</span>
      <div class="tip-content">
        <h3>Community Lighting Initiatives</h3>
        <p>Support efforts to replace streetlights with energy-efficient alternatives like solar-powered LEDs.</p>
      </div>
    </div>
  </section>



<!-- Floating Light Energy Calculator Widget -->
<div id="light-widget">

  <!-- Start Screen -->
  <div id="light-start" class="light-screen active">
    <h3>💡 Estimate Your Household Light Energy</h3>
    <p>Calculate your daily and monthly lighting energy consumption and cost.</p>
    <button type="button" class="light-btn" onclick="showLightStep('light-form')">Start ▶</button>
  </div>

  <!-- Form Screen -->
  <div id="light-form" class="light-screen">
    <h3>💡 Light Energy Calculator</h3>
    <form id="lightCalc">
      <div class="form-group">
        <label>Number of People in Household:</label>
        <input type="number" id="numPeopleLight" placeholder="e.g. 4" required>
      </div>

      <div class="form-group">
        <label>Average Daily Light Hours:</label>
        <input type="number" id="lightHours" placeholder="e.g. 5" required>
      </div>

      <div class="form-group">
        <label>Number of Light Bulbs:</label>
        <input type="number" id="numBulbs" placeholder="e.g. 10" required>
      </div>

      <div class="form-group">
        <label>Bulb Wattage (W):</label>
        <input type="number" id="bulbWatt" placeholder="e.g. 15" required>
      </div>

      <div class="form-group">
        <label>Electricity Cost ($/kWh):</label>
        <input type="number" id="costLight" step="0.01" placeholder="e.g. 0.15" required>
      </div>

      <div class="solar-nav">
        <button type="button" class="light-btn back" onclick="backLight()">⬅ Back</button>
        <button type="button" class="light-btn" onclick="calcLight()">Calculate ✅</button>
      </div>
    </form>
  </div>

  <!-- Result Screen -->
  <div id="light-result" class="light-screen"></div>

</div>

<style>
/* =========================
   LIGHT CALCULATOR SECTION
========================= */

#light-widget {
  position: relative;       /* no longer fixed */
  max-width: 900px;         /* flexible max width */
  width: 90%;               /* responsive width */
  margin: 2rem auto;        /* center horizontally, space top/bottom */
  padding: 2rem;            /* internal padding */
  background: #fffde7;
  border: 3px solid #fdd835;
  border-radius: 16px;
  box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
  font-family: Arial, sans-serif;
  overflow: hidden;
}

/* Screens */
.light-screen {
  display: none;
  padding: 1rem;
  text-align: center;
}
.light-screen.active {
  display: block;
}

/* Headings */
#light-widget h3 {
  font-size: 1.4rem;
  color: #f9a825;
  margin-bottom: 0.8rem;
}

#light-widget p {
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
  color: #f9a825;
  margin-bottom: 0.3rem;
}
.form-group input {
  width: 100%;
  padding: 0.5rem;
  font-size: 0.95rem;
  border: 1px solid #fff59d;
  border-radius: 6px;
}
.form-group input:focus {
  border-color: #f9a825;
  box-shadow: 0 0 4px rgba(249,168,37,0.3);
}

/* Buttons */
.light-btn {
  background: #fdd835;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 0.6rem 1rem;
  font-size: 0.95rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}
.light-btn:hover {
  background: #f9a825;
}
.light-btn.back {
  background: #777;
}
.light-btn.back:hover {
  background: #555;
}

.solar-nav {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}

/* Result Box */
#light-result {
  padding: 1rem;
  text-align: left;
  margin-top: 1rem;
}
#light-result h3 {
  color: #f9a825;
  margin-bottom: 0.5rem;
}
#light-result p {
  font-size: 0.9rem;
  margin: 0.3rem 0;
}

/* Responsive */
@media (max-width: 768px) {
  #light-widget {
    width: 95%;
    padding: 1.5rem;
    margin: 1.5rem auto;
  }

  .light-btn {
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
}

</style>

<script>
function showLightStep(step) {
  document.querySelectorAll('#light-widget .light-screen').forEach(screen => {
    screen.classList.remove('active');
  });
  document.getElementById(step).classList.add('active');
}

function backLight() {
  document.getElementById('lightCalc').reset();
  showLightStep('light-start');
}

function calcLight() {
  const numPeople = parseInt(document.getElementById('numPeopleLight').value);
  const hours = parseFloat(document.getElementById('lightHours').value);
  const numBulbs = parseInt(document.getElementById('numBulbs').value);
  const bulbWatt = parseFloat(document.getElementById('bulbWatt').value);
  const cost = parseFloat(document.getElementById('costLight').value);

  if(isNaN(numPeople) || isNaN(hours) || isNaN(numBulbs) || isNaN(bulbWatt) || isNaN(cost)) {
    showLightStep('light-result');
    document.getElementById('light-result').innerHTML = "<p style='color:red;'>⚠️ Please fill in all fields.</p><button class='light-btn back' onclick=\"showLightStep('light-form')\">⬅ Back</button>";
    return;
  }

  const dailyEnergy = (numBulbs * bulbWatt * hours * numPeople) / 1000;
  const monthlyEnergy = dailyEnergy * 30;
  const yearlyEnergy = dailyEnergy * 365;
  const monthlyCost = (monthlyEnergy * cost).toFixed(2);
  const yearlyCost = (yearlyEnergy * cost).toFixed(2);

  let efficiencyText = '';
  let efficiencyColor = '';
  if(monthlyEnergy <= 50) {
    efficiencyText = '✅ Low energy use. Efficient lighting!';
    efficiencyColor = 'green';
  } else if(monthlyEnergy <= 100) {
    efficiencyText = '⚠️ Moderate energy use. Could improve efficiency.';
    efficiencyColor = 'orange';
  } else {
    efficiencyText = '❌ High energy use. Consider reducing lighting or using LED bulbs.';
    efficiencyColor = 'red';
  }

  showLightStep('light-result');
  document.getElementById('light-result').innerHTML = `
    <h3>💡 Your Light Energy Results</h3>
    <p>💡 Daily Energy: <b>${dailyEnergy.toFixed(2)} kWh</b></p>
    <p>📅 Monthly Energy: <b>${monthlyEnergy.toFixed(1)} kWh</b></p>
    <p>📆 Yearly Energy: <b>${yearlyEnergy.toFixed(1)} kWh</b></p>
    <p>💰 Monthly Cost: <b>$${monthlyCost}</b></p>
    <p>💰 Yearly Cost: <b>$${yearlyCost}</b></p>
    <p style="margin-top:0.5rem; font-weight:bold; color:${efficiencyColor};">${efficiencyText}</p>
    <div style="margin-top:1rem;">
      <button class="light-btn back" onclick="showLightStep('light-form')">⬅ Back</button>
    </div>
  `;
}
</script>







  <!-- Call to Action -->
  <section class="cta">
    <h2>Shine Responsibly</h2>
    <p>
      Small changes in how we use light energy can significantly cut electricity bills 
      and protect the planet.
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
