// MAHALIA'S PART 


// ================================
// NAVIGATION ACTIVE LINK HANDLING
// ================================
// Section header comment — groups the code that handles making a clicked nav link "active".
// (No runtime effect; purely for developer organization.)
document.addEventListener("DOMContentLoaded", () => { // Wait until the HTML document is fully loaded before running the function — prevents querying DOM nodes that don't exist yet.
  const navLinks = document.querySelectorAll("nav a"); // Grab all anchor elements inside any <nav> element — these are the navigation links that will get the "active" class when clicked.

  navLinks.forEach((link) => { // Loop through each navigation link.
    link.addEventListener("click", function () { // Add a click event listener to the current link.
      navLinks.forEach((l) => l.classList.remove("active")); // Remove the "active" class from every nav link — ensures only one link looks active at a time.
      this.classList.add("active"); // Add the "active" class to the clicked link (`this` refers to the clicked element) so it visually indicates it is selected.
    });
  });
}); // End of DOMContentLoaded listener block — ensures the above only runs after DOM is ready.

// ================================
// SMOOTH SCROLL (for internal links)
// ================================
// Section header comment for smooth-scrolling behavior when clicking anchor links that point to page fragments.
const smoothScrollLinks = document.querySelectorAll('a[href^="#"]'); // Select all anchor links whose href starts with "#" — internal page anchors.

smoothScrollLinks.forEach((link) => { // Loop through each internal anchor link.
  link.addEventListener("click", function (e) { // Add click handler to prevent default jump and do smooth scroll instead.
    e.preventDefault(); // Prevent the browser's default instant jump to the anchor so we can animate a smooth scroll.
    const targetId = this.getAttribute("href").slice(1); // Get the href value (e.g., "#section") and strip the leading "#" to produce the ID string (e.g., "section").
    const target = document.getElementById(targetId); // Find the element with that ID on the page.

    if (target) { // Only attempt to scroll if the target element actually exists — safe guard.
      window.scrollTo({ // Use the window scrolling API to move the viewport.
        top: target.offsetTop - 70, // Set the vertical scroll target to the element's top position minus 70px (to offset sticky header height).
        behavior: "smooth", // Use browser smooth scrolling behavior for nicer UX.
      });
    }
  });
});

// ================================
// SCROLL REVEAL FOR CATEGORY CARDS
// ================================
// Section header for logic that adds/removes the "show" class to category cards as they scroll into view.
const cards = document.querySelectorAll(".category-card"); // Select all elements with class .category-card — these are the items we'll reveal on scroll.

const revealOnScroll = () => { // Define a function that checks each card's position and toggles visibility classes.
  const triggerBottom = window.innerHeight * 0.85; // Compute a trigger threshold: 85% of the viewport height — when card top is above this, it's considered "in view".

  cards.forEach((card) => { // Loop through every card.
    const cardTop = card.getBoundingClientRect().top; // Get the top position of the card relative to the viewport.

    if (cardTop < triggerBottom) { // If the top of the card is above the trigger line (i.e., it has scrolled into view enough),
      card.classList.add("show"); // add the "show" class — CSS will handle the reveal animation/opacity/transform.
    } else {
      card.classList.remove("show"); // otherwise, remove the "show" class so the card can hide again when scrolled out of view.
    }
  });
};

window.addEventListener("scroll", revealOnScroll); // Run revealOnScroll every time the user scrolls — keeps the reveal state in sync with viewport.
window.addEventListener("load", revealOnScroll); // Also run it once on page load to reveal cards already in view without needing a scroll.

// ================================
// CTA BUTTON HANDLER
// ================================
// Section header for the Call-To-Action button logic.
const ctaBtn = document.querySelector(".cta-btn"); // Select the CTA element with class .cta-btn (could be an <a> or <button>).

if (ctaBtn) { // Guard: only attach listener if the element exists on the page.
  ctaBtn.addEventListener("click", (e) => { // Add click handler to CTA button.
    e.preventDefault(); // Prevent default link navigation so we can show a message first.
    alert("🌍 Thank you for joining the EcoNest Community! Redirecting..."); // Show a simple confirmation alert to the user.
    window.location.href = "register.html"; // Then redirect the browser to register.html — this changes the page after the alert.
  });
}

