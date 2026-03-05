<?php
ob_start();
$base_path = '/rwdd/RWDD group assignment/'; 
include "../header.php";
include "../conn.php";

if (!isset($_SESSION['user_id'])) {
    header("Location:" . $base_path . "signinsignup/login.php");
    ob_end_flush();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Available Swaps</title>
    <style>
        :root {
            --primary: #4CAF50;
            --primary-light: #E8F5E9;
            --primary-dark: #388E3C;
            --secondary: #FF9800;
            --secondary-light: #FFE0B2;
            --text-dark: #333;
            --text-light: #666;
            --bg-light: #f9f9f9;
            --white: #fff;
            --shadow: 0 4px 12px rgba(0,0,0,0.1);
            --radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-light) 0%, #f5f5f5 100%);
            color: var(--text-dark);
            margin: 0;
            min-height: 100vh;
        }

        .cardContainer {
            background: white;
            padding: 1px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .welcome {
            padding: 20px;
            font-family: "Poppins", sans-serif;
        }
        
        .products {
            background-color: #2d5a27;
            color: white;
            height: 50px;
            font-weight: 500;
        }
        
        .products th {
            padding: 15px;
            text-align: left;
        }
        
        .view {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 20px auto;
        }
        
        button {
            background: #2d5a27;
            border-radius: 20px;
            border: 0px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            color: #fff;
            cursor: pointer;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        
        button:hover {
            background: #1e3f1a;
            transform: translateY(-1px);
        }
        
        table{
            border-collapse: collapse;
            width: 95%;
            margin: 20px 0;
        }
        
        table tr {
            border-bottom: 1px solid #eee;
        }
        
        table td {
            padding: 15px;
            text-align: left;
            color: #333;
        }
        
        h2 {
            color: #2d5a27;
            font-size: 24px;
            font-weight: 600;
            margin: 20px 0;
            justify-self: center;
        }
        
        .image-section {
            text-align: center;
            margin: 20px 0;
        }
        
        .image-section img {
            max-width: 400px;
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        
        .swap-navigation {
            text-align: center;
            margin: 30px 0;
        }
        
        .swap-nav-button {
            background: #2d5a27;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 20px;
            margin: 0 10px;
            display: inline-block;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .swap-nav-button:hover {
            background: #1e3f1a;
            transform: translateY(-2px);
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        
        .empty-state h3 {
            color: #2d5a27;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .image-section img {
                max-width: 300px;
            }
            
            table {
                width: 98%;
                font-size: 14px;
            }
            
            table td, table th {
                padding: 10px 8px;
            }
        }

        @media (max-width: 480px) {
            .image-section img {
                max-width: 250px;
            }
            
            .swap-nav-button {
                display: block;
                margin: 10px auto;
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="cardContainer">
        <h2>Eco-Friendly Product Swap</h2>
    </div>
    <div class="welcome">
        <center><h2>Available Swaps</h2></center>
        <div class="image-section">
            <img src="product swap.png" alt="Eco Swaps">
        </div>
    </div>
    
    <center>
        <table class="view">
            <tr class="products">
                <th>Product ID</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Desired Product</th>
                <th>Action</th>
            </tr>
            <?php
                include("../conn.php");
                $current_user_id = $_SESSION['user_id'] ?? 1;
                
                // Only show items NOT owned by current user
                $sql = "SELECT * FROM productswap WHERE user_id != $current_user_id AND status = 'available'";
                $result = mysqli_query($dbConn, $sql);

                if(mysqli_num_rows($result) <= 0){
                    echo '<tr><td colspan="6">';
                    echo '<div class="empty-state">';
                    echo '<h3>No Products Available for Swap</h3>';
                    echo '<p>No items available from other users. Check back later or add your own product to swap.</p>';
                    echo '</div>';
                    echo '</td></tr>';
                } else {
                    while($rows = mysqli_fetch_array($result)){
                        $is_own_item = ($rows['user_id'] == $current_user_id);
                        
                        echo "<tr" . ($is_own_item ? " class='own-item'" : "") . ">";
                        echo "<td>".$rows['product_ID']."</td>";
                        echo "<td>".$rows['product_category']."</td>";
                        echo "<td>".$rows['product1_name']."</td>";
                        echo "<td>".$rows['product_description']."</td>";
                        echo "<td>".$rows['product2_name']."</td>";
                        
                        if($is_own_item) {
                            echo "<td class='own-item-message'>Your Item</td>";
                        } else {
                            echo "<td><a href='offer.php?id=".$rows['product_ID']."'><button>Swap</button></a></td>";
                        }
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </center>

    <div class="swap-navigation">
        <a href="product-swap.php" class="swap-nav-button">Add New Swap</a>
        <a href="myview.php" class="swap-nav-button">View My Swaps</a>
    </div>
    
<?php include "../footer.php"?>
</body>
</html>