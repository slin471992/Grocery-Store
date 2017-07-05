<?php
$itemid = $_REQUEST["itemid"];



try {
    include("admin_config.php");
       
    if($conn->exec("DELETE FROM Grocery WHERE GID=$itemid")){
		echo "<script>window.alert('delete successfully')
						window.location.href='admin_page.php';</script>";	 
		
	}
	header("Refresh:0.5;url=admin_page.php");
	exit();
	

}

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


?>
	