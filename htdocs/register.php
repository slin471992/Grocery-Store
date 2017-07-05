<?
    session_start();
?>

<?php
    
    $servername = "localhost";
    $username = "root";
    $password ="root";
    $dbname = "final";   
    
    $userName =$_POST["userName"];
    $inputPassword =$_POST["inputPassword"];
    
    if( $userName != null 
        &&$inputPassword != null 

        &&preg_match("/^[a-zA-Z0-9]*$/",$userName)
        &&strlen($inputPassword) > 7 && preg_match('/(?=(?:.*?\d){1})(?=.*[a-z])(?=(?:.*?[A-Z]){1})(?!.*\s)[0-9a-zA-Z!@#$%*()_+^&]*$/', $inputPassword) 

        ) {
       
        try 
        {
    
            $conn = new PDO("mysql:host=$servername;dbname=final", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customer 
            VALUES ('".$userName."', '".md5($inputPassword)."')";
            // use exec() because no results are returned
            $conn->exec($sql);
    
        }
    
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }


        $conn = null;
        $_SESSION['userName']=$_POST['userName'];

       
        echo "<script>window.alert('register successfully')
            window.location.href='index.php';</script>";

	   }
	else {      
        
        echo "<script>window.alert('failed to register')
                        window.location.href='register.html';</script>";


    }

    
?>

