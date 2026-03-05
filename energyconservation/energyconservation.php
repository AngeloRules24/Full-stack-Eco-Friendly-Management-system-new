<!-- MAHALIA'S -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Energy Conservation</title>
  <link rel="stylesheet" href="1. Main Style.css">
</head>
<body>

<?php include "../header.php"; ?>

<!-- =========================
    BANNER
========================= -->
<section class="hero energy-hero">
  <div class="hero-text">
    <h2>Energy Conservation</h2>
    <p>Discover smarter ways to use and conserve energy. From solar panels to efficient lighting, explore how you can reduce waste, cut costs, and protect our planet.</p>
  </div>
</section>

<section class="intro">
  <h2>Explore Energy Categories</h2>
  <p>Energy conservation isn’t just about switching things off — it’s about choosing smarter, cleaner energy solutions. Select a category below to learn actionable steps for sustainable living.</p>
</section>

<section class="categories-grid">

  <article class="category-card">
    <h3>☀️ Solar Energy</h3>
    <p>Solar energy comes directly from the sun, making it one of the cleanest renewable sources. It reduces dependence on fossil fuels and lowers electricity bills.</p>
    <a href="2. Solar Energy.php" class="learn-more">Learn More →</a>
  </article>

  <article class="category-card">
    <h3>💨 Wind Energy</h3>
    <p>Wind energy uses the natural movement of air to generate power through turbines. It’s renewable, cost-effective, and reduces greenhouse gas emissions</p>
    <a href="3. Wind Energy.php" class="learn-more">Learn More →</a>
  </article>

  <article class="category-card">
    <h3>💧 Water Energy</h3>
    <p>Water energy, or hydropower, harnesses the flow of rivers and dams to produce electricity. It’s reliable but requires careful conservation of water resources.</p>
    <a href="4. Water Energy.php" class="learn-more">Learn More →</a>
  </article>

  <article class="category-card">
    <h3>🔥 Heat Energy</h3>
    <p>Heat energy conservation focuses on reducing waste from heating and cooling systems, improving insulation, and using energy-efficient devices.</p>
    <a href="5. Heat Energy.php" class="learn-more">Learn More →</a>
  </article>

  <article class="category-card">
    <h3>⚡ Electrical Energy</h3>
    <p>Everyday appliances and devices consume electricity. Conserving electrical energy means using smart technology and responsible daily habits.</p>
    <a href="6. Electrical Energy.php" class="learn-more">Learn More →</a>
  </article>

  <article class="category-card">
    <h3>🔊 Sound Energy</h3>
    <p>Sound energy is often overlooked. By managing noise pollution and optimizing acoustic systems, we can improve efficiency and save energy.</p>
    <a href="7. Sound Energy.php" class="learn-more">Learn More →</a>
  </article>

  <article class="category-card">
    <h3>💡 Light Energy</h3>
    <p>Efficient lighting, such as LEDs and natural day lighting, helps reduce electricity usage while keeping spaces bright and safe.</p>
    <a href="8. Light Energy.php" class="learn-more">Learn More →</a>
  </article>

  <article class="category-card">
    <h3>⚙️ Mechanical Energy</h3>
    <p>Chemical energy comes from fuels and food. Using eco-friendly fuels and reducing chemical waste can greatly support sustainable living.</p>
    <a href="9. Mechanical Energy.php" class="learn-more">Learn More →</a>
  </article>

  <article class="category-card">
    <h3>🧪 Chemical Energy</h3>
    <p>Choose eco-friendly fuels and reduce waste...</p>
    <a href="10. Chemical Energy.php" class="learn-more">Learn More →</a>
  </article>

</section>

