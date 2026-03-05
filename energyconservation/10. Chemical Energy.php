<!-- MAHALIA'S PART  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Chemical Energy Tips</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>


<?php include "../header.php"; ?>

  <!-- Hero Banner -->
  <section class="hero energy-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('chemical.png') no-repeat center/cover;">
    <div class="hero-text">
      <h2>🧪 Chemical Energy</h2>
      <p>
        Chemical energy is stored in fuels, batteries, and even food. Using it wisely 
        helps reduce pollution and conserve vital resources.
      </p>
    </div>
  </section>

  <!-- Tips Section -->
  <section class="intro">
    <h2>Tips for Conserving and Using Chemical Energy Efficiently</h2>
    <p>Here are practical ways to minimize waste and make the most of chemical energy:</p>
  </section>

  <section class="tips-grid">
    <div class="tip-card">
      <span class="tip-icon">🔋</span>
      <div class="tip-content">
        <h3>Use Rechargeable Batteries</h3>
        <p>Opt for rechargeable batteries instead of disposables to reduce chemical waste.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🍽️</span>
      <div class="tip-content">
        <h3>Avoid Food Waste</h3>
        <p>Food contains chemical energy — reduce waste by meal planning and composting scraps.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">⛽</span>
      <div class="tip-content">
        <h3>Conserve Fuel</h3>
        <p>Carpool, use public transport, or drive fuel-efficient vehicles to save on chemical energy stored in fuel.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🧴</span>
      <div class="tip-content">
        <h3>Choose Eco-Friendly Products</h3>
        <p>Use biodegradable cleaning agents and products with fewer harmful chemicals.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🌱</span>
      <div class="tip-content">
        <h3>Support Renewable Alternatives</h3>
        <p>Encourage biofuels and other sustainable chemical energy sources in your community.</p>
      </div>
    </div>
  </section>



  <!-- Floating Chemical Energy Calculator Widget -->
<div id="chemical-widget">

  <!-- Start Screen -->
  <div id="chemical-start" class="chemical-screen active">
    <h3>🧪 Calculate Your Chemical Energy</h3>
    <p>Estimate energy from fuels, batteries, or food. Using it wisely helps reduce pollution and conserve resources.</p>
    <button type="button" class="chemical-btn" onclick="showChemicalStep('chemical-form')">Start ▶</button>
  </div>

  <!-- Form Screen -->
  <div id="chemical-form" class="chemical-screen">
    <h3>🧪 Chemical Energy Calculator</h3>
    <form id="chemicalCalc">
      <div class="form-group">
        <label>Type of Substance:</label>
        <select id="chemType" required>
          <option value="">Select...</option>
          <option value="fuel">Fuel (Gasoline, Diesel, etc.)</option>
          <option value="battery">Battery (Lithium, Lead Acid, etc.)</option>
          <option value="food">Food (Calories)</option>
        </select>
      </div>

      <div class="form-group">
        <label>Mass / Quantity:</label>
        <input type="number" id="chemMass" placeholder="kg (fuel/battery) or g (food)" required>
      </div>

      <div class="chemical-nav">
        <button type="button" class="chemical-btn back" onclick="backChemical()">⬅ Back</button>
        <button type="button" class="chemical-btn" onclick="calcChemical()">Calculate ✅</button>
      </div>
    </form>
  </div>

  <!-- Result Screen -->
  <div id="chemical-result" class="chemical-screen"></div>

</div>

<style>
/* =========================
   CHEMICAL CALCULATOR SECTION
========================= */

#chemical-widget {
  position: relative;       /* changed from fixed */
  max-width: 900px;         /* flexible max width */
  width: 90%;               /* responsive width */
  margin: 2rem auto;        /* center horizontally, space above/below */
  padding: 2rem;            /* internal padding */
  background: #fff3e0;
  border: 3px solid #ff9800;
  border-radius: 16px;
  box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
  font-family: Arial, sans-serif;
  overflow: hidden;
}

/* Screens */
.chemical-screen {
  display: none;
  padding: 1rem;
  text-align: center;
}
.chemical-screen.active {
  display: block;
}

