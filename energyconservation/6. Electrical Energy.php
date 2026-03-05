<!-- MAHALIA'S PART  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Electrical Energy Tips</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>

<?php include "../header.php"; ?>


  <!-- Hero Banner -->
  <section class="hero energy-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('electrical.png') no-repeat center/cover;">
    <div class="hero-text">
      <h2>⚡ Electrical Energy</h2>
      <p>
        Electricity powers our daily lives. Learn how to use it responsibly 
        and efficiently to cut costs and reduce environmental impact.
      </p>
    </div>
  </section>

  <!-- Tips Section -->
  <section class="intro">
    <h2>Tips to Conserve Electrical Energy</h2>
    <p>Here are some effective ways to reduce electricity consumption at home and work:</p>
  </section>

  <section class="tips-grid">
    <div class="tip-card">
      <span class="tip-icon">🔌</span>
      <div class="tip-content">
        <h3>Unplug Idle Devices</h3>
        <p>Electronics use standby power. Unplug or switch off at the socket when not in use.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">💡</span>
      <div class="tip-content">
        <h3>Switch to LED Bulbs</h3>
        <p>LEDs use up to 80% less electricity compared to traditional bulbs and last longer.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">⚙️</span>
      <div class="tip-content">
        <h3>Use Energy-Efficient Appliances</h3>
        <p>Choose appliances with high energy ratings to lower long-term power consumption.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🌞</span>
      <div class="tip-content">
        <h3>Leverage Natural Light</h3>
        <p>Keep curtains open during the day to minimize reliance on artificial lighting.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">📉</span>
      <div class="tip-content">
        <h3>Monitor Electricity Usage</h3>
        <p>Use smart meters or apps to track and manage daily electricity consumption.</p>
      </div>
    </div>
  </section>



<!-- Floating Electrical Energy Calculator Widget -->
<div id="electric-widget">

  <!-- Start Screen -->
  <div id="electric-start" class="electric-screen active">
    <h3>⚡ Estimate Your Electrical Energy Usage</h3>
    <p>Calculate your household electricity consumption and monthly cost.</p>
    <button type="button" class="electric-btn" onclick="showElectricStep('electric-form')">Start ▶</button>
  </div>

  <!-- Form Screen -->
  <div id="electric-form" class="electric-screen">
    <h3>⚡ Electrical Energy Calculator</h3>
    <form id="electricCalc">
      <div class="form-group">
        <label>Number of People in Household:</label>
        <input type="number" id="numPeopleElec" placeholder="e.g. 4" required>
      </div>

      <div class="form-group">
        <label>Average TV Hours per Day:</label>
        <input type="number" id="tvHours" placeholder="e.g. 4" required>
      </div>

      <div class="form-group">
        <label>Average Computer Hours per Day:</label>
        <input type="number" id="compHours" placeholder="e.g. 3" required>
      </div>

      <div class="form-group">
        <label>Other Appliances Consumption per Day (kWh):</label>
        <input type="number" id="otherKWh" step="0.1" placeholder="e.g. 5" required>
      </div>

      <div class="form-group">
        <label>Energy Cost ($ per kWh):</label>
        <input type="number" id="energyCostElec" step="0.01" placeholder="e.g. 0.15" required>
      </div>

      <div class="solar-nav">
        <button type="button" class="electric-btn back" onclick="backElectric()">⬅ Back</button>
        <button type="button" class="electric-btn" onclick="calcElectric()">Calculate ✅</button>
      </div>
    </form>
  </div>

  <!-- Result Screen -->
  <div id="electric-result" class="electric-screen"></div>

</div>

<style>
/* =========================
   ELECTRIC CALCULATOR SECTION
========================= */

#electric-widget {
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
.electric-screen {
  display: none;
  text-align: center;
  padding: 1rem;
}
.electric-screen.active {
  display: block;
}

/* Headings */
#electric-widget h3 {
  font-size: 1.4rem;
  color: #007c91;
  margin-bottom: 0.8rem;
}

