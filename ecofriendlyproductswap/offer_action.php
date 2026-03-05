<?php
session_start();
include("../conn.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../signinsignup/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $offer_id = intval($_POST['offer_id']);
    $action = $_POST['action'];
    
    // Get offer details
    $sql = "SELECT so.*, ps.product1_name, ps.user_id as product_owner_id, ps.status as product_status
            FROM swap_offers so 
            JOIN productswap ps ON so.product_id = ps.product_ID 
            WHERE so.offer_id = $offer_id";
    $result = mysqli_query($dbConn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $offer = mysqli_fetch_assoc($result);
        
        // Verify that current user is the product owner
        if ($_SESSION['user_id'] != $offer['product_owner_id']) {
            header("Location: manage_offers.php?error=unauthorized");
            exit();
        }
        
        if ($action === 'accept') {
            // Add to myswap (completed trade)
            $insert_sql = "INSERT INTO myswap (product_id, from_user_id, to_user_id, traded_product, received_product, trade_date) 
                          VALUES ('{$offer['product_id']}', '{$offer['from_user_id']}', '{$offer['to_user_id']}', 
                                  '{$offer['offered_product']}', '{$offer['product1_name']}', NOW())";
            
            if (mysqli_query($dbConn, $insert_sql)) {
                // Update product status to completed in productswap table
                $update_status = "UPDATE productswap SET status = 'completed' WHERE product_ID = {$offer['product_id']}";
                
                if (mysqli_query($dbConn, $update_status)) {
                    // Reject all other offers for this product in swap_offers table
                    mysqli_query($dbConn, "UPDATE swap_offers SET offer_status = 'rejected' WHERE product_id = {$offer['product_id']} AND offer_id != $offer_id");
                    
                    // Accept this offer in swap_offers table
                    mysqli_query($dbConn, "UPDATE swap_offers SET offer_status = 'accepted' WHERE offer_id = $offer_id");
                    
                    header("Location: manage_offers.php?success=accepted");
                    exit();
                } else {
                    header("Location: manage_offers.php?error=status_update_failed");
                    exit();
                }
            } else {
                header("Location: manage_offers.php?error=insert_failed");
                exit();
            }
        } else {
            // Reject offer - only update swap_offers table, don't change productswap status
            mysqli_query($dbConn, "UPDATE swap_offers SET offer_status = 'rejected' WHERE offer_id = $offer_id");
            header("Location: manage_offers.php?success=rejected");
            exit();
        }
    } else {
        header("Location: manage_offers.php?error=offer_not_found");
        exit();
    }
} else {
    header("Location: manage_offers.php");
    exit();
}
?>