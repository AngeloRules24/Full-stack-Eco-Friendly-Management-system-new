<?php
session_start();

$_SESSION = array();

session_destroy();

setcookie('user_logged_in', '', time() - 3600, '/');
setcookie('user_id', '', time() - 3600, '/');
setcookie('user_firstname', '', time() - 3600, '/');

setcookie('user_lastname', '', time() - 3600, '/');
setcookie('user_email', '', time() - 3600, '/');

header("Location: index.php");
exit();
?>