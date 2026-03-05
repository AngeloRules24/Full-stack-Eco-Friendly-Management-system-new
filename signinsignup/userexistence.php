<?php
include "../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    if (empty($phone) || empty($password)) {
        header("Location: login.php?error=empty_fields&phone=" . urlencode($phone));
        exit;
    }
    
    if (!preg_match('/^01\d{8,9}$/', $phone)) {
        header("Location: login.php?error=invalid_phone&phone=" . urlencode($phone));
        exit;
    }
    
    $sql = "SELECT user_id, user_name, user_phone, user_password, user_firstname, user_lastname, user_email FROM user WHERE user_phone = ?";
    $stmt = mysqli_prepare($dbConn, $sql);
    
    if (!$stmt) {
        header("Location: login.php?error=server_error");
        exit;
    }
    
    mysqli_stmt_bind_param($stmt, "s", $phone);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) <= 0) {
        header("Location: login.php?error=account_not_exist&phone=" . urlencode($phone));
        exit;
    }
    
    $user = mysqli_fetch_assoc($result);
    
    if (password_needs_rehash($user['user_password'], PASSWORD_DEFAULT)) {
        if ($password === $user['user_password']) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $updateSql = "UPDATE user SET user_password = ? WHERE user_phone = ?";
            $updateStmt = mysqli_prepare($dbConn, $updateSql);
            mysqli_stmt_bind_param($updateStmt, "ss", $hashedPassword, $phone);
            mysqli_stmt_execute($updateStmt);
            
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_phone'] = $user['user_phone'];
            $_SESSION['user_firstname'] = $user['user_firstname'];
            $_SESSION['user_lastname'] = $user['user_lastname'];
            $_SESSION['user_email'] = $user['user_email'];
            
            setcookie('user_logged_in', 'true', time() + (30 * 24 * 60 * 60), '/');
            setcookie('user_id', $user['user_id'], time() + (30 * 24 * 60 * 60), '/');
            setcookie('user_firstname', $user['user_firstname'], time() + (30 * 24 * 60 * 60), '/');
            
            header("Location: ../index.php");
            exit();
        }
    }
    
    if (password_verify($password, $user['user_password'])) {
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_phone'] = $user['user_phone'];
        $_SESSION['user_firstname'] = $user['user_firstname']; 
        $_SESSION['user_lastname'] = $user['user_lastname'];
        $_SESSION['user_email'] = $user['user_email'];
    
        setcookie('user_logged_in', 'true', time() + (30 * 24 * 60 * 60), '/');
        setcookie('user_id', $user['user_id'], time() + (30 * 24 * 60 * 60), '/');
        setcookie('user_firstname', $user['user_firstname'], time() + (30 * 24 * 60 * 60), '/');
        
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: login.php?error=wrong_password&phone=" . urlencode($phone));
        exit;
    }
}
?>