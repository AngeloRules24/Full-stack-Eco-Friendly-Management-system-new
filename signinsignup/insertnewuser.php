<?php
include "../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    $checkUsernameSql = "SELECT user_id FROM user WHERE user_name = ?";
    $checkUsernameStmt = mysqli_prepare($dbConn, $checkUsernameSql);
    mysqli_stmt_bind_param($checkUsernameStmt, "s", $username);
    mysqli_stmt_execute($checkUsernameStmt);
    $usernameResult = mysqli_stmt_get_result($checkUsernameStmt);
    
    if (mysqli_num_rows($usernameResult) > 0) {
        header("Location: register.php?error=username_taken&username=" . urlencode($username) . "&email=" . urlencode($email) . "&phone=" . urlencode($phone));
        exit;
    }
    
    $checkPhoneSql = "SELECT user_id FROM user WHERE user_phone = ?";
    $checkPhoneStmt = mysqli_prepare($dbConn, $checkPhoneSql);
    mysqli_stmt_bind_param($checkPhoneStmt, "s", $phone);
    mysqli_stmt_execute($checkPhoneStmt);
    $phoneResult = mysqli_stmt_get_result($checkPhoneStmt);
    
    if (mysqli_num_rows($phoneResult) > 0) {
        header("Location: register.php?error=account_exists&username=" . urlencode($username) . "&email=" . urlencode($email) . "&phone=" . urlencode($phone));
        exit;
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $insertSql = "INSERT INTO user (user_name, user_email, user_phone, user_password) VALUES (?, ?, ?, ?)";
    $insertStmt = mysqli_prepare($dbConn, $insertSql);
    mysqli_stmt_bind_param($insertStmt, "ssss", $username, $email, $phone, $hashedPassword);
    
    if (mysqli_stmt_execute($insertStmt)) {
        header("Location: successfulregistration.php");
        exit;
    } else {
        header("Location: register.php?error=server_error");
        exit;
    }
}
?>