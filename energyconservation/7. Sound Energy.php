<!-- MAHALIA'S PART  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Sound Energy Tips</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>


<?php include "../header.php"; ?>

  <!-- Hero Banner -->
  <section class="hero energy-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('sound.png') no-repeat center/cover;">
    <div class="hero-text">
      <h2>🔊 Sound Energy</h2>
      <p>
        Sound energy is often overlooked, yet managing noise and sound usage 
        contributes to healthier living and environmental sustainability.
      </p>
    </div>
  </section>

  <!-- Tips Section -->
  <section class="intro">
    <h2>Tips for Managing Sound Energy</h2>
    <p>Here are some practices to make sound energy work for you while reducing noise pollution:</p>
  </section>

  <section class="tips-grid">
    <div class="tip-card">
      <span class="tip-icon">🎧</span>
      <div class="tip-content">
        <h3>Use Headphones Responsibly</h3>
        <p>Keep volume at safe levels to protect hearing and avoid disturbing others.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🔇</span>
      <div class="tip-content">
        <h3>Minimize Noise Pollution</h3>
        <p>Turn off unnecessary sound sources like TVs or radios when not in use.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🏠</span>
      <div class="tip-content">
        <h3>Soundproof Living Spaces</h3>
        <p>Use rugs, curtains, or insulation to reduce unwanted noise and improve comfort at home.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🎵</span>
      <div class="tip-content">
        <h3>Choose Calming Sounds</h3>
        <p>Play natural soundscapes or soft music to create a peaceful atmosphere without excess volume.</p>
      </div>
    </div>

    <div class="tip-card">
      <span class="tip-icon">🌳</span>
      <div class="tip-content">
        <h3>Promote Quiet Green Spaces</h3>
        <p>Support community efforts to reduce urban noise and increase tranquil outdoor areas.</p>
      </div>
    </div>
  </section>



<!-- Floating Sound Energy Calculator Widget -->
<div id="sound-widget">

  <!-- Start Screen -->
  <div id="sound-start" class="sound-screen active">
    <h3>🔊 Estimate Your Household Sound Energy</h3>
    <p>Calculate daily and monthly sound exposure and noise levels.</p>
    <button type="button" class="sound-btn" onclick="showSoundStep('sound-form')">Start ▶</button>
  </div>

  <!-- Form Screen -->
  <div id="sound-form" class="sound-screen">
    <h3>🔊 Sound Energy Calculator</h3>
    <form id="soundCalc">
      <div class="form-group">
        <label>Number of People in Household:</label>
        <input type="number" id="numPeopleSound" placeholder="e.g. 4" required>
      </div>

      <div class="form-group">
        <label>TV / Music Hours per Day:</label>
        <input type="number" id="tvMusicHours" placeholder="e.g. 3" required>
      </div>

      <div class="form-group">
        <label>Appliance Noise Hours per Day:</label>
        <input type="number" id="applianceHours" placeholder="e.g. 2" required>
      </div>

      <div class="form-group">
        <label>Outdoor Noise Hours per Day:</label>
        <input type="number" id="outdoorHours" placeholder="e.g. 1" required>
      </div>

      <div class="form-group">
        <label>Average Outdoor Noise Level (dB):</label>
        <input type="number" id="avgNoiseDb" placeholder="e.g. 70" required>
      </div>

      <div class="solar-nav">
        <button type="button" class="sound-btn back" onclick="backSound()">⬅ Back</button>
        <button type="button" class="sound-btn" onclick="calcSound()">Calculate ✅</button>
      </div>
    </form>
  </div>

  <!-- Result Screen -->
  <div id="sound-result" class="sound-screen"></div>

</div>

<style>
/* =========================
   SOUND CALCULATOR SECTION
========================= */

#sound-widget {
  position: relative;       /* no longer fixed */
  max-width: 900px;         /* flexible max width */
  width: 90%;               /* responsive width */
  margin: 2rem auto;        /* center horizontally, space top/bottom */
  padding: 2rem;            /* internal padding */
  background: #fff3e0;
  border: 3px solid #fb8c00;
  border-radius: 16px;
  box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
  font-family: Arial, sans-serif;
  overflow: hidden;
}

/* Screens */
.sound-screen {
  display: none;
  padding: 1rem;
  text-align: center;
}
.sound-screen.active {
  display: block;
}

/* Headings */
#sound-widget h3 {
  font-size: 1.4rem;
  color: #e65100;
  margin-bottom: 0.8rem;
}

