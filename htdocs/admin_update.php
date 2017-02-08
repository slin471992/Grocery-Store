<?php
	
$des = htmlspecialchars($_POST["u_des"]);
$gname = htmlspecialchars($_POST["u_GName"]);
$price = htmlspecialchars($_POST["u_price"]);
$itemid = htmlspecialchars($_POST["u_GID"]);
$stock = htmlspecialchars($_POST["u_stock"]);
$cat = htmlspecialchars($_POST["u_cat"]);
if($itemid!="" && $gname!="" && $price!="" && $stock!=""){
	try {

    	include("admin_config.php");
		if($conn->exec("UPDATE Grocery 
					SET GName = '$gname', Description = '$des',
						Price = '$price', Stock = '$stock' 
					WHERE GID=$itemid;
					UPDATE GroceryCat
					SET CatID = '$cat'
					WHERE GID=$itemid")){
			
	  		echo "<script>window.alert('update successfully')
						window.location.href='admin_page.php';</script>";	  
     	}
		else {
	
			echo "<script>window.alert('No record changes. Please enter a valid GID.')
						window.location.href='admin_page.php';</script>";
		}
		header("Refresh:0.5;url=admin_page.php");
	}
	
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	
}

else{
  echo "<script>window.alert('All fields are mandatory')
						window.location.href='admin_page.php';</script>";
  header("Refresh:0.5;url=admin_page.php");
  die(0);		
}
?>