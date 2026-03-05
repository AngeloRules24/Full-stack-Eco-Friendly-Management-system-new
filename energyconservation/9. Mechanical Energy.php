<!-- MAHALIA'S PART  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Mechanical Energy Tips</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>


<?php include "../header.php"; ?>


  <!-- Hero Banner -->
  <section class="hero energy-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('mechanical.png') no-repeat center/cover;">
    <div class="hero-text">
      <h2>⚙️ Mechanical Energy</h2>
      <p>
        Mechanical energy is the energy of motion and position. Using it efficiently 
        in machines, transportation, and daily life can reduce energy waste.
      </p>
    </div>
  </section>

  <!-- Tips Section -->
  <section class="intro">
    <h2>Tips for Conserving and Using Mechanical Energy Wisely</h2>
    <p>Here are practical ways to save energy and optimize the use of mechanical systems:</p>
  </section>

  <section class="tips-grid">
    <div class="tip-card">
      <span class="tip-icon">🚴</span>
      <div class="tip-content">
        <h3>Opt for Human Power</h3>
        <p>Use bicycles, hand tools, or manual options instead of machines whenever possible.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">⚡</span>
      <div class="tip-content">
        <h3>Maintain Machines Regularly</h3>
        <p>Lubricate and service equipment to reduce friction and energy loss.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🔧</span>
      <div class="tip-content">
        <h3>Use Energy-Efficient Devices</h3>
        <p>Invest in machines and appliances designed to maximize mechanical efficiency.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🚗</span>
      <div class="tip-content">
        <h3>Eco-Friendly Transportation</h3>
        <p>Drive smoothly, reduce idling, and keep vehicles tuned to save fuel and mechanical energy.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🌍</span>
      <div class="tip-content">
        <h3>Community Energy Projects</h3>
        <p>Support renewable projects like windmills and hydro plants that rely on mechanical motion.</p>
      </div>
    </div>
  </section>



  <!-- Floating Mechanical Energy Calculator Widget -->
<div id="mechanical-widget">

  <!-- Start Screen -->
  <div id="mechanical-start" class="mechanical-screen active">
    <h3>⚙️ Calculate Your Mechanical Energy</h3>
    <p>Estimate potential and kinetic energy based on mass, height, and speed.</p>
    <button type="button" class="mechanical-btn" onclick="showMechanicalStep('mechanical-form')">Start ▶</button>
  </div>

  <!-- Form Screen -->
  <div id="mechanical-form" class="mechanical-screen">
    <h3>⚙️ Mechanical Energy Calculator</h3>
    <form id="mechanicalCalc">
      <div class="form-group">
        <label>Mass (kg):</label>
        <input type="number" id="mass" placeholder="e.g. 70" required>
      </div>

      <div class="form-group">
        <label>Height (m):</label>
        <input type="number" id="height" placeholder="e.g. 2" required>
      </div>

      <div class="form-group">
        <label>Speed (m/s):</label>
        <input type="number" id="speed" placeholder="e.g. 3" required>
      </div>

      <div class="mechanical-nav">
        <button type="button" class="mechanical-btn back" onclick="backMechanical()">⬅ Back</button>
        <button type="button" class="mechanical-btn" onclick="calcMechanical()">Calculate ✅</button>
      </div>
    </form>
  </div>

  <!-- Result Screen -->
  <div id="mechanical-result" class="mechanical-screen"></div>

</div>

<style>
/* =========================
   MECHANICAL CALCULATOR SECTION
========================= */

#mechanical-widget {
  position: relative;        /* changed from fixed */
  max-width: 900px;          /* flexible max width */
  width: 90%;                /* responsive width */
  margin: 2rem auto;         /* center horizontally, space above/below */
  padding: 2rem;             /* internal padding */
  background: #e3f2fd;
  border: 3px solid #2196f3;
  border-radius: 16px;
  box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
  font-family: Arial, sans-serif;
  overflow: hidden;
}

/* Screens */
.mechanical-screen {
  display: none;
  padding: 1rem;
  text-align: center;
}
.mechanical-screen.active {
  display: block;
}

