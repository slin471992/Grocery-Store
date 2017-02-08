<?php

$host = 'localhost';
$user = 'root';
$pass = 'root';

$connection = mysqli_connect($host, $user, $pass,'final');



if(isset($_POST['user_name']))
{
 $name=$_POST['user_name'];

 $checkdata=" SELECT cusername FROM customer WHERE cusername='$name' ";

 $query=mysqli_query($connection,$checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo "User Name Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}


?>