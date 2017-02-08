<?php 
session_start();

unset($_SESSION["userName"]);
echo "<script>window.alert('Log out successfully')
                        window.location.href='index.php';</script>";

?>