<!-- MAHALIA'S PART  -->



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Solar Energy Tips</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>

<?php include "../header.php"; ?>

  <!-- Hero Banner -->
  <section class="hero energy-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('solar.png') no-repeat center/cover;">
    <div class="hero-text">
      <h2>☀️ Solar Energy</h2>
      <p>
        Solar energy is one of the cleanest renewable sources. Learn how to
        conserve and maximize solar power for a sustainable lifestyle.
      </p>
    </div>
  </section>

  <!-- Tips Section -->
  <section class="intro">
    <h2>Tips to Conserve and Use Solar Energy Efficiently</h2>
    <p>Here are some practical ways to save energy and make the most of solar power:</p>
  </section>

 <section class="tips-grid">
  <div class="tip-card">
    <span class="tip-icon">💡</span>
    <div class="tip-content">
      <h3>Install Solar Panels</h3>
      <p>Use rooftop solar panels to generate electricity for your home and reduce reliance on fossil fuels.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">🔋</span>
    <div class="tip-content">
      <h3>Invest in Solar Batteries</h3>
      <p>Store excess solar energy during the day to use at night or during cloudy weather.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">🏠</span>
    <div class="tip-content">
      <h3>Maximize Sunlight Indoors</h3>
      <p>Design your home with skylights and south-facing windows to reduce artificial lighting needs.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">⚡</span>
    <div class="tip-content">
      <h3>Use Solar-Powered Appliances</h3>
      <p>Adopt solar water heaters, lanterns, and chargers to reduce electrical energy usage.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">🌍</span>
    <div class="tip-content">
      <h3>Community Solar Programs</h3>
      <p>Join local solar projects to share clean energy benefits and lower costs collectively.</p>
    </div>
  </div>


  
</section>






<!-- Floating Solar Calculator Widget -->
<div id="solar-widget">

  <!-- Start Screen -->
  <div id="solar-start" class="solar-screen active">
    <h3>☀️ Want to know your Solar Power Potential?</h3>
    <p>Find out how much energy and money you can save with solar panels.</p>
    <button type="button" class="solar-btn" onclick="showSolarStep('solar-form')">Start ▶</button>
  </div>

  <!-- Form Screen -->
  <div id="solar-form" class="solar-screen">
    <h3>☀️ Solar Energy Calculator</h3>
    <form id="solarCalc">
      <div class="form-group">
        <label>Daily electricity use (kWh):</label>
        <input type="number" id="usage" placeholder="e.g. 30" required>
      </div>

      <div class="form-group">
        <label>Average sunlight hours per day:</label>
        <input type="number" id="sunHours" placeholder="e.g. 5" required>
      </div>

      <div class="form-group">
        <label>Solar panel wattage (W):</label>
        <input type="number" id="panelWatt" placeholder="e.g. 300" required>
      </div>

      <div class="form-group">
        <label>Number of panels:</label>
        <input type="number" id="numPanels" placeholder="e.g. 10" required>
      </div>

      <div class="form-group">
        <label>Electricity cost ($ per kWh):</label>
        <input type="number" id="cost" step="0.01" placeholder="e.g. 0.15" required>
      </div>

      <div class="solar-nav">
        <button type="button" class="solar-btn back" onclick="backToStart()">⬅ Back</button>
        <button type="button" class="solar-btn" onclick="calcSolar()">Calculate ✅</button>
      </div>
    </form>
  </div>

  <!-- Result Screen -->
  <div id="solar-result" class="solar-screen"></div>

</div>

<style>
/* =========================
   SOLAR CALCULATOR SECTION
========================= */

#solar-widget {
  position: relative;       /* no longer fixed */
  max-width: 900px;         /* flexible width for large screens */
  width: 90%;               /* responsive width */
  margin: 2rem auto;        /* center horizontally and give space above/below */
  padding: 2rem;            /* internal padding */
  background: #f9fff9;
  border: 3px solid #00b636;
  border-radius: 16px;
  box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
  font-family: Arial, sans-serif;
  overflow: hidden;
}

/* Screens */
.solar-screen {
  display: none;
  text-align: center;
  padding: 1rem;
}
.solar-screen.active {
  display: block;
}

/* Headings */
#solar-widget h3 {
  font-size: 1.4rem;
  color: #2e7d32;
  margin-bottom: 0.8rem;
}

