<?php
session_start();
include("../conn.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../signinsignup/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $from_user_id = $_SESSION['user_id'];
    $offered_product = mysqli_real_escape_string($dbConn, $_POST['offer_product']);
    $offer_description = mysqli_real_escape_string($dbConn, $_POST['offer_description']);
    
    // Get the product owner's user_id
    $sql = "SELECT user_id FROM productswap WHERE product_ID = $product_id AND status = 'available'";
    $result = mysqli_query($dbConn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $to_user_id = $row['user_id'];
        
        // Insert the swap offer
        $insert_sql = "INSERT INTO swap_offers (product_id, from_user_id, to_user_id, offered_product, offer_description) 
                      VALUES ('$product_id', '$from_user_id', '$to_user_id', '$offered_product', '$offer_description')";
        
        if (mysqli_query($dbConn, $insert_sql)) {
            echo "<script>
                alert('✅ Swap offer sent successfully!');
                window.location.href = 'view.php';
            </script>";
        } else {
            echo "<script>
                alert('❌ Failed to send swap offer: " . mysqli_error($dbConn) . "');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('❌ Product not found!');
            window.location.href = 'view.php';
        </script>";
    }
} else {
    header("Location: view.php");
    exit();
}
?>