#sound-widget p {
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
.form-group input {
  width: 100%;
  padding: 0.5rem;
  font-size: 0.95rem;
  border: 1px solid #ffcc80;
  border-radius: 6px;
}
.form-group input:focus {
  border-color: #e65100;
  box-shadow: 0 0 4px rgba(230,81,0,0.3);
}

/* Buttons */
.sound-btn {
  background: #fb8c00;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 0.6rem 1rem;
  font-size: 0.95rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}
.sound-btn:hover {
  background: #e65100;
}
.sound-btn.back {
  background: #777;
}
.sound-btn.back:hover {
  background: #555;
}

.solar-nav {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}

/* Result Box */
#sound-result {
  padding: 1rem;
  text-align: left;
  margin-top: 1rem;
}
#sound-result h3 {
  color: #e65100;
  margin-bottom: 0.5rem;
}
#sound-result p {
  font-size: 0.9rem;
  margin: 0.3rem 0;
}

/* Responsive */
@media (max-width: 768px) {
  #sound-widget {
    width: 95%;
    padding: 1.5rem;
    margin: 1.5rem auto;
  }

  .sound-btn {
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
}

</style>

<script>
function showSoundStep(step) {
  document.querySelectorAll('#sound-widget .sound-screen').forEach(screen => {
    screen.classList.remove('active');
  });
  document.getElementById(step).classList.add('active');
}

function backSound() {
  document.getElementById('soundCalc').reset();
  showSoundStep('sound-start');
}

function calcSound() {
  const numPeople = parseInt(document.getElementById('numPeopleSound').value);
  const tvMusicHours = parseFloat(document.getElementById('tvMusicHours').value);
  const applianceHours = parseFloat(document.getElementById('applianceHours').value);
  const outdoorHours = parseFloat(document.getElementById('outdoorHours').value);
  const avgDb = parseFloat(document.getElementById('avgNoiseDb').value);

  if(isNaN(numPeople) || isNaN(tvMusicHours) || isNaN(applianceHours) || isNaN(outdoorHours) || isNaN(avgDb)) {
    showSoundStep('sound-result');
    document.getElementById('sound-result').innerHTML = "<p style='color:red;'>⚠️ Please fill in all fields.</p><button class='sound-btn back' onclick=\"showSoundStep('sound-form')\">⬅ Back</button>";
    return;
  }

  const tvMusicExposure = tvMusicHours * 50 * numPeople;
  const applianceExposure = applianceHours * 60 * numPeople;
  const outdoorExposure = outdoorHours * avgDb * numPeople;
  const dailyExposure = (tvMusicExposure + applianceExposure + outdoorExposure) / 10;
  const monthlyExposure = dailyExposure * 30;

  let soundText = '';
  let soundColor = '';
  if(monthlyExposure <= 500) {
    soundText = '✅ Low sound exposure. Good environment!';
    soundColor = 'green';
  } else if(monthlyExposure <= 1000) {
    soundText = '⚠️ Moderate sound exposure. Consider reducing noise.';
    soundColor = 'orange';
  } else {
    soundText = '❌ High sound exposure. Noise levels are concerning.';
    soundColor = 'red';
  }

  showSoundStep('sound-result');
  document.getElementById('sound-result').innerHTML = `
    <h3>🔊 Your Sound Energy Results</h3>
    <p>📺 TV/Music Exposure: <b>${tvMusicExposure} units/day</b></p>
    <p>🔌 Appliance Exposure: <b>${applianceExposure} units/day</b></p>
    <p>🌳 Outdoor Noise Exposure: <b>${outdoorExposure} units/day</b></p>
    <p>⚡ Total Daily Sound Exposure: <b>${dailyExposure.toFixed(1)} units</b></p>
    <p>📅 Estimated Monthly Sound Exposure: <b>${monthlyExposure.toFixed(1)} units</b></p>
    <p style="margin-top:0.5rem; font-weight:bold; color:${soundColor};">${soundText}</p>
    <div style="margin-top:1rem;">
      <button class="sound-btn back" onclick="showSoundStep('sound-form')">⬅ Back</button>
    </div>
  `;
}
</script>






  <!-- Call to Action -->
  <section class="cta">
    <h2>Let’s Create Harmony</h2>
    <p>
      By managing sound wisely, we protect our health, improve quality of life, 
      and foster peaceful environments.
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