/* Headings */
#chemical-widget h3 {
  font-size: 1.4rem;
  color: #e65100;
  margin-bottom: 0.8rem;
}

#chemical-widget p {
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
  color: #e65100;
  margin-bottom: 0.3rem;
}
.form-group input, .form-group select {
  width: 100%;
  padding: 0.5rem;
  font-size: 0.95rem;
  border: 1px solid #ffcc80;
  border-radius: 6px;
}
.form-group input:focus, .form-group select:focus {
  border-color: #e65100;
  box-shadow: 0 0 4px rgba(230,81,0,0.3);
}

/* Buttons */
.chemical-btn {
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
.chemical-btn:hover {
  background: #e65100;
}
.chemical-btn.back {
  background: #777;
}
.chemical-btn.back:hover {
  background: #555;
}

.chemical-nav {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}

/* Result Box */
#chemical-result {
  padding: 1rem;
  text-align: left;
  margin-top: 1rem;
}
#chemical-result h3 {
  color: #e65100;
  margin-bottom: 0.5rem;
}
#chemical-result p {
  font-size: 0.9rem;
  margin: 0.3rem 0;
}

/* Responsive */
@media (max-width: 768px) {
  #chemical-widget {
    width: 95%;
    padding: 1.5rem;
    margin: 1.5rem auto;
  }

  .chemical-btn {
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
}

</style>

<script>
function showChemicalStep(step) {
  document.querySelectorAll('#chemical-widget .chemical-screen').forEach(screen => {
    screen.classList.remove('active');
  });
  document.getElementById(step).classList.add('active');
}

function backChemical() {
  document.getElementById('chemicalCalc').reset();
  showChemicalStep('chemical-start');
}

function calcChemical() {
  const type = document.getElementById('chemType').value;
  let mass = parseFloat(document.getElementById('chemMass').value);

  if(!type || isNaN(mass)) {
    showChemicalStep('chemical-result');
    document.getElementById('chemical-result').innerHTML = "<p style='color:red;'>⚠️ Please fill in all fields.</p><button class='chemical-btn back' onclick=\"showChemicalStep('chemical-form')\">⬅ Back</button>";
    return;
  }

  // Energy density in kJ/kg or kJ/100g for food
  let energyDensity = 0;
  if(type === 'fuel') energyDensity = 46000; // kJ/kg typical gasoline
  else if(type === 'battery') energyDensity = 200; // kJ/kg typical battery
  else if(type === 'food') {
    energyDensity = 2.5 * 1000; // 2.5 kcal/g -> 10.46 kJ/g * 100 = ~2500 kJ/100g
    mass = mass / 1000; // convert grams to kg for calculation
  }

  const energyJ = mass * energyDensity * 1000; // kJ to Joules
  const energyKWh = (energyJ / 3600000).toFixed(3);

  // Rating
  let energyText = '';
  let energyColor = '';
  if(energyKWh < 1) {
    energyText = '✅ Low chemical energy. Safe & manageable.';
    energyColor = 'green';
  } else if(energyKWh <= 5) {
    energyText = '⚠️ Moderate chemical energy.';
    energyColor = 'orange';
  } else {
    energyText = '❌ High chemical energy. Use with caution!';
    energyColor = 'red';
  }

  showChemicalStep('chemical-result');
  document.getElementById('chemical-result').innerHTML = `
    <h3>🧪 Chemical Energy Results</h3>
    <p>🔹 Energy Released: <b>${energyJ.toFixed(0)} J (${energyKWh} kWh)</b></p>
    <p style="margin-top:0.5rem; font-weight:bold; color:${energyColor};">${energyText}</p>
    <div style="margin-top:1rem;">
      <button class="chemical-btn back" onclick="showChemicalStep('chemical-form')">⬅ Back</button>
    </div>
  `;
}
</script>




  <!-- Call to Action -->
  <section class="cta">
    <h2>Think Before You Burn</h2>
    <p>
      Every bit of chemical energy matters — making smarter choices reduces waste and helps the environment.
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
