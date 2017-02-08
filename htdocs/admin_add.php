<?php
	
$des = htmlspecialchars($_POST["a_des"]);
$gname = htmlspecialchars($_POST["a_GName"]);
$price = htmlspecialchars($_POST["a_price"]);
$itemid = htmlspecialchars($_POST["a_GID"]);
$stock = htmlspecialchars($_POST["a_stock"]);
$cat = htmlspecialchars($_POST["a_cat"]);
if($itemid!="" && $gname!="" && $price!="" && $stock!=""){
	try {
    	include("admin_config.php");
		if($conn->exec("INSERT INTO Grocery (GID, GName, Description, Price, Stock)
						VALUES ('$itemid', '$gname', '$des', '$price', '$stock');
						INSERT INTO GroceryCat (GID, CatID)
						VALUES ('$itemid', '$cat')
						") ){
	  	echo "<script>window.alert('Insert successfully')
						window.location.href='admin_page.php';</script>";	  
     	}
		else {
	
			echo "<script>window.alert('No record changed')
						window.location.href='admin_page.php';</script>";
		}
		header("Refresh:0.5;url=admin_page.php");
	}
	
catch(PDOException $e)
    {
    //echo "Connection failed: " . $e->getMessage();
    echo "<script>window.alert('Cannot have duplicate GID, please enter a new GID.')
						window.location.href='admin_page.php';</script>";
    }
	
}

else{
  echo "<script>window.alert('All fields are mandatory')
						window.location.href='admin_page.php';</script>";
  header("Refresh:0.5;url=admin_page.php");
  die(0);		
}
?>