/* Headings */
#mechanical-widget h3 {
  font-size: 1.4rem;
  color: #1565c0;
  margin-bottom: 0.8rem;
}

#mechanical-widget p {
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
  color: #1565c0;
  margin-bottom: 0.3rem;
}
.form-group input {
  width: 100%;
  padding: 0.5rem;
  font-size: 0.95rem;
  border: 1px solid #90caf9;
  border-radius: 6px;
}
.form-group input:focus {
  border-color: #1565c0;
  box-shadow: 0 0 4px rgba(21,101,192,0.3);
}

/* Buttons */
.mechanical-btn {
  background: #2196f3;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 0.6rem 1rem;
  font-size: 0.95rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}
.mechanical-btn:hover {
  background: #1565c0;
}
.mechanical-btn.back {
  background: #777;
}
.mechanical-btn.back:hover {
  background: #555;
}

.mechanical-nav {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}

/* Result Box */
#mechanical-result {
  padding: 1rem;
  text-align: left;
  margin-top: 1rem;
}
#mechanical-result h3 {
  color: #1565c0;
  margin-bottom: 0.5rem;
}
#mechanical-result p {
  font-size: 0.9rem;
  margin: 0.3rem 0;
}

/* Responsive */
@media (max-width: 768px) {
  #mechanical-widget {
    width: 95%;
    padding: 1.5rem;
    margin: 1.5rem auto;
  }

  .mechanical-btn {
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
}

</style>

<script>
function showMechanicalStep(step) {
  document.querySelectorAll('#mechanical-widget .mechanical-screen').forEach(screen => {
    screen.classList.remove('active');
  });
  document.getElementById(step).classList.add('active');
}

function backMechanical() {
  document.getElementById('mechanicalCalc').reset();
  showMechanicalStep('mechanical-start');
}

function calcMechanical() {
  const mass = parseFloat(document.getElementById('mass').value);
  const height = parseFloat(document.getElementById('height').value);
  const speed = parseFloat(document.getElementById('speed').value);
  const g = 9.81;

  if(isNaN(mass) || isNaN(height) || isNaN(speed)) {
    showMechanicalStep('mechanical-result');
    document.getElementById('mechanical-result').innerHTML = "<p style='color:red;'>⚠️ Please fill in all fields.</p><button class='mechanical-btn back' onclick=\"showMechanicalStep('mechanical-form')\">⬅ Back</button>";
    return;
  }

  const potentialEnergy = mass * g * height; // in Joules
  const kineticEnergy = 0.5 * mass * speed * speed; // in Joules
  const totalEnergy = potentialEnergy + kineticEnergy;
  const totalKWh = (totalEnergy / 3600000).toFixed(3); // convert to kWh

  // Efficiency/impact rating
  let energyText = '';
  let energyColor = '';
  if(totalKWh < 0.5) {
    energyText = '✅ Low mechanical energy. Safe & efficient!';
    energyColor = 'green';
  } else if(totalKWh <= 2) {
    energyText = '⚠️ Moderate mechanical energy.';
    energyColor = 'orange';
  } else {
    energyText = '❌ High mechanical energy. Caution advised!';
    energyColor = 'red';
  }

  showMechanicalStep('mechanical-result');
  document.getElementById('mechanical-result').innerHTML = `
    <h3>⚙️ Mechanical Energy Results</h3>
    <p>⚡ Potential Energy: <b>${potentialEnergy.toFixed(2)} J</b></p>
    <p>🏃 Kinetic Energy: <b>${kineticEnergy.toFixed(2)} J</b></p>
    <p>🛠 Total Mechanical Energy: <b>${totalEnergy.toFixed(2)} J (${totalKWh} kWh)</b></p>
    <p style="margin-top:0.5rem; font-weight:bold; color:${energyColor};">${energyText}</p>
    <div style="margin-top:1rem;">
      <button class="mechanical-btn back" onclick="showMechanicalStep('mechanical-form')">⬅ Back</button>
    </div>
  `;
}
</script>






  <!-- Call to Action -->
  <section class="cta">
    <h2>Use Energy in Motion Responsibly</h2>
    <p>
      Mechanical energy drives our world — using it wisely ensures a sustainable future for all.
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
