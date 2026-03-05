  <!-- MAHALIA'S PART  -->

  <!-- =========================
      HEADER HTML
  ========================= -->

  <?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

  $base_path = '/rwdd/RWDD group assignment/'; 
  ?>

  <header>

    <div class="header-top">
      <!-- Left: Logo with About Us and Help beside it -->
      <div class="left-section">
        <div class="logo">
          <h1>EcoNest</h1>
        </div>
        <nav class="mini-nav">
          <ul>
            <li><a href="<?php echo $base_path; ?>aboutus.php">About Us</a></li>
            <li><a href="<?php echo $base_path; ?>11. Help Page.php">Help</a></li>
          </ul>
        </nav>
      </div>

      <!-- Right: Navigation and Auth Buttons close together -->
      <div class="right-section">
        <!-- Main Navigation -->
        <nav class="main-nav">
          <ul>
            <li><a href="<?php echo $base_path; ?>index.php">Home</a></li>
            <li><a href="<?php echo $base_path; ?>energyconservation/energyconservation.php">Energy Conservation Tips</a></li>
            <li><a href="<?php echo $base_path; ?>recyclingprogram/recyclingprogram.php">Recycling Programs</a></li>
            <li><a href="<?php echo $base_path; ?>communitygardening/communitygardening.php">Community Gardening</a></li>
            <li><a href="<?php echo $base_path; ?>ecofriendlyproductswap/view.php">Eco-Friendly Product Swap</a></li>
          </ul>
        </nav>

        <!-- Auth Buttons & Hamburger -->
        <div class="auth-section">
          <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Show user is logged in (optional) -->
            <div class="user-welcome" style="color: var(--white); margin-right: 1rem; font-size: 0.9rem;">
              Welcome, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?>
            </div>
          <?php else: ?>
            <!-- Show login/register buttons only when user is NOT logged in -->
            <div class="auth-buttons">
              <a href="<?php echo $base_path; ?>signinsignup/login.php" class="login">Login</a>
              <span class="separator">|</span>
              <a href="<?php echo $base_path; ?>signinsignup/register.php" class="register">Register</a>
            </div>
          <?php endif; ?>
          
          <div class="hamburger-wrapper">
            <div class="hamburger" id="hamburger">☰</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tagline Row -->
    <div class="header-bottom">
      <div class="tagline">
        <p>Promoting Sustainable Living</p>
      </div>
    </div>

    <!-- Hamburger Dropdown -->
    <div class="hamburger-menu" id="hamburgerMenu">
      <ul>
        <li class="mobile-only"><a href="<?php echo $base_path; ?>index.php"><h5>Home</h5></a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <!-- Show these when user is logged in -->
          <li><a href="<?php echo $base_path; ?>12. My Profile.php"><h5>My Profile</h5></a></li>
          <li><a href="<?php echo $base_path; ?>UpdateProfile.php"><h5>Settings</h5></a></li> 
          <li><a href="<?php echo $base_path; ?>notifications.php"><h5>Notifications</h5></a></li> 
        <?php else: ?>
          <!-- Show these when user is NOT logged in -->
          <li><a href="<?php echo $base_path; ?>signinsignup/login.php"><h5>Login</h5></a></li>
          <li><a href="<?php echo $base_path; ?>signinsignup/register.php"><h5>Register</h5></a></li>
        <?php endif; ?>
        
        <li class="mobile-only"><a href="<?php echo $base_path; ?>energyconservation/energyconservation.php"><h5>Energy Conservation Tips</h5></a></li>
        <li class="mobile-only"><a href="<?php echo $base_path; ?>recyclingprogram/recyclingprogram.php"><h5>Recycling Programs</h5></a></li>
        <li class="mobile-only"><a href="<?php echo $base_path; ?>communitygardening/communitygardening.php"><h5>Community Gardening</h5></a></li>
        <li class="mobile-only"><a href="<?php echo $base_path; ?>ecofriendlyproductswap/view.php"><h5>Eco Product Swap</h5></a></li>
        
        <?php if (isset($_SESSION['user_id'])): ?>
          <li><a href="<?php echo $base_path; ?>logout.php"><h5>Logout → </h5></a></li>
        <?php endif;?>
      </ul>
    </div>
  </header>

  <style>
  /* =========================
    HEADER CSS - COMPACT LAYOUT
  ========================= */
  :root {
    --green-dark: #009d27;
    --green-mid: #2d6a4f;
    --green-deep: #094a0a;
    --green-light: #95d5b2;
    --white: #ffffff;
  }

  /* Header Base Styles */
  header {
    background: linear-gradient(90deg, var(--green-dark), var(--green-mid));
    color: var(--white);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    position: sticky;
    top: 0;
    z-index: 1000;
    width: 100%;
  }

  /* Top Row */
  .header-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.8rem 2rem;
    border-bottom: 1px solid rgba(255,255,255,0.2);
  }

  /* Left Section: Logo + About Us & Help */
  .left-section {
    display: flex;
    align-items: center;
    gap: 2rem;
  }

  .logo h1 {
    font-size: 2rem;
    font-weight: bold;
    margin: 0;
    white-space: nowrap;
    color: var(--white);
  }

  .mini-nav ul {
    list-style: none;
    display: flex;
    gap: 1.5rem;
    margin: 0;
    padding: 0;
  }

  .mini-nav a {
    color: var(--white);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    position: relative;
    padding-bottom: 2px;
    white-space: nowrap;
  }

  .mini-nav a::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px;
    bottom: 0;
    left: 0;
    background: var(--green-light);
    transition: width 0.3s ease;
  }

  .mini-nav a:hover::after {
    width: 100%;
  }

  .mini-nav a:hover {
    color: #b7e4c7;
  }

  /* Right Section: Navigation + Auth Buttons close together */
  .right-section {
    display: flex;
    align-items: center;
    gap: 2rem;
  }

  /* Main Navigation */
  .main-nav {
    display: flex;
  }

  .main-nav ul {
    list-style: none;
    display: flex;
    gap: 1.5rem;
    margin: 0;
    padding: 0;
  }

  .main-nav a {
    color: var(--white);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    position: relative;
    padding-bottom: 4px;
    white-space: nowrap;
  }

  .main-nav a::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px;
    bottom: 0;
    left: 0;
    background: var(--green-light);
    transition: width 0.3s ease;
  }

  .main-nav a:hover::after,
  .main-nav a.active::after {
    width: 100%;
  }

  .main-nav a:hover {
    color: #b7e4c7;
  }

  /* Auth Section: Login/Register close to navigation */
  .auth-section {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .auth-buttons {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .auth-buttons a {
    padding: 0.4rem 1rem;
    border-radius: 5px;
    font-size: 0.9rem;
    font-weight: bold;
    text-decoration: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.25);
    transition: all 0.3s ease;
    white-space: nowrap;
  }

  .auth-buttons a.login {
    background: #015d25;
    color: var(--white);
    border: 1px solid #014220;
  }

  .auth-buttons a.register {
    background: #2ccb00;
    color: var(--white);
    border: 1px solid #25a800;
  }

  .auth-buttons a.login:hover {
    background: #014220;
    transform: translateY(-1px);
  }

  .auth-buttons a.register:hover {
    background: #25a800;
    transform: translateY(-1px);
  }

  .separator {
    color: rgba(255,255,255,0.6);
    font-weight: normal;
  }

  /* User welcome message */
  .user-welcome {
    font-weight: 500;
  }

  /* Bottom Row - Tagline */
  .header-bottom {
    display: flex;
    justify-content: center;
    padding: 0.4rem 2rem;
    background: rgba(0,0,0,0.1);
  }

  .tagline p {
    font-size: 0.9rem;
    color: #d8f3dc;
    margin: 0;
    font-style: italic;
  }

  /* Hamburger Menu */
  .hamburger-wrapper {
    position: relative;
  }

  .hamburger {
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0.3rem 0.6rem;
    border-radius: 4px;
    transition: background 0.2s ease;
    background-color: var(--green-deep);
    color: var(--white);
  }

  .hamburger:hover {
    background: rgba(255,255,255,0.1);
  }

  /* Hamburger Dropdown */
  .hamburger-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 0.5rem;
    background: #006913;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    display: none;
    z-index: 2500;
    min-width: 220px;
  }

  .hamburger-menu ul {
    list-style: none;
    margin: 0;
    padding: 0.5rem 0;
  }

  .hamburger-menu li {
    border-bottom: 1px solid rgba(255,255,255,0.15);
  }

  .hamburger-menu li:last-child {
    border-bottom: none;
  }

  .hamburger-menu a {
    display: block;
    padding: 0.8rem 1.2rem;
    color: var(--white);
    font-weight: bold;
    font-size: 0.9rem;
    text-decoration: none;
    transition: background 0.3s;
  }

  .hamburger-menu a:hover {
    background: #3ad557;
    color: #002400;
    border-radius: 6px;
  }

  .hamburger-menu h5 {
    margin: 0;
    font-size: 0.9rem;
  }

  /* Responsive Design */
  @media (max-width: 1024px) {
    .header-top {
      padding: 0.8rem 1rem;
    }
    
    .main-nav ul {
      gap: 1rem;
    }
    
    .main-nav a {
      font-size: 0.9rem;
    }
    
    .right-section {
      gap: 1.5rem;
    }
  }

  @media (max-width: 768px) {
    .main-nav {
      display: none;
    }
    
    .mini-nav {
      display: none;
    }
    
    .header-bottom {
      display: none;
    }
    
    .header-top {
      padding: 0.6rem 1rem;
    }
    
    .auth-buttons {
      gap: 0.3rem;
    }
    
    .auth-buttons a {
      padding: 0.3rem 0.7rem;
      font-size: 0.8rem;
    }
    
    .separator {
      display: none;
    }
    
    .user-welcome {
      font-size: 0.8rem;
      margin-right: 0.5rem;
    }
  }

  @media (min-width: 769px) {
    .hamburger-menu .mobile-only {
      display: none;
    }
  }

  /* Show menu when active */
  .hamburger-menu.show {
    display: block;
  }
  </style>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const hamburger = document.getElementById("hamburger");
      const menu = document.getElementById("hamburgerMenu");

      if (hamburger && menu) {
        hamburger.addEventListener("click", function (e) {
          e.stopPropagation();
          menu.classList.toggle("show");
        });

        // Close if click outside
        document.addEventListener("click", function (e) {
          if (!hamburger.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.remove("show");
          }
        });
      }
    });
  </script>