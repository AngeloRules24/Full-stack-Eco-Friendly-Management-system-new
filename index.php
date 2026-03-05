<!--Please ensure the URL starts with localhost/rwdd/rwdd%group%assignment-->

<?php

$user = null;
if (isset($_SESSION['user_id'])) {
    include "conn.php";
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $dbConn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

include "header.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoNest Homepage</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="homepage.css">
    <script src="homepage.js"></script>
</head>

<body>

    <!-- Homepage content -->
    <section class="slidesection">
        <div class="slidebox">
            <div class="slide">
                <img src="energyslideshow.jpg" alt="Energy">
            </div>
            <div class="slide">
                <img src="homegardeningslideshow.jpg" alt="Garden">
            </div>
            <div class="slide">
                <img src="recyclingslideshow.webp" alt="Recycling">
            </div>
            <div class="slide">
                <img src="productswapslideshow.jpg" alt="Product Swap">
            </div>
            <button class="left">❮</button>
            <button class="right">❯</button>
            <div class="slidenavigation">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </section>

    <section>
        <div>
            <h1 class="intro">Welcome to EcoNest</h1>
            <p class="introp">Greetings from EcoNest, the premier destination for sustainable living in your community. We are merely a
                group of neighbours who created this website to support one another in exchanging information, ideas,
                and a shared objective of safeguarding our house.</p>
        </div>
    </section>

</body>

</html>

<?php include "footer.php";?>
