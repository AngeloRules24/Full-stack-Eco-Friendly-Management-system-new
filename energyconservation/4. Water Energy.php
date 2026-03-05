<!-- MAHALIA'S PART  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Water Energy Tips</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>

<?php include "../header.php"; ?>


  <!-- Hero Banner -->
  <section class="hero energy-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('water.png') no-repeat center/cover;">
    <div class="hero-text">
      <h2>💧 Water Energy</h2>
      <p>
        Hydropower and water conservation are vital for a sustainable world. 
        Discover how to save water and use it effectively as an energy source.
      </p>
    </div>
  </section>

  <!-- Tips Section -->
  <section class="intro">
    <h2>Tips to Conserve and Use Water Energy Efficiently</h2>
    <p>Here are some practical ways to manage water and harness its energy:</p>
  </section>

 <section class="tips-grid">
  <div class="tip-card">
    <span class="tip-icon">🚿</span>
    <div class="tip-content">
      <h3>Reduce Water Waste</h3>
      <p>Install low-flow shower heads and faucets to save water daily.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">🌊</span>
    <div class="tip-content">
      <h3>Support Hydropower</h3>
      <p>Encourage clean hydropower initiatives in your region for renewable electricity.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">💡</span>
    <div class="tip-content">
      <h3>Fix Leaks Immediately</h3>
      <p>Repair dripping taps and leaking pipes to prevent water and energy waste.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">🏠</span>
    <div class="tip-content">
      <h3>Harvest Rainwater</h3>
      <p>Collect rainwater for gardening and non-drinking purposes to cut water bills.</p>
    </div>
  </div>

  <div class="tip-card">
    <span class="tip-icon">⚡</span>
    <div class="tip-content">
      <h3>Efficient Water Heating</h3>
      <p>Use solar or energy-efficient heaters to lower the cost of heating water.</p>
    </div>
  </div>
</section>



<!-- Floating Household Water Calculator Widget -->
<div id="housewater-widget">

  <!-- Start Screen -->
  <div id="housewater-start" class="housewater-screen active">
    <h3>💧 Estimate Your Household Water Usage</h3>
    <p>Find out your approximate monthly water consumption.</p>
    <button type="button" class="housewater-btn" onclick="showWaterStep('housewater-form')">Start ▶</button>
  </div>

  <!-- Form Screen -->
  <div id="housewater-form" class="housewater-screen">
    <h3>💧 Household Water Calculator</h3>
    <form id="housewaterCalc">
      <div class="form-group">
        <label>Number of People in Household:</label>
        <input type="number" id="numPeople" placeholder="e.g. 4" required>
      </div>

      <div class="form-group">
        <label>Shower Minutes per Person per Day:</label>
        <input type="number" id="showerMin" placeholder="e.g. 8" required>
      </div>

      <div class="form-group">
        <label>Toilet Flushes per Person per Day:</label>
        <input type="number" id="flushes" placeholder="e.g. 5" required>
      </div>

      <div class="form-group">
        <label>Laundry Loads per Week:</label>
        <input type="number" id="laundry" placeholder="e.g. 3" required>
      </div>

      <div class="form-group">
        <label>Kitchen Water Usage per Person per Day:</label>
        <select id="kitchenUse" required>
          <option value="">Select level</option>
          <option value="10">Low (~10 L)</option>
          <option value="20">Medium (~20 L)</option>
          <option value="30">High (~30 L)</option>
        </select>
      </div>

      <div class="solar-nav">
        <button type="button" class="housewater-btn back" onclick="backHouseWater()">⬅ Back</button>
        <button type="button" class="housewater-btn" onclick="calcHouseWater()">Calculate ✅</button>
      </div>
    </form>
  </div>

  <!-- Result Screen -->
  <div id="housewater-result" class="housewater-screen"></div>

</div>

<style>
/* =========================
   HOUSE WATER CALCULATOR SECTION
========================= */

#housewater-widget {
  position: relative;       /* no longer fixed */
  max-width: 900px;         /* flexible max width */
  width: 90%;               /* responsive width */
  margin: 2rem auto;        /* center horizontally, add space top/bottom */
  padding: 2rem;            /* internal padding */
  background: #e0f7fa;
  border: 3px solid #00acc1;
  border-radius: 16px;
  box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
  font-family: Arial, sans-serif;
  overflow: hidden;
}

/* Screens */
.housewater-screen {
  display: none;
  text-align: center;
  padding: 1rem;
}
.housewater-screen.active {
  display: block;
}

/* Headings */
#housewater-widget h3 {
  font-size: 1.4rem;
  color: #007c91;
  margin-bottom: 0.8rem;
}

