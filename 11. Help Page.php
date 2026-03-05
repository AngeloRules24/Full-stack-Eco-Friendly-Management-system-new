<!-- MAHALIA'S PART  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoNest - Help Page</title>
  <link rel="stylesheet" href="energyconservation/1. Main Style.css">
 </head>
<body>


<?php include "header.php"; ?>


  <!-- Main Banner -->
  <section class="hero energy-hero">
    <div class="hero-text">
      <h2>Help & Support</h2>
      <p>
        Welcome to EcoNest support! Find answers to common questions below or browse our resources for guidance.
      </p>
    </div>
  </section>

   <!-- ===== Main Content ===== -->
<main>
  <!-- ===== Help & Support Section ===== -->
  <section id="help-support" style="max-width: 800px; margin: 2rem auto 3rem auto; text-align: center; padding-top: 20px;" >
    <h1>FAQ</h1>
    <p>Find quick answers to common questions about our services and tools. Click a question to view the answer and get the help you need fast.</p>

    <!-- FAQ Section -->
    <div id="faq" style="text-align: left; margin-top: 2rem;">
      <div class="faq-item">
        <b>How do I calculate solar energy savings?</b>
        <div class="faq-answer">Use our Solar Energy page calculator. Input your panel wattage, sunlight hours, and number of panels to estimate savings.</div>
      </div>
      <div class="faq-item">
        <b>Can I use multiple energy calculators at the same time?</b>
        <div class="faq-answer">Yes! Each calculator works independently. You can run Solar, Wind, Heat, and other calculators simultaneously.</div>
      </div>
      <div class="faq-item">
        <b>Why are my calculator results incorrect?</b>
        <div class="faq-answer">Double-check your input values. Make sure all units like kWh, watts, or hours are correct and consistent.</div>
      </div>
      <div class="faq-item">
        <b>How do I reset my quiz results?</b>
        <div class="faq-answer">Go to the quiz widget and press the reset button at the end of your quiz, or reload the page to start fresh.</div>
      </div>
    </div>
  </section>
</main>


  <!-- ===== Contact Support Form Section ===== -->
  <section id="contact-support" 
           style="background:#f0f8ff; padding:2rem; border-radius:16px; border:2px solid #00bfff; max-width:800px; margin:0 auto 3rem auto; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
    <h2>Contact Support</h2>
    <p>If your question isn’t answered above, send us a message and our support team will respond as soon as possible.</p>

    <form id="supportForm">
      <div class="form-group">
        <label for="name">Your Name:</label>
        <input type="text" id="name" required>
      </div>

      <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" id="email" required>
      </div>

        <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="message" rows="5" required
        style="width: 100%; resize: vertical; box-sizing: border-box;"></textarea>
        </div>

      <button type="submit" class="btn">Send Message</button>
      <div id="successMsg" class="success-message">Thank you! Your message has been sent.</div>
    </form>
  </section>
</main>


<style>
  /* ===== FAQ Styles ===== */

      .mini-nav ul {
      display: flex;
      flex-direction: row;     /* always horizontal */
      flex-wrap: nowrap;       /* prevent wrapping */
      gap: 0.8rem;               /* spacing between links */
      align-items: center;
    }
    .mini-nav li {
      display: inline-block; 
      white-space: nowrap;     /* stop breaking into two lines */
    }

.hero {
  background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
    url("help.png")
    no-repeat center/cover;
  color: #fff;
  text-align: center;
  padding: 6rem 2rem;
}

  #faq {
    margin-top: 1rem;
  }

  .faq-item {
    margin-bottom: 1rem;
    padding: 1rem;
    border-left: 4px solid #00bfff;
    background: #ffffff;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
    font-size: 18px;
  }

  .faq-item:hover {
    background: #e0f7ff;
  }

  .faq-answer {
    display: none;
    margin-top: 1.5rem;
    padding-left: 2rem;
    color: #292929;
  }

  /* ===== Contact Form Styles ===== */
  #contact-support h2 {
    margin-bottom: 1rem;
  }

  .form-group {
    margin-bottom: 1rem;
  }

  .form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.3rem;
    color: #009500;
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 0.5rem;
    font-size: 0.95rem;
    border-radius: 6px;
    border: 1px solid #a0d4ff;
  }

  .form-group input:focus,
  .form-group textarea:focus {
    border-color: #009500;
    box-shadow: 0 0 4px rgba(0, 153, 0, 0.3);
    outline: none;
  }

  .btn {
    background: #00bfff;
    color: #fff;
    border: none;
    padding: 0.6rem 1.2rem;
    font-size: 1rem;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 0.5rem;
  }

  .btn:hover {
    background: #0095d0;
  }

  .success-message {
    display: none;
    padding: 1rem;
    background: #d4f7d4;
    border: 1px solid #00b300;
    color: #006600;
    border-radius: 6px;
    margin-top: 1rem;
    text-align: center;
  }

  /* ===== Responsive ===== */
  @media (max-width: 768px) {
    #contact-support {
      padding: 1.5rem;
    }
    .faq-item {
      padding: 0.6rem;
    }
    header nav ul {
      flex-direction: column;
      gap: 0.5rem;
    }
  }
</style>

<script>
  // Toggle FAQ Answers
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    item.addEventListener('click', () => {
      const answer = item.querySelector('.faq-answer');
      answer.style.display = (answer.style.display === 'block') ? 'none' : 'block';
    });
  });

  // Contact Form Submission
  const form = document.getElementById('supportForm');
  const successMsg = document.getElementById('successMsg');

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    successMsg.style.display = 'block';
    form.reset();
    setTimeout(() => { successMsg.style.display = 'none'; }, 5000);
  });
</script>


<?php include "footer.php"?>

  <!-- Link to JavaScript -->
  <script src="energyconservation/1. Main Script.js"></script>

</body>
</html>
