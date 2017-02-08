<?php
$admin = $_COOKIE["admin"];
$password = $_COOKIE["password"];

//session_start(); //Start the current session
//session_unset();
//session_destroy(); //Destroy it! So we are logged out now
setcookie ("admin", $admin, time() - 3600, "/");
setcookie ("password", $password, time() - 3600, "/");
header("location:admin_login.php"); // Move back to admin_login.php 
?>