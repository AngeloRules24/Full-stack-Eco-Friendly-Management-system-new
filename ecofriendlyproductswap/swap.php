<?php
session_start();
include("../conn.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../signinsignup/login.php");
    exit();
}

// This file should handle the swap action from manage_offers.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $offer_id = intval($_POST['offer_id']);
    $action = $_POST['action'];
    
    // Redirect to offer_action.php which handles both accept and reject
    header("Location: offer_action.php");
    exit();
} else {
    header("Location: view.php");
    exit();
}
?>