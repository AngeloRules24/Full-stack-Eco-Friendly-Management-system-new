<!-- MAHALIA'S PART  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Wind Energy Tips</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>

<?php include "../header.php"; ?>


  <!-- Hero Banner -->
  <section class="hero energy-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('wind.png') no-repeat center/cover;">
    <div class="hero-text">
      <h2>🌬️ Wind Energy</h2>
      <p>
        Wind energy is powerful, renewable, and clean. Learn how wind power 
        can help reduce fossil fuel dependency and create a sustainable future.
      </p>
    </div>
  </section>

  <!-- Tips Section -->
  <section class="intro">
    <h2>Tips to Harness and Conserve Wind Energy</h2>
    <p>Here are some effective ways to make use of wind energy:</p>
  </section>

 <section class="tips-grid">
  <div class="tip-card">
    <span class="tip-icon">🌪️</span>
    <div class="tip-content">
      <h3>Install Wind Turbines</h3>
      <p>Use small wind turbines for homes or communities to generate renewable electricity.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">🏘️</span>
    <div class="tip-content">
      <h3>Community Wind Projects</h3>
      <p>Join local cooperatives to share resources and reduce setup costs.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">⚡</span>
    <div class="tip-content">
      <h3>Hybrid Energy Systems</h3>
      <p>Combine wind with solar for more reliable and sustainable energy supply.</p>
    </div>
  </div>
</section>




<!-- Floating Wind Energy Calculator Widget -->
<div id="wind-widget">

  <!-- Start Screen -->
  <div id="wind-start" class="wind-screen active">
    <h3>💨 Want to know your Wind Power Potential?</h3>
    <p>Find out how much energy and money you can save with wind turbines.</p>
    <button type="button" class="wind-btn" onclick="showWindStep('wind-form')">Start ▶</button>
  </div>

  <!-- Form Screen -->
  <div id="wind-form" class="wind-screen">
    <h3>💨 Wind Energy Calculator</h3>
    <form id="windCalc">
      <div class="form-group">
        <label>Daily electricity use (kWh):</label>
        <input type="number" id="windUsage" placeholder="e.g. 30" required>
      </div>

      <div class="form-group">
        <label>Average wind speed (m/s):</label>
        <input type="number" id="windSpeed" step="0.1" placeholder="e.g. 6" required>
      </div>

      <div class="form-group">
        <label>Rotor diameter (m):</label>
        <input type="number" id="rotorDia" step="0.1" placeholder="e.g. 5" required>
      </div>

      <div class="form-group">
        <label>Number of turbines:</label>
        <input type="number" id="numTurbines" placeholder="e.g. 2" required>
      </div>

      <div class="form-group">
        <label>Electricity cost ($ per kWh):</label>
        <input type="number" id="windCost" step="0.01" placeholder="e.g. 0.15" required>
      </div>

      <div class="solar-nav">
        <button type="button" class="wind-btn back" onclick="backWindStart()">⬅ Back</button>
        <button type="button" class="wind-btn" onclick="calcWind()">Calculate ✅</button>
      </div>
    </form>
  </div>

  <!-- Result Screen -->
  <div id="wind-result" class="wind-screen"></div>

</div>

<style>
/* =========================
   WIND CALCULATOR SECTION
========================= */

#wind-widget {
  position: relative;       /* no longer fixed */
  max-width: 900px;         /* flexible width for large screens */
  width: 90%;               /* responsive width */
  margin: 2rem auto;        /* center horizontally and give space above/below */
  padding: 2rem;            /* internal padding */
  background: #f0faff;
  border: 3px solid #0099cc;
  border-radius: 16px;
  box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
  font-family: Arial, sans-serif;
  overflow: hidden;
}

/* Screens */
.wind-screen {
  display: none;
  text-align: center;
  padding: 1rem;
}
.wind-screen.active {
  display: block;
}

/* Headings */
#wind-widget h3 {
  font-size: 1.4rem;
  color: #006699;
  margin-bottom: 0.8rem;
}

#wind-widget p {
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
  color: #006699;
  margin-bottom: 0.3rem;
}
.form-group input {
  width: 100%;
  padding: 0.5rem;
  font-size: 0.95rem;
  border: 1px solid #a0d4f7;
  border-radius: 6px;
}
.form-group input:focus {
  border-color: #006699;
  box-shadow: 0 0 4px rgba(0,102,153,0.3);
}

/* Buttons */
.wind-btn {
  background: #0099cc;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 0.6rem 1rem;
  font-size: 0.95rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}
