<?php
// This config file contain basic database connection settings

	$conn = new PDO('mysql:host=localhost;dbname=FINAL','root','root');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>