<!-- QUIZ WIDGET -->
<div id="quiz-widget">

  <div id="quiz-start" class="quiz-screen active">
    <h2>🌍 How Green Are You?</h2>
    <p>Find out your eco-friendly personality in just 10 questions!</p>
    <button id="startBtn" type="button">Start Quiz ▶</button>
  </div>

  <form id="greenQuiz" class="quiz-screen">



    <div class="quiz-step">
      <p>1. How often do you switch off lights when leaving a room?</p>
      <label><input type="radio" name="q1" value="3"> Always</label><br>
      <label><input type="radio" name="q1" value="2"> Sometimes</label><br>
      <label><input type="radio" name="q1" value="1"> Rarely</label>
    </div>

    <div class="quiz-step">
      <p>2. How do you usually commute?</p>
      <label><input type="radio" name="q2" value="3"> Walk / Bike / Public Transport</label><br>
      <label><input type="radio" name="q2" value="2"> Carpool</label><br>
      <label><input type="radio" name="q2" value="1"> Drive Alone</label>
    </div>

    <div class="quiz-step">
      <p>3. Do you use reusable shopping bags?</p>
      <label><input type="radio" name="q3" value="3"> Always</label><br>
      <label><input type="radio" name="q3" value="2"> Sometimes</label><br>
      <label><input type="radio" name="q3" value="1"> Never</label>
    </div>

    <div class="quiz-step">
      <p>4. How long are your showers?</p>
      <label><input type="radio" name="q4" value="3"> Under 5 minutes</label><br>
      <label><input type="radio" name="q4" value="2"> 5–10 minutes</label><br>
      <label><input type="radio" name="q4" value="1"> Over 10 minutes</label>
    </div>

    <div class="quiz-step">
      <p>5. How often do you recycle?</p>
      <label><input type="radio" name="q5" value="3"> Always</label><br>
      <label><input type="radio" name="q5" value="2"> Sometimes</label><br>
      <label><input type="radio" name="q5" value="1"> Never</label>
    </div>

    <div class="quiz-step">
      <p>6. Do you use energy-saving bulbs?</p>
      <label><input type="radio" name="q6" value="3"> Yes, all bulbs</label><br>
      <label><input type="radio" name="q6" value="2"> Some</label><br>
      <label><input type="radio" name="q6" value="1"> No</label>
    </div>

    <div class="quiz-step">
      <p>7. How often do you eat meat?</p>
      <label><input type="radio" name="q7" value="3"> Rarely</label><br>
      <label><input type="radio" name="q7" value="2"> A few times a week</label><br>
      <label><input type="radio" name="q7" value="1"> Daily</label>
    </div>

    <div class="quiz-step">
      <p>8. Do you unplug devices when not in use?</p>
      <label><input type="radio" name="q8" value="3"> Always</label><br>
      <label><input type="radio" name="q8" value="2"> Sometimes</label><br>
      <label><input type="radio" name="q8" value="1"> Never</label>
    </div>

    <div class="quiz-step">
      <p>9. How do you cool your home?</p>
      <label><input type="radio" name="q9" value="3"> Natural ventilation</label><br>
      <label><input type="radio" name="q9" value="2"> Fans</label><br>
      <label><input type="radio" name="q9" value="1"> AC</label>
    </div>

    <div class="quiz-step">
      <p>10. Do you compost food waste?</p>
      <label><input type="radio" name="q10" value="3"> Yes</label><br>
      <label><input type="radio" name="q10" value="2"> Sometimes</label><br>
      <label><input type="radio" name="q10" value="1"> No</label>
    </div>

    <div class="quiz-nav">
      <button type="button" id="prevBtn">⬅ Back</button>
      <button type="button" id="nextBtn">Next ➡</button>
      <button type="button" id="submitBtn" style="display:none;">Submit ✅</button>
    </div>
  </form>

  <div id="quiz-result" class="quiz-screen"></div>
</div>

<?php include "../footer.php"?>

<script>
const startBtn = document.getElementById("startBtn");
const quizStart = document.getElementById("quiz-start");
const quizForm = document.getElementById("greenQuiz");
const quizResult = document.getElementById("quiz-result");
const steps = quizForm.querySelectorAll(".quiz-step");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const submitBtn = document.getElementById("submitBtn");
let currentStep = 0;

// Start quiz
startBtn.addEventListener("click", () => {
  quizStart.classList.remove("active");
  quizForm.classList.add("active");
  showStep(currentStep);
});

function showStep(n) {
  steps.forEach(step => step.style.display = "none");
  steps[n].style.display = "block";

  prevBtn.style.display = n === 0 ? "none" : "inline-block";
  nextBtn.style.display = n === steps.length - 1 ? "none" : "inline-block";
  submitBtn.style.display = n === steps.length - 1 ? "inline-block" : "none";
}

nextBtn.addEventListener("click", () => {
  if (currentStep < steps.length - 1) {
    currentStep++;
    showStep(currentStep);
  }
});

prevBtn.addEventListener("click", () => {
  if (currentStep > 0) {
    currentStep--;
    showStep(currentStep);
  }
});

submitBtn.addEventListener("click", () => {
  let score = 0;
  for (let i = 1; i <= 10; i++) {
    let q = document.querySelector(`input[name="q${i}"]:checked`);
    if (q) score += parseInt(q.value);
  }

  quizForm.classList.remove("active");
  quizResult.classList.add("active");

  if (score >= 25) {
    quizResult.innerHTML = "💪 You’re an <b>Eco-Warrior!</b>";
  } else if (score >= 18) {
    quizResult.innerHTML = "🌱 You’re a <b>Rising Greenie!</b>";
  } else {
    quizResult.innerHTML = "⚡ You’re an <b>Energy Beginner!</b>";
  }
});
</script>

</body>
</html>