#electric-widget p {
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
.form-group input {
  width: 100%;
  padding: 0.5rem;
  font-size: 0.95rem;
  border: 1px solid #80deea;
  border-radius: 6px;
}
.form-group input:focus {
  border-color: #007c91;
  box-shadow: 0 0 4px rgba(0,124,145,0.3);
}

/* Buttons */
.electric-btn {
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
.electric-btn:hover {
  background: #007c91;
}
.electric-btn.back {
  background: #777;
}
.electric-btn.back:hover {
  background: #555;
}

.solar-nav {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}

/* Result Box */
#electric-result {
  padding: 1rem;
  text-align: left;
  margin-top: 1rem;
}
#electric-result h3 {
  color: #007c91;
  margin-bottom: 0.5rem;
}
#electric-result p {
  font-size: 0.9rem;
  margin: 0.3rem 0;
}

/* Responsive */
@media (max-width: 768px) {
  #electric-widget {
    width: 95%;
    padding: 1.5rem;
    margin: 1.5rem auto;
  }

  .electric-btn {
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
}

</style>

<script>
function showElectricStep(step) {
  document.querySelectorAll('#electric-widget .electric-screen').forEach(screen => {
    screen.classList.remove('active');
  });
  document.getElementById(step).classList.add('active');
}

function backElectric() {
  document.getElementById('electricCalc').reset();
  showElectricStep('electric-start');
}

function calcElectric() {
  const numPeople = parseInt(document.getElementById('numPeopleElec').value);
  const tvHours = parseFloat(document.getElementById('tvHours').value);
  const compHours = parseFloat(document.getElementById('compHours').value);
  const otherKWh = parseFloat(document.getElementById('otherKWh').value);
  const energyCost = parseFloat(document.getElementById('energyCostElec').value);

  if(isNaN(numPeople) || isNaN(tvHours) || isNaN(compHours) || isNaN(otherKWh) || isNaN(energyCost)) {
    showElectricStep('electric-result');
    document.getElementById('electric-result').innerHTML = "<p style='color:red;'>⚠️ Please fill in all fields.</p><button class='electric-btn back' onclick=\"showElectricStep('electric-form')\">⬅ Back</button>";
    return;
  }

  const tvKWh = tvHours * 0.1 * numPeople;
  const compKWh = compHours * 0.15 * numPeople;
  const dailyTotal = tvKWh + compKWh + otherKWh;
  const monthlyTotal = dailyTotal * 30;
  const monthlyCost = (monthlyTotal * energyCost).toFixed(2);

  // Efficiency rating
  let usageText = '';
  let usageColor = '';
  if(monthlyTotal <= 100) {
    usageText = '✅ Low energy usage. Good job!';
    usageColor = 'green';
  } else if(monthlyTotal <= 300) {
    usageText = '⚠️ Moderate energy usage. Can improve.';
    usageColor = 'orange';
  } else {
    usageText = '❌ High energy usage. Consider saving energy.';
    usageColor = 'red';
  }

  showElectricStep('electric-result');
  document.getElementById('electric-result').innerHTML = `
    <h3>⚡ Your Electrical Energy Usage</h3>
    <p>📺 TV: <b>${tvKWh.toFixed(1)} kWh/day</b></p>
    <p>💻 Computer: <b>${compKWh.toFixed(1)} kWh/day</b></p>
    <p>🔌 Other Appliances: <b>${otherKWh.toFixed(1)} kWh/day</b></p>
    <p>⚡ Total Daily Energy Use: <b>${dailyTotal.toFixed(1)} kWh</b></p>
    <p>📅 Estimated Monthly Energy Use: <b>${monthlyTotal.toFixed(1)} kWh</b></p>
    <p>💰 Estimated Monthly Cost: <b>$${monthlyCost}</b></p>
    <p style="margin-top:0.5rem; font-weight:bold; color:${usageColor};">${usageText}</p>
    <div style="margin-top:1rem;">
      <button class="electric-btn back" onclick="showElectricStep('electric-form')">⬅ Back</button>
    </div>
  `;
}
</script>



  <!-- Call to Action -->
  <section class="cta">
    <h2>Take Action Today</h2>
    <p>
      By making smarter electrical choices, you’ll not only save money but 
      also help reduce demand on fossil fuels.
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
