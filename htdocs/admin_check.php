<?php
$myadmin = $_POST["admin"];
$mypassword = $_POST["password"];
$admin = htmlspecialchars($myadmin);
$password = htmlspecialchars($mypassword);
$flag = false;

try {
	include("admin_config.php");
    $rows = $conn->query("SELECT * FROM AdminUser");
    foreach($rows as $row){
		// Register $admin, $password and redirect to file "admin_page.php"
        if($row[0]==$admin){
        	if($row[1]==$password){
        		$flag = true;
        		//session_register("admin");
        		//session_register("password");
        		//$_SESSION['name']= $admin;
        		setcookie("admin",$admin,time()+3600,"/");
              	setcookie("password",$password,time()+3600,"/");
              	}
        	}
        }
        if(!$flag){
        	?><script>alert("login information invaild");window.location.href="admin_login.php";</script>
	  <?php
	     header("Refresh:0.5;url=admin_login.php");
	     die(0);
	  
	  }
		  else header("Refresh:0.5;url=admin_page.php");
		  
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }