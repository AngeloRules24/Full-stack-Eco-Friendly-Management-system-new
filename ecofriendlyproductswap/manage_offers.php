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

// Get all offers for current user's products
$user_id = $_SESSION['user_id'];
$offers_sql = "SELECT so.*, 
                      ps.product1_name, ps.product_description, ps.product_category,
                      u.user_name as offerer_username
               FROM swap_offers so 
               JOIN productswap ps ON so.product_id = ps.product_ID 
               JOIN user u ON so.from_user_id = u.user_id
               WHERE ps.user_id = $user_id 
               AND so.offer_status = 'pending'
               ORDER BY so.created_at DESC";

$offers_result = mysqli_query($dbConn, $offers_sql);

// Check if query failed and provide simpler alternative
if (!$offers_result) {
    // Simpler query without the complex joins
    $offers_sql = "SELECT so.*, 
                          ps.product1_name, ps.product_description, ps.product_category
                   FROM swap_offers so 
                   JOIN productswap ps ON so.product_id = ps.product_ID 
                   WHERE ps.user_id = $user_id 
                   AND so.offer_status = 'pending'
                   ORDER BY so.created_at DESC";
    
    $offers_result = mysqli_query($dbConn, $offers_sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Swap Offers</title>
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
            width: 95%;
            padding-left: 100px;
            padding-right: 100px;
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
        
        .accept-btn {
            background: #28a745;
        }
        
        .accept-btn:hover {
            background: #218838;
        }
        
        .reject-btn {
            background: #dc3545;
        }
        
        .reject-btn:hover {
            background: #c82333;
        }
        
        table{
            border-collapse: collapse;
            width: 100%;
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

        .offer-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 4px solid #2d5a27;
        }

        .offer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .offerer-info {
            background: #2d5a27;
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 14px;
        }

        .offer-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
        }

        .product-info {
            flex: 1;
            padding: 15px;
            background: var(--primary-light);
            border-radius: 8px;
            margin: 0 10px;
        }

        .swap-icon {
            font-size: 24px;
            color: #2d5a27;
            margin: 0 20px;
        }

        .offer-message {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 3px solid #2d5a27;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .action-buttons form {
            display: inline-block;
            margin: 0 10px;
        }

        .offer-date {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 10px;
        }

        .status-badge {
            background: #ffc107;
            color: #856404;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: 500;
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
            
            .offer-details {
                flex-direction: column;
            }
            
            .product-info {
                margin: 10px 0;
                width: 100%;
            }
            
            .swap-icon {
                margin: 10px 0;
                transform: rotate(90deg);
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
            
            .action-buttons form {
                display: block;
                margin: 10px 0;
            }
            
            .action-buttons button {
                width: 100%;
            }
        }

        .alert {
            padding: 15px;
            margin: 20px auto;
            border-radius: 8px;
            width: 95%;
            text-align: center;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="welcome">
        <center><h2>Manage Swap Offers</h2></center>
    </div>

    <!-- Success/Error Messages -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php if ($_GET['success'] === 'accepted'): ?>
                <strong>Success!</strong> Offer accepted successfully! The swap has been completed.
            <?php elseif ($_GET['success'] === 'rejected'): ?>
                <strong>Success!</strong> Offer rejected successfully.
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <strong>Error!</strong>
            <?php 
            switch($_GET['error']) {
                case 'unauthorized': echo "You are not authorized to manage this offer."; break;
                case 'insert_failed': echo "Failed to complete the swap. Please try again."; break;
                case 'offer_not_found': echo "Offer not found."; break;
                default: echo "An error occurred. Please try again.";
            }
            ?>
        </div>
    <?php endif; ?>

    <center>
        <div class="view">
            <?php if ($offers_result && mysqli_num_rows($offers_result) > 0): ?>
                <?php while($offer = mysqli_fetch_assoc($offers_result)): ?>
                    <div class="offer-card">
                        <!-- Offer Header -->
                        <div class="offer-header">
                            <span class="status-badge">Pending Offer</span>
                            <span class="offerer-info">
                                <i class="fas fa-user"></i> 
                                <?php echo isset($offer['offerer_username']) ? htmlspecialchars($offer['offerer_username']) : 'User #' . $offer['from_user_id']; ?>
                            </span>
                        </div>

                        <!-- Swap Details -->
                        <div class="offer-details">
                            <!-- Your Product -->
                            <div class="product-info">
                                <h4 style="color: #2d5a27; margin-bottom: 10px;">
                                    <i class="fas fa-gift"></i> Your Product
                                </h4>
                                <strong><?php echo htmlspecialchars($offer['product1_name']); ?></strong>
                                <p style="font-size: 14px; margin-top: 10px;">
                                    <?php echo htmlspecialchars($offer['product_description']); ?>
                                </p>
                            </div>

                            <!-- Swap Icon -->
                            <div class="swap-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>

                            <!-- Offered Product -->
                            <div class="product-info">
                                <h4 style="color: #2d5a27; margin-bottom: 10px;">
                                    <i class="fas fa-handshake"></i> Offered Product
                                </h4>
                                <strong><?php echo htmlspecialchars($offer['offered_product']); ?></strong>
                                <p style="font-size: 14px; margin-top: 10px;">
                                    <?php echo htmlspecialchars($offer['offer_description']); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Offer Message -->
                        <?php if (!empty($offer['offer_message'])): ?>
                            <div class="offer-message">
                                <strong><i class="fas fa-comment"></i> Additional Message:</strong>
                                <p style="margin: 5px 0 0 0;">"<?php echo htmlspecialchars($offer['offer_message']); ?>"</p>
                            </div>
                        <?php endif; ?>

                        <!-- Actions -->
                        <div class="action-buttons">
                            <form method="POST" action="offer_action.php">
                                <input type="hidden" name="offer_id" value="<?php echo $offer['offer_id']; ?>">
                                <input type="hidden" name="action" value="accept">
                                <button type="submit" class="accept-btn" 
                                        onclick="return confirm('Are you sure you want to accept this swap offer?')">
                                    <i class="fas fa-check"></i> Accept Offer
                                </button>
                            </form>
                            
                            <form method="POST" action="offer_action.php">
                                <input type="hidden" name="offer_id" value="<?php echo $offer['offer_id']; ?>">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="reject-btn"
                                        onclick="return confirm('Are you sure you want to reject this offer?')">
                                    <i class="fas fa-times"></i> Reject Offer
                                </button>
                            </form>
                        </div>

                        <!-- Offer Date -->
                        <div class="offer-date">
                            <i class="fas fa-calendar"></i>
                            Offered on: <?php echo date('M j, Y g:i A', strtotime($offer['created_at'])); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <h3>No Pending Offers</h3>
                    <p>You don't have any pending swap offers at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </center>

    <div class="swap-navigation">
        <a href="product-swap.php" class="swap-nav-button">Add New Swap</a>
        <a href="myview.php" class="swap-nav-button">View My Swaps</a>
        <a href="view.php" class="swap-nav-button">Browse All Swaps</a>
    </div>
    

</body>
</html>