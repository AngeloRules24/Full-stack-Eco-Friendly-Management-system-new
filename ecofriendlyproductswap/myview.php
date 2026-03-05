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
        
        .alert {
          padding: 15px;
          margin: 20px auto;
          border-radius: 5px;
          max-width: 600px;
          text-align: center;
        }
        
        .alert-success {
          background-color: #d4edda;
          color: #155724;
          border: 1px solid #c3e6cb;
        }
        
        .alert-warning {
          background-color: #fff3cd;
          color: #856404;
          border: 1px solid #ffeaa7;
        }

        .status-badge {
          padding: 4px 12px;
          border-radius: 12px;
          font-size: 12px;
          font-weight: 600;
          display: inline-block;
          margin-left: 8px;
        }
        
        .status-pending {
          background: #FFA000;
          color: white;
        }
        
        .status-accepted {
          background: #4CAF50;
          color: white;
        }
        
        .status-rejected {
          background: #f44336;
          color: white;
        }
    </style>
    <title>My Swaps</title>
</head>
<body>
    
    <!-- Success/Warning Messages -->
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php 
            if($_GET['success'] == 'accepted') {
                echo '✅ Swap offer accepted! Trade completed successfully.';
            } elseif($_GET['success'] == 'rejected') {
                echo '✅ Swap offer rejected.';
            }
            ?>
        </div>
    <?php endif; ?>
    
    <center>
        <h2>My Completed Swaps</h2>
        <table class="view">
            <tr class="products">
                <th>Traded Product</th>
                <th>Received Product</th>
                <th>Traded With</th>
                <th>Trade Date</th>
            </tr>
            <?php
                include("../conn.php");
                $current_user_id = $_SESSION['user_id'] ?? 1;
                
                // Show completed trades where user was involved (either as sender or receiver)
                $sql = "SELECT ms.*, 
                               u1.user_name as from_user_name,
                               u2.user_name as to_user_name
                        FROM myswap ms 
                        JOIN user u1 ON ms.from_user_id = u1.user_id 
                        JOIN user u2 ON ms.to_user_id = u2.user_id 
                        WHERE ms.from_user_id = $current_user_id OR ms.to_user_id = $current_user_id 
                        ORDER BY ms.trade_date DESC";
                $result = mysqli_query($dbConn, $sql);

                if(mysqli_num_rows($result) <= 0){
                    echo '<tr><td colspan="4">';
                    echo '<div class="empty-state">';
                    echo '<h3>No Completed Swaps Yet</h3>';
                    echo '<p>You haven\'t completed any swaps yet. Make some offers or check your pending offers!</p>';
                    echo '</div>';
                    echo '</td></tr>';
                } else {
                    while($rows = mysqli_fetch_array($result)){
                        $is_sender = ($rows['from_user_id'] == $current_user_id);
                        
                        echo "<tr>";
                        echo "<td>".$rows['traded_product']."</td>";
                        echo "<td>".$rows['received_product']."</td>";
                        
                        if($is_sender) {
                            echo "<td>".$rows['to_user_name']." <span class='status-badge status-accepted'>You initiated</span></td>";
                        } else {
                            echo "<td>".$rows['from_user_name']." <span class='status-badge status-accepted'>You received</span></td>";
                        }
                        
                        echo "<td>".date('M j, Y g:i A', strtotime($rows['trade_date']))."</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>

        <?php
        // Show user's pending swap offers - ONLY PENDING STATUS
        $offers_sql = "SELECT so.*, 
                              ps.product1_name as wanted_product,
                              u.user_name as to_user_name
                       FROM swap_offers so 
                       JOIN productswap ps ON so.product_id = ps.product_ID 
                       JOIN user u ON so.to_user_id = u.user_id 
                       WHERE so.from_user_id = $current_user_id 
                       AND so.offer_status = 'pending'
                       ORDER BY so.created_at DESC";
        $offers_result = mysqli_query($dbConn, $offers_sql);
        $has_pending_offers = mysqli_num_rows($offers_result) > 0;
        ?>

        <?php if($has_pending_offers): ?>
        <h2 style="margin-top: 40px;">My Pending Offers</h2>
        <table class="view">
            <tr class="products">
                <th>Product I Want</th>
                <th>My Offer</th>
                <th>Offer To</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            <?php
                while($offer = mysqli_fetch_array($offers_result)){
                    $status_class = 'status-' . $offer['offer_status'];
                    
                    echo "<tr>";
                    echo "<td>".$offer['wanted_product']."</td>";
                    echo "<td>".$offer['offered_product']."</td>";
                    echo "<td>".$offer['to_user_name']."</td>";
                    echo "<td><span class='status-badge $status_class'>".ucfirst($offer['offer_status'])."</span></td>";
                    echo "<td>".date('M j, Y g:i A', strtotime($offer['created_at']))."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <?php endif; ?>

        <?php
        // Show user's rejected swap offers - ONLY REJECTED STATUS
        $rejected_offers_sql = "SELECT so.*, 
                                       ps.product1_name as wanted_product,
                                       u.user_name as to_user_name
                                FROM swap_offers so 
                                JOIN productswap ps ON so.product_id = ps.product_ID 
                                JOIN user u ON so.to_user_id = u.user_id 
                                WHERE so.from_user_id = $current_user_id 
                                AND so.offer_status = 'rejected'
                                ORDER BY so.created_at DESC";
        $rejected_offers_result = mysqli_query($dbConn, $rejected_offers_sql);
        $has_rejected_offers = mysqli_num_rows($rejected_offers_result) > 0;
        ?>

        <?php if($has_rejected_offers): ?>
        <h2 style="margin-top: 40px;">My Rejected Offers</h2>
        <table class="view">
            <tr class="products">
                <th>Product I Wanted</th>
                <th>My Offer</th>
                <th>Offer To</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            <?php
                while($offer = mysqli_fetch_array($rejected_offers_result)){
                    $status_class = 'status-' . $offer['offer_status'];
                    
                    echo "<tr>";
                    echo "<td>".$offer['wanted_product']."</td>";
                    echo "<td>".$offer['offered_product']."</td>";
                    echo "<td>".$offer['to_user_name']."</td>";
                    echo "<td><span class='status-badge $status_class'>".ucfirst($offer['offer_status'])."</span></td>";
                    echo "<td>".date('M j, Y g:i A', strtotime($offer['created_at']))."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <?php endif; ?>
    </center>

    <div class="swap-navigation">
        <a href="product-swap.php" class="swap-nav-button">Add New Swap</a>
        <a href="view.php" class="swap-nav-button">Browse All Swaps</a>
        <a href="manage_offers.php" class="swap-nav-button">Manage Incoming Offers</a>
    </div>


</body>
</html>