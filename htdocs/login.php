<?
    session_start();
?>

<?php
     $servername = "localhost";
$username = "root";
$password ="root";
$dbname = "final";   
    
    $exampleInputEmail2 = $_POST["exampleInputEmail2"];
    $exampleInputPassword2 =$_POST["exampleInputPassword2"];


    if($exampleInputEmail2 != null && $exampleInputPassword2 != null &&preg_match("/^[a-zA-Z0-9]*$/",$exampleInputEmail2)&&strlen($exampleInputPassword2) > 7
        && preg_match('/(?=(?:.*?\d){1})(?=.*[a-z])(?=(?:.*?[A-Z]){1})(?!.*\s)[0-9a-zA-Z!@#$%*()_+^&]*$/',$exampleInputPassword2) ){
        $con = mysqli_connect("localhost",$username,$password,$dbname);
        if (!$con){
             die('Could not connect: ' . mysql_error());
        }
        $md5_pass = md5($exampleInputPassword2);
        $result = mysqli_query($con,"SELECT * FROM customer WHERE Cusername = '$exampleInputEmail2' AND Cpassword = '$md5_pass'");
        $query_data = mysqli_fetch_array($result);
        if(!empty($query_data[0])){  
            $_SESSION['userName']=$_POST['exampleInputEmail2'];
            //$_SESSION['exampleInputEmail2']=$_POST['exampleInputEmail2'];
            //$_SESSION['exampleInputPassword2']=$_POST['exampleInputPassword2'];


            //echo '<script>window.location = "/grocery-shoppe/index.html"</script>';
            //echo "<meta http-equiv=\"refresh\" CONTENT=\"1.5;url=index.html\">";

            echo "<script>window.alert('login successfully')
                        window.location.href='index.php';</script>";



            } else
            {
               // echo "<meta http-equiv=\"refresh\" CONTENT=\"1.5;url=login.html\">";
                echo "<script>window.alert('username and password do not match')
                        window.location.href='login.html';</script>";
            }
        mysqli_close($con);
    }
	else{      
        echo "<script>window.alert('username and password do not match')
                        window.location.href='login.html';</script>";
        //echo '<script>window.location = "/grocery-shoppe/login.html"</script>';
        //echo "<meta http-equiv=\"refresh\" CONTENT=\"1.5;url=login.html\">";
	}

    
?>