#housewater-widget p {
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
  color: #007c91;
  margin-bottom: 0.3rem;
}
.form-group input, .form-group select {
  width: 100%;
  padding: 0.5rem;
  font-size: 0.95rem;
  border: 1px solid #81d4fa;
  border-radius: 6px;
}
.form-group input:focus, .form-group select:focus {
  border-color: #007c91;
  box-shadow: 0 0 4px rgba(0,124,145,0.3);
}

/* Buttons */
.housewater-btn {
  background: #00acc1;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 0.6rem 1rem;
  font-size: 0.95rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}
.housewater-btn:hover {
  background: #007c91;
}
.housewater-btn.back {
  background: #777;
}
.housewater-btn.back:hover {
  background: #555;
}

.solar-nav {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}

/* Result Box */
#housewater-result {
  padding: 1rem;
  text-align: left;
  margin-top: 1rem;
}
#housewater-result h3 {
  color: #007c91;
  margin-bottom: 0.5rem;
}
#housewater-result p {
  font-size: 0.9rem;
  margin: 0.3rem 0;
}

/* Responsive */
@media (max-width: 768px) {
  #housewater-widget {
    width: 95%;
    padding: 1.5rem;
    margin: 1.5rem auto;
  }

  .housewater-btn {
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
}

</style>

<script>
function showWaterStep(step) {
  document.querySelectorAll('#housewater-widget .housewater-screen').forEach(screen => {
    screen.classList.remove('active');
  });
  document.getElementById(step).classList.add('active');
}

function backHouseWater() {
  document.getElementById('housewaterCalc').reset();
  showWaterStep('housewater-start');
}

function calcHouseWater() {
  const numPeople = parseInt(document.getElementById('numPeople').value);
  const showerMin = parseFloat(document.getElementById('showerMin').value);
  const flushes = parseFloat(document.getElementById('flushes').value);
  const laundry = parseFloat(document.getElementById('laundry').value);
  const kitchenUse = parseFloat(document.getElementById('kitchenUse').value);

  if(isNaN(numPeople) || isNaN(showerMin) || isNaN(flushes) || isNaN(laundry) || isNaN(kitchenUse)) {
    showWaterStep('housewater-result');
    document.getElementById('housewater-result').innerHTML = "<p style='color:red;'>⚠️ Please fill in all fields.</p><button class='housewater-btn back' onclick=\"showWaterStep('housewater-form')\">⬅ Back</button>";
    return;
  }

  // Constants
  const showerFlow = 9; // L/min
  const toiletFlow = 6; // L/flush
  const laundryFlow = 50; // L/load

  // Daily usage
  const dailyShower = showerMin * showerFlow * numPeople;
  const dailyToilet = flushes * toiletFlow * numPeople;
  const dailyLaundry = (laundry / 7) * laundryFlow * numPeople;
  const dailyKitchen = kitchenUse * numPeople;

  const dailyTotal = dailyShower + dailyToilet + dailyLaundry + dailyKitchen;
  const monthlyTotal = dailyTotal * 30;

  // Efficiency rating
  let usageText = '';
  let usageColor = '';
  if(monthlyTotal <= 9000) {
    usageText = '✅ Low water usage. Good job!';
    usageColor = 'green';
  } else if(monthlyTotal <= 18000) {
    usageText = '⚠️ Moderate water usage. Can improve.';
    usageColor = 'orange';
  } else {
    usageText = '❌ High water usage. Consider saving water.';
    usageColor = 'red';
  }

  showWaterStep('housewater-result');
  document.getElementById('housewater-result').innerHTML = `
    <h3>💧 Your Water Usage</h3>
    <p>🚿 Shower: <b>${dailyShower.toFixed(1)} L/day</b></p>
    <p>🚽 Toilet: <b>${dailyToilet.toFixed(1)} L/day</b></p>
    <p>🧺 Laundry: <b>${dailyLaundry.toFixed(1)} L/day</b></p>
    <p>🍽️ Kitchen: <b>${dailyKitchen.toFixed(1)} L/day</b></p>
    <p>🌊 Total Daily Water Use: <b>${dailyTotal.toFixed(1)} L</b></p>
    <p>📅 Estimated Monthly Use: <b>${monthlyTotal.toFixed(1)} L</b></p>
    <p style="margin-top:0.5rem; font-weight:bold; color:${usageColor};">${usageText}</p>
    <div style="margin-top:1rem;">
      <button class="housewater-btn back" onclick="showWaterStep('housewater-form')">⬅ Back</button>
    </div>
  `;
}
</script>





  <!-- Call to Action -->
  <section class="cta">
    <h2>Take Action Today</h2>
    <p>
      Saving water helps save energy too. Be mindful of your water use 
      and encourage sustainable practices at home and in your community.
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