// ================================
// QUIZ
// ================================
// Section header for the interactive quiz widget logic.

const startBtn = document.getElementById("startBtn"); // Select the Start Quiz button by its ID — clicking this begins the quiz flow.
  const quizStart = document.getElementById("quiz-start"); // Select the initial quiz splash screen container.
  const quizForm = document.getElementById("greenQuiz"); // Select the <form> that contains the quiz questions.
  const quizResult = document.getElementById("quiz-result"); // Select the container where results will be shown.
  const steps = quizForm.querySelectorAll(".quiz-step"); // Inside the form, select all .quiz-step elements — these are the individual question screens.
  const prevBtn = document.getElementById("prevBtn"); // Select the Back navigation button by its ID.
  const nextBtn = document.getElementById("nextBtn"); // Select the Next navigation button by its ID.
  const submitBtn = document.getElementById("submitBtn"); // Select the Submit button for the last step.
  let currentStep = 0; // Initialize the step counter to 0 (first step).

  // Start quiz
  startBtn.addEventListener("click", () => { // When Start Quiz is clicked...
    quizStart.classList.remove("active"); // hide the quiz splash screen by removing its "active" class.
    quizForm.classList.add("active"); // show the quiz form by adding the "active" class.
    showStep(currentStep); // display the first quiz step (index 0).
  });

  // Show step
  function showStep(n) { // Define a function that shows exactly the quiz step at index n and updates nav visibility.
    steps.forEach(step => step.style.display = "none"); // Hide all steps first — ensures only one step is visible.
    steps[n].style.display = "block"; // Show the requested step by setting its display to block.
    prevBtn.style.display = n === 0 ? "none" : "inline-block"; // Hide prev button on first step; otherwise show it.
    nextBtn.style.display = n === steps.length - 1 ? "none" : "inline-block"; // Hide next button on last step; otherwise show it.
    submitBtn.style.display = n === steps.length - 1 ? "inline-block" : "none"; // Show submit button only on last step; hide otherwise.
  }

  // Navigation
  nextBtn.addEventListener("click", () => { // Handler for Next button click.
    if (currentStep < steps.length - 1) { // If not already on the last step,
      currentStep++; // increment the current step index,
      showStep(currentStep); // and show the next step.
    }
  });

  prevBtn.addEventListener("click", () => { // Handler for Back button click.
    if (currentStep > 0) { // If not already on the first step,
      currentStep--; // decrement the current step index,
      showStep(currentStep); // and show the previous step.
    }
  });

  // Submit
  submitBtn.addEventListener("click", () => { // When Submit is clicked on the last step...
    let score = 0; // initialize the running total score to 0.
    for (let i = 1; i <= 10; i++) { // Loop through questions 1 to 10 (assumes your quiz has exactly 10 questions).
      let q = document.querySelector(`input[name="q${i}"]:checked`); // Find the checked radio input for question i.
      if (q) score += parseInt(q.value); // If a selection exists, convert its value to integer and add to the score.
    }
    quizForm.classList.remove("active"); // Hide the quiz form (remove "active" class).
    quizResult.classList.add("active"); // Show the result screen by adding "active" class.

    if (score >= 25) { // If the summed score is 25 or higher...
      quizResult.innerHTML = "💪 You’re an <b>Eco-Warrior!</b> Amazing job saving the planet!"; // Insert result HTML for top tier.
      quizResult.className = "quiz-screen active result-eco"; // Update the className to reflect result type (replaces any previous classes).
    } else if (score >= 18) { // If score is between 18 and 24 inclusive...
      quizResult.innerHTML = "🌱 You’re a <b>Rising Greenie!</b> Keep improving your eco-habits."; // Insert middle-tier result text.
      quizResult.className = "quiz-screen active result-greenie"; // Set classes for the middle-tier result.
    } else { // If score is below 18...
      quizResult.innerHTML = "⚡ You’re an <b>Energy Beginner!</b> Start small and grow greener!"; // Insert beginner-tier result text.
      quizResult.className = "quiz-screen active result-beginner"; // Set classes for the beginner-tier result.
    }
  });
