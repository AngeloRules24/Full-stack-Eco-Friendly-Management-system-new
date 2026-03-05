<?php
$localhost = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'econestdb'; // Changed to lowercase to match

$dbConn = mysqli_connect($localhost, $user, $pass, $dbName);

if(mysqli_connect_errno()){
    die("Connection failed: " . mysqli_connect_error());
}
?>