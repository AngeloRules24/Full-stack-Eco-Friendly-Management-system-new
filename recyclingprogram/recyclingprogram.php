<?php

$user = null;
if (isset($_SESSION['user_id'])) {
    include "../conn.php"; 
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $dbConn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

include "../header.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycling Program</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="recyclingprogram.css">

</head>

<body>

    <!-- Page Header -->
    <header class="RecyclingProgram">
        <h1>Recycling Programs</h1>
        <p>Welcome to our recycling program! Every bottle, can, and box you recycle is a step toward a healthier planet!</p>
    </header>

    <!-- Materials Section -->
    <section>
        <h2 class="Recycled">Materials we accept :)</h2>
        <div class="recycledItems">
            <article class="itemcard">
                <img src="glass bottle.jpg" alt="Glass Bottle" class="itemImage">
                <h4>Glass</h4>
                <p>Jars, glass bottles, and other types of glass containers</p>
            </article>
            <article class="itemcard">
                <img src="Paper.jpg" alt="Paper" class="itemImage">
                <h4>Paper</h4>
                <p>Cardboard, newspaper, and coloured papers</p>
            </article>
            <article class="itemcard">
                <img src="plastic.jpg" alt="Plastic Bottles" class="itemImage">
                <h4>Plastic Bottles</h4>
                <p>PET bottles and other plastic items</p>
            </article>
            <article class="itemcard">
                <img src="ewaste.webp" alt="Scrap e-waste" class="itemImage">
                <h4>Scrap e-waste</h4>
                <p>Old electronics, monitors, heating systems</p>
            </article>
            <article class="itemcard">
                <img src="clothess.jpeg" alt="Clothes" class="itemImage">
                <h4>Clothes</h4>
                <p>Clothes, fabrics, and shoes</p>
            </article>
            <article class="itemcard">
                <img src="Aluminium-packaging-2015.jpg" alt="Aluminium" class="itemImage">
                <h4>Aluminium</h4>
                <p>Cans, foil, and food containers</p>
            </article>
        </div>
    </section>

    <!-- Recycling Station Info -->
    <section>
        <header class="header3">
            <h2>Help the planet by using the recycling stations available at nearby shopping centers:</h2>
        </header>

        <!-- Kuala Lumpur -->
        <h3 class="citykl">Kuala Lumpur</h3>
        <div class="mallgrid">
            <a href="https://www.google.com/maps/dir//168,+Bukit+Bintang+Rd,+Bukit+Bintang,+55100+Kuala+Lumpur" target="_blank" class="mallcard">
                <img src="pavillion.jpg" alt="Pavilion KL Image">
                <div class="mallName">Pavilion KL</div>
                <div class="mallsContent">
                    <div class="mallAdress"><strong>Address:</strong> 168, Bukit Bintang Rd, Bukit Bintang, 55100 Kuala Lumpur</div>
                    <div class="mallTime"><strong>Open:</strong> Monday-Sunday, 10am-10pm</div>
                    <div class="mallLocation"><strong>Recycling Station:</strong> Level 4 of Pavilion Elite</div>
                </div>
            </a>
            <a href="https://www.google.com/maps/dir//Lot+No.+241,+Level+2+Menara,+Petronas+Twin+Tower,+Kuala+Lumpur" target="_blank" class="mallcard">
                <img src="suriaklcc.jpg" alt="Suria KLCC Image">
                <div class="mallName">Suria KLCC</div>
                <div class="mallsContent">
                    <div class="mallAdress"><strong>Address:</strong> Lot No. 241, Level 2 Menara, Petronas Twin Tower, Kuala Lumpur City Centre</div>
                    <div class="mallTime"><strong>Open:</strong> Monday-Sunday, 10am-10pm</div>
                    <div class="mallLocation"><strong>Recycling Station:</strong> Level 2, Lot 226B</div>
                </div>
            </a>
            <a href="https://www.google.com/maps/dir//Lingkaran+Syed+Putra,+Mid+Valley+City,+59200+Kuala+Lumpur" target="_blank" class="mallcard">
                <img src="Mid-Valley-Megamall.jpg" alt="Mid Valley Megamall Image">
                <div class="mallName">Mid Valley Megamall</div>
                <div class="mallsContent">
                    <div class="mallAdress"><strong>Address:</strong> Lingkaran Syed Putra, Mid Valley City, 59200 Kuala Lumpur</div>
                    <div class="mallTime"><strong>Open:</strong> Monday-Sunday, 10am-10pm</div>
                    <div class="mallLocation"><strong>Recycling Station:</strong> Level 1, Zone S, F-083</div>
                </div>
            </a>
            <a href="https://www.google.com/maps/dir//201,+Jalan+Tun+Sambanthan,+Kuala+Lumpur+Sentral" target="_blank" class="mallcard">
                <img src="img-nu-sentral-1.jpg" alt="NU Sentral Image">
                <div class="mallName">NU Sentral</div>
                <div class="mallsContent">
                    <div class="mallAdress"><strong>Address:</strong> 201, Jalan Tun Sambanthan, Kuala Lumpur Sentral</div>
                    <div class="mallTime"><strong>Open:</strong> Monday-Sunday, 10am-10pm</div>
                    <div class="mallLocation"><strong>Recycling Station:</strong> Recycling bins available</div>
                </div>
            </a>
        </div>

        <!-- Selangor -->
        <h3 class="citykl">Selangor</h3>
        <div class="mallgrid">
            <a href="https://www.google.com/maps/dir//1,+Lebuh+Bandar+Utama,+Petaling+Jaya" target="_blank" class="mallcard">
                <img src="1utama-mall.jpg" alt="1 Utama Mall Image">
                <div class="mallName">1 Utama Shopping Centre</div>
                <div class="mallsContent">
                    <div class="mallAdress"><strong>Address:</strong> 1, Lebuh Bandar Utama, Bandar Utama, 47800 Petaling Jaya</div>
                    <div class="mallTime"><strong>Open:</strong> Monday-Sunday, 10am-10pm</div>
                    <div class="mallLocation"><strong>Recycling Station:</strong> B2 Highstreet</div>
                </div>
            </a>
            <a href="https://www.google.com/maps/dir//1,+Jalan+SS+7/26a,+Petaling+Jaya" target="_blank" class="mallcard">
                <img src="Paradigm-Mall-1.jpg" alt="Paradigm Mall Image">
                <div class="mallName">Paradigm Mall</div>
                <div class="mallsContent">
                    <div class="mallAdress"><strong>Address:</strong> 1, Jalan SS 7/26a, Ss 7, 47301 Petaling Jaya</div>
                    <div class="mallTime"><strong>Open:</strong> Monday-Sunday, 10am-10pm</div>
                    <div class="mallLocation"><strong>Recycling Station:</strong> Ground floor, near canteen</div>
                </div>
            </a>
        </div>
    </section>

    <!-- How to Participate -->
    <section>
        <header class="header3">
            <h2>How you can participate!</h2>
        </header>

        <div class="recycledItems">
            <article class="itemcard">
                <img src="bo.jpeg" alt="Recycling Station" class="itemhyp">
                <p>Find recycling bins or stations at nearby malls.</p>
            </article>
            <article class="itemcard">
                <img src="vector-grouping-items-that-must-260nw-1667030800.webp" alt="Sorting" class="itemhyp">
                <p>Ensure items are sorted into the correct categories.</p>
            </article>
            <article class="itemcard">
                <img src="raise.webp" alt="Share" class="itemhyp">
                <p>Share the message with friends and family.</p>
            </article>
        </div>
    </section>


<?php include "../footer.php"?>
</body>
</html>