#solar-widget p {
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
  color: #2e7d32;
  margin-bottom: 0.3rem;
}
.form-group input {
  width: 100%;
  padding: 0.5rem;
  font-size: 0.95rem;
  border: 1px solid #cce5cc;
  border-radius: 6px;
}
.form-group input:focus {
  border-color: #2e7d32;
  box-shadow: 0 0 4px rgba(46,125,50,0.3);
}

/* Buttons */
.solar-btn {
  background: #1db525;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 0.6rem 1rem;
  font-size: 0.95rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}
.solar-btn:hover {
  background: #256628;
}
.solar-btn.back {
  background: #777;
}
.solar-btn.back:hover {
  background: #555;
}

.solar-nav {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}

/* Result Box */
#solar-result {
  padding: 1rem;
  text-align: left;
  margin-top: 1rem;
}
#solar-result h3 {
  color: #2e7d32;
  margin-bottom: 0.5rem;
}
#solar-result p {
  font-size: 0.9rem;
  margin: 0.3rem 0;
}

/* Responsive */
@media (max-width: 768px) {
  #solar-widget {
    width: 95%;
    padding: 1.5rem;
    margin: 1.5rem auto;
  }

  .solar-btn {
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
}

</style>

<script>
function showSolarStep(step) {
  document.querySelectorAll('#solar-widget .solar-screen').forEach(screen => {
    screen.classList.remove('active');
  });
  document.getElementById(step).classList.add('active');
}

// Back button clears form fields
function backToStart() {
  document.getElementById('solarCalc').reset();
  showSolarStep('solar-start');
}

function calcSolar() {
  let usage = parseFloat(document.getElementById('usage').value);
  let sunHours = parseFloat(document.getElementById('sunHours').value);
  let panelWatt = parseFloat(document.getElementById('panelWatt').value);
  let numPanels = parseInt(document.getElementById('numPanels').value);
  let cost = parseFloat(document.getElementById('cost').value);

  if(isNaN(usage) || isNaN(sunHours) || isNaN(panelWatt) || isNaN(numPanels) || isNaN(cost)) {
    showSolarStep('solar-result');
    document.getElementById('solar-result').innerHTML = "<p style='color:red;'>⚠️ Please fill in all fields.</p><button class='solar-btn back' onclick=\"showSolarStep('solar-form')\">⬅ Back</button>";
    return;
  }

  let dailySolarKWh = (panelWatt * numPanels * sunHours) / 1000;
  let monthlySolarKWh = dailySolarKWh * 30;
  let yearlySolarKWh = dailySolarKWh * 365;
  let offsetPercent = ((dailySolarKWh / usage) * 100).toFixed(1);
  let monthlySavings = (monthlySolarKWh * cost).toFixed(2);
  let yearlySavings = (yearlySolarKWh * cost).toFixed(2);

  // Determine efficiency rating
  let efficiencyText = '';
  let efficiencyColor = '';
  if (offsetPercent >= 80) {
    efficiencyText = '✅ Excellent! Your solar setup covers most of your usage.';
    efficiencyColor = 'green';
  } else if (offsetPercent >= 40) {
    efficiencyText = '⚠️ Moderate. Your solar setup covers some of your usage.';
    efficiencyColor = 'orange';
  } else {
    efficiencyText = '❌ Low. Your solar setup covers only a small fraction of your usage.';
    efficiencyColor = 'red';
  }

  showSolarStep('solar-result');
  document.getElementById('solar-result').innerHTML = `
    <h3>☀️ Your Solar Results</h3>
    <p>🔋 Daily Solar Generation: <b>${dailySolarKWh.toFixed(2)} kWh</b></p>
    <p>📅 Monthly Solar Generation: <b>${monthlySolarKWh.toFixed(1)} kWh</b></p>
    <p>📆 Yearly Solar Generation: <b>${yearlySolarKWh.toFixed(1)} kWh</b></p>
    <p>🌞 Solar covers about <b>${offsetPercent}%</b> of your daily usage.</p>
    <p>💰 Monthly Savings: <b>$${monthlySavings}</b></p>
    <p>💰 Yearly Savings: <b>$${yearlySavings}</b></p>
    <p style="margin-top:0.5rem; font-weight:bold; color:${efficiencyColor};">${efficiencyText}</p>
    <div style="margin-top:1rem;">
      <button class="solar-btn back" onclick="showSolarStep('solar-form')">⬅ Back</button>
    </div>
  `;
}
</script>





  <!-- Call to Action -->
  <section class="cta">
    <h2>Take Action Today</h2>
    <p>
      Every small step counts. Start making changes in how you use energy — 
      together we can make a big impact for the planet.
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