.wind-btn:hover {
  background: #007399;
}
.wind-btn.back {
  background: #777;
}
.wind-btn.back:hover {
  background: #555;
}

.solar-nav {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}

/* Result Box */
#wind-result {
  padding: 1rem;
  text-align: left;
  margin-top: 1rem;
}
#wind-result h3 {
  color: #006699;
  margin-bottom: 0.5rem;
}
#wind-result p {
  font-size: 0.9rem;
  margin: 0.3rem 0;
}

/* Responsive */
@media (max-width: 768px) {
  #wind-widget {
    width: 95%;
    padding: 1.5rem;
    margin: 1.5rem auto;
  }

  .wind-btn {
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
}

</style>

<script>
function showWindStep(step) {
  document.querySelectorAll('#wind-widget .wind-screen').forEach(screen => {
    screen.classList.remove('active');
  });
  document.getElementById(step).classList.add('active');
}

// Back button clears form fields
function backWindStart() {
  document.getElementById('windCalc').reset();
  showWindStep('wind-start');
}

function calcWind() {
  const usage = parseFloat(document.getElementById('windUsage').value);
  const windSpeed = parseFloat(document.getElementById('windSpeed').value);
  const rotorDia = parseFloat(document.getElementById('rotorDia').value);
  const numTurbines = parseInt(document.getElementById('numTurbines').value);
  const cost = parseFloat(document.getElementById('windCost').value);

  if(isNaN(usage) || isNaN(windSpeed) || isNaN(rotorDia) || isNaN(numTurbines) || isNaN(cost)) {
    showWindStep('wind-result');
    document.getElementById('wind-result').innerHTML = "<p style='color:red;'>⚠️ Please fill in all fields.</p><button class='wind-btn back' onclick=\"showWindStep('wind-form')\">⬅ Back</button>";
    return;
  }

  // Wind power calculation simplified
  const airDensity = 1.225; // kg/m^3
  const radius = rotorDia / 2;
  const rotorArea = Math.PI * radius * radius; // m^2
  const powerPerTurbine = 0.5 * airDensity * rotorArea * Math.pow(windSpeed, 3) / 1000; // kW
  const dailyWindKWh = powerPerTurbine * 24 * numTurbines; // 24 hours generation
  const monthlyWindKWh = dailyWindKWh * 30;
  const yearlyWindKWh = dailyWindKWh * 365;
  const offsetPercent = ((dailyWindKWh / usage) * 100).toFixed(1);
  const monthlySavings = (monthlyWindKWh * cost).toFixed(2);
  const yearlySavings = (yearlyWindKWh * cost).toFixed(2);

  // Efficiency rating
  let efficiencyText = '';
  let efficiencyColor = '';
  if (offsetPercent >= 80) {
    efficiencyText = '✅ Excellent! Your wind setup covers most of your usage.';
    efficiencyColor = 'green';
  } else if (offsetPercent >= 40) {
    efficiencyText = '⚠️ Moderate. Your wind setup covers some of your usage.';
    efficiencyColor = 'orange';
  } else {
    efficiencyText = '❌ Low. Your wind setup covers only a small fraction of your usage.';
    efficiencyColor = 'red';
  }

  showWindStep('wind-result');
  document.getElementById('wind-result').innerHTML = `
    <h3>💨 Your Wind Results</h3>
    <p>🔋 Daily Wind Generation: <b>${dailyWindKWh.toFixed(2)} kWh</b></p>
    <p>📅 Monthly Wind Generation: <b>${monthlyWindKWh.toFixed(1)} kWh</b></p>
    <p>📆 Yearly Wind Generation: <b>${yearlyWindKWh.toFixed(1)} kWh</b></p>
    <p>🌬️ Wind covers about <b>${offsetPercent}%</b> of your daily usage.</p>
    <p>💰 Monthly Savings: <b>$${monthlySavings}</b></p>
    <p>💰 Yearly Savings: <b>$${yearlySavings}</b></p>
    <p style="margin-top:0.5rem; font-weight:bold; color:${efficiencyColor};">${efficiencyText}</p>
    <div style="margin-top:1rem;">
      <button class="wind-btn back" onclick="showWindStep('wind-form')">⬅ Back</button>
    </div>
  `;
}
</script>





  <!-- Call to Action -->
  <section class="cta">
    <h2>Take Action Today</h2>
    <p>
      Support wind energy initiatives in your area and help shift to clean power.
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
