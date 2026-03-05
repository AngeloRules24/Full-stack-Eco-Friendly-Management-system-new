<?php
session_start();
include("../conn.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../signinsignup/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_category = mysqli_real_escape_string($dbConn, $_POST['category']);
    $product1_name = mysqli_real_escape_string($dbConn, $_POST['product1']);
    $product_description = mysqli_real_escape_string($dbConn, $_POST['description']);
    $product2_name = mysqli_real_escape_string($dbConn, $_POST['product2'] ?? ''); // Handle optional field
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO productswap (product_category, product1_name, product_description, product2_name, user_id) 
            VALUES('$product_category', '$product1_name', '$product_description', '$product2_name', '$user_id')";

    if (mysqli_query($dbConn, $sql)){
        echo "<script>
            alert('✅ Product listed successfully for swapping!');
            window.location.href = 'view.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Failed to list product: " . mysqli_error($dbConn) . "');
            window.history.back();
        </script>";
    }
} else {
    header("Location: product-swap.php");
    exit();
}
?>