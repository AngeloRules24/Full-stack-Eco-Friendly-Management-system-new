<?php
include "../header.php"; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Community Gardening | EcoNest</title>
<link rel="stylesheet" href="../reset.css">
<link rel="stylesheet" href="communitygardening.css">

</head>

<body>

<main class="container">

    <div class="GardenContainer">
        <img src="garden.jpg" alt="garden">
        <h2>We're Promoting Sustainability</h2>
        <div class="CommunityGarden">
            <h3>Join Our Community Garden</h3>
        </div>
        <button type="button" onclick= "window.location.href='gardeningproject/gardeningproject.php'">Join Us</button>
    </div>

    <section>
        <h2 class="FeaturesTitle">Get Involved</h2>
        <div class="twoContainer">
            <a href="sharegardeningtip/sharegardeningtip.php">
                <div class="featureCard">
                    <img src="gardeningtips.png" alt="Gardening Tips">
                    <h4>Share Gardening Tip</h4>
                </div>
            </a>

            <a href="exchangehomegrownproduce/exchangehomegrownproduce.php">
                <div class="featureCard">
                    <img src="exchangehomegrownproduce.png" alt="Product Exchange">
                    <h4>Exchange Home Grown Produce</h4>
                </div>
            </a>
        </div>
    </section>

    <section>
        <div class="VideoContainer">
            <video src="short vid.mp4" autoplay muted loop playsinline></video>
        </div>
    </section>
</main>

<?php include "../footer.php"?>
</body>
</html>