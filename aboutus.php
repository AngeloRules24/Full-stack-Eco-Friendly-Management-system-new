<?php
    include('header.php');  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #2d5a27;
            --secondary-color: #4a7c59;
            --text-color: #333;
            --background-color: #fff;
            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.5rem;
            --spacing-lg: 2rem;
            --spacing-xl: 3rem;
            --border-radius: 12px;
        }

        /* FIX: Update body styles for proper footer positioning */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

      * {
          margin: 0px;
          padding: 0px;
          box-sizing: border-box;
        }

        body{
            display: flex;
            flex-direction: column;
            font-family: "Poppins", sans-serif;
        }
        .section {
          width: 100%;
          height: 101vh;
          background-color: #ddd;
        }
        .section .values{
          padding-top: 100px;
          padding-left: 20px;
          padding-bottom: 20px
        }
        .container {
          width: 100%;
          display: flex;
          margin: auto;
          padding-top: 100px;
        }
        .content-section {
          float: left;
        }
        .image-section {
          float: right;
          width: 40%;
          height: 35%;
          padding-right: 30px;
        }
        .image-section img {
          padding-left: 30px;
          width: 100%;
          height: auto;
        }
        .content-section .title {
          padding-left: 30px;
          text-transform: uppercase;
          font-size: 28px;
        }
        .content-section .content h3 {
          margin-top: 20px;
          padding-left: 30px;
          color: #333;
          font-size: 19px;
        }
        .content-section .content p {
          padding-left: 30px;
          margin-top: 10px;
          font-family: sans-serif;
          font-size: 18px;
          line-height: 1.5;
        }
        .content-section .content .button {
          padding-left: 30px;
          margin-top: 20px;
        }
        button:hover{
          background-image: linear-gradient(to right, #a52a2a, #a52a2a);
        }
        button{
          background-image: linear-gradient(to right, #3d3d3d, #3d3d3d);
          border-radius: 20px;
          border: 0px;
          box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
          color: #fff;
          cursor: pointer;
          padding: 10px 25px;
          height: 50px;
          width: 180px;
          font-size: 20px;
          text-transform: uppercase;

        }

        button:active{
          opacity: 0.8;
        }
        .contactUs{
          /* box-sizing: border-box; */
          background-color: rgba(0, 0, 0, 0.3);
          opacity: 0;
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          transition: all 0.3s ease-in-out;
          z-index: -1;

          display: flex;
          align-items: center;
          justify-content: center;
        }

        .contactUs.open{
          opacity: 1;
          z-index: 999;
        }

        .contactUs-inner{
          background-color: #82ba5aff;
          border-radius: 5px;
          box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
          padding: 15px 25px;
          text-align: center;
          width: 380px;
        }
        .contactUs-inner h2{
          margin: 0;
        }
        .contactUs-inner p{
          line-height: 24px;
          margin: 10px 0;
        }
        .content-section .content .button a {
          background-color: #3d3d3d;
          padding-left: 30px;
          width: fit-content;
          border-radius: 30px;
          padding: 12px 40px;
          text-decoration: none;
          color: #fff;
          font-size: 25px;
          letter-spacing: 1.5px;
        }

        .content-section .content .button a:hover {
          background-color: #a52a2a;
          color: #fff;
        }
        .content-section .content .social {
          margin-top: 40px;
        }
        .content-section .content .social i {
          color: #a52a2a;
          font-size: 30px;
          padding: 0px 10px;
          padding-left: 30px;
        }
        .content-section .content .social i:hover {
          color: #3d3d3d;
        }

        .social i {
          color: #a52a2a;
          font-size: 50px;
          padding: 0px 10px;
          padding-left: 30px;
        }
        .social i:hover {
          color: #3d3d3d;
        }
        .values h3 {
          padding-left: 30px;
          margin-top: 20px;
          color: #333;
          font-size: 22px;
        }

        .values .content p {
          margin-top: 10px;
          font-family: poppsins, sans-serif;
          font-size: 18px;
          line-height: 1.5;
        }

        @media screen and (max-width: 768px) {
          .container {
            width: 80%;
            display: block;
            margin: auto;
            padding-top: 50px;
          }
          .content-section {
            float: none;
            width: 100%;
            display: block;
            margin: auto;
          }
          .image-section {
            float: none;
            width: 100%;
            display: block;
            margin: auto;
          }
          .image-section img {
            width: 100%;
            height: auto;
            display: block;
            margin: auto;
          }

          .content-section .title {
            text-align: left;
            font-size: 19px;
          }
          .content-section .content .button {
            text-align: center;
          }
          .content-section .content .button a {
            padding: 9px 30px;
          }
          .content-section .social {
            text-align: center;
          }
        }

        /* values */
        .values h3 {
          margin-top: 20px;
          color: #333;
          font-size: 19px;
        }
        html {
          scroll-behavior: smooth;
        }

        * {
          box-sizing: border-box;
          padding: 0;
          margin: 0;
        }
        html {
          scroll-behavior: smooth;
        }

        body {
          font-family: poppins, sans-serif;
          font-size: 1rem;
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
        }
        .img-box img {
          display: block;
          width: 100%;
          height: 30rem;
          object-fit: cover;
        }
        .grid {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          justify-content: center;
          grid-gap: 2rem;
          text-align: center;
          width: 90%;
          margin: auto;
        }

        .card1,
        .card2,
        .card3,
        .card4,
        .card5,
        .card6 {
          display: block;
          overflow: hidden;
          box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.7);
          cursor: pointer;
          transition: 0.2s;
          position: relative;
        }
        .card-content {
          position: absolute;
          background-color: rgba(0 0 0/50%);
          bottom: 0;
          color: #fff;
          width: 100%;
          height: 20%;
          padding: 2.2rem 0;
          overflow: hidden;
          transition: 0.7s;
        }
        .card-content h1 {
          font-size: 2rem;
          font-weight: 600;
          text-transform: uppercase;
        }
        .card-content p {
          font-size: 1rem;
          font-weight: 400;
          line-height: 1.5rem;
          padding: 1.2rem;
        }
        .card-content:hover {
          height: 60%;
          transition: 0.7s;
        
        }
        @media screen and (max-width: 1024px) {
          .grid {
            grid-template-columns: repeat(2, 1fr);
            padding-bottom: 40px;
          }
        }
        @media screen and (max-width: 767px) {
          .grid {
            grid-template-columns: repeat(1, 1fr);
            padding-bottom: 40px;
          }
        }

        /* goals */
        .goals .content h3 {
          margin-top: 20px;
          color: #333;
          font-size: 22px;
        }
        .goals .content p {
          margin-top: 10px;
          font-family: sans-serif;
          font-size: 18px;
          line-height: 1.5;
        }
        .container .goals {
          width: 100%;
          height: 30vh;
          background-color: #ddd;
        }
    </style>
    
    <title>About us Section</title>
  </head>
  <body>
    <div class="header">
    </div>
    <div class="section">
      <div class="container">
        <div class="content-section">
          <div class="title">
            <h1>About us</h1>
          </div>
          <div class="image-section">
            <img src="hands.png" />
          </div>
          <div class="content">
            <h3>Our Mission</h3>
            <p>
              Our mission is to inspire and empower individuals to live
              sustainably by providing practical tips, eco-friendly product
              swaps, and community events that promote environmental awareness.
              We aim to create a collective movement toward conserving our
              planet’s resources, fostering mindful habits, and building a
              greener, cleaner future for all.
            </p>
            <br /><br />
            <div class="button">
              <button type="submit" id="openContact">Contact Us</button>

              <div class="contactUs" id="contactUs">
                <div class="contactUs-inner">
                  <h2>Contact Information</h2>
                  <p>
                    Tel☎️: <b>+60 111 222 4567</b>
                    <br>
                    Email📧: <b>info@econest.com</b>
                  </p>
                  <button id="closeContact">Close</button>
                </div>
              </div>

            </div>

            <div class="social">
              <a href="https://www.facebook.com/"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a href="https://x.com"><i class="fab fa-twitter"></i></a>
              <a href="https://instagram.com"
                ><i class="fab fa-instagram"></i
              ></a>
              <a href="https://mail.google.com"><i class="fa fa-envelope" ></i></a>
            </div>
          </div>
          <br /><br /><br /><br />

          <section class="values">
            <br /><br />

              <h2>Our Values</h2>
              <br>
            <div class="cards grid">
              <div class="card1">
                <div class="img-box">
                  <img src="pictures/sustain.png" alt="" />
                </div>
                <div class="card-content">
                  <h1>Sustainability</h1>
                  <p>
                    We commit to promoting choices and practices that protect
                    the planet for future generation, sustaiable ways to
                    contribute to better consumption and overall caution with
                    our daily habits.
                  </p>
                </div>
              </div>

              <div class="card2">
                <div class="img-box">
                  <img src="pictures/education.png" alt="" />
                </div>
                <div class="card-content">
                  <h1>Education</h1>
                  <p>
                    We believe in the power of knowledge to drive change. We
                    strive to educate our community about environmental issues
                    and practical solutions through informative content,
                    workshops, and events. Harbouring a culture of menaningful
                    environmental change.
                  </p>
                </div>
              </div>

              <div class="card3">
                <div class="img-box">
                  <img src="pictures/comm.png" alt="" />
                </div>
                <div class="card-content">
                  <h1>Community</h1>
                  <p>
                    We value the strength of a united community. We aim to
                    foster connections among individuals who share a passion for
                    sustainability, creating a supportive network where ideas,
                    resources, and encouragement are freely exchanged. Bringig
                    people together through shared goals and green initiatives.
                  </p>
                </div>
              </div>

              <div class="card4">
                <div class="img-box">
                  <img src="pictures/innovative.png" alt="" />
                </div>
                <div class="card-content">
                  <h1>Innovation</h1>
                  <p>
                    We embrace creativity and solutions that encompass modern
                    and effective approaches to sustainability. We encourage
                    innovative thinking in product design, lifestyle
                    changes,making sustainable living easier and more accessible
                    for everyone.
                  </p>
                </div>
              </div>

              <div class="card5">
                <div class="img-box">
                  <img src="pictures/action.png" alt="" />
                </div>
                <div class="card-content">
                  <h1>Action</h1>
                  <p>
                    We believe that actions speak louder than words. We are
                    dedicated to inspiring and facilitating tangible actions
                    that contribute to environmental conservation, encouraging
                    our community to make a positive impact through everyday
                    choices and collective efforts.
                  </p>
                </div>
              </div>
                              <div class="card6">
                  <div class="img-box">
                    <img src="pictures/goals.png" alt="" />
                  </div>
                  <div class="card-content">
                    <h1>Goals</h1>
                    <p>
                      <ul>
                        <li>Partner with local eco-innitiatives</li>
                        <li>Having an interactive feedback system</li>
                        <li>Collaborate with educational institutions</li>
                        <li>Achieve measureable environmental impact</li>
                      </ul>
                    </p>
                  </div>
                </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    
    <script>
      const openBtn = document.getElementById("openContact");
      const closeBtn = document.getElementById("closeContact");
      const contactUs = document.getElementById("contactUs");

      openBtn.addEventListener("click", () => {
        contactUs.classList.add("open");
      });

      closeBtn.addEventListener("click", () => {
        contactUs.classList.remove("open");
      })
    </script>



  </body>
</html>
