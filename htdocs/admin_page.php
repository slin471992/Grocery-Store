
<?php
/*	session_start();
	if(!session_is_registered("admin")){ //If session not registered
		header("location:admin_login.php"); // Redirect to admin_login.php page
	}
*/	
	include "header.html";
 	
?>
<html lang="en">
<style>
	input[type="number"] {
   			width:140px;
	}
</style>
<body>
<!--wrapper ends-->
<div id="wrapper" class="container">


<?php
$admin = $_COOKIE["admin"];
$password = $_COOKIE["password"];
$flag = false;
try {
    include("admin_config.php");
	$rows = $conn->query("SELECT * from AdminUser");
	 foreach($rows as $row){
          if($row[0]==$admin){			  
			  if($row[1]==$password)$flag=true; 
		  }
		 }
	  	  if(!$flag){?><script>alert("Plese login to continue");window.location.href="admin_login.php";</script>
	<?php
	     die(0);
	  
	  }

    $rows = $conn->query("SELECT g.GID, g.GName, g.Description, g.Price, g.Stock, c.CatName
    						FROM Grocery g 
    						LEFT JOIN GroceryCat gc ON gc.GID = g.GID
    						LEFT JOIN Category c ON c.CatID = gc.CatID");
	?>
<!--Main container-->
<div id="main-container">

<ol class="breadcrumb">
	<li><a href="admin_logout.php">Logout</a></li>
</ol>


<!--content start-->
<div class="content-box">

	
<!--item list-->
<h2 class="main-heading2">Item List</h2>
<div class="row">	
	<table class="table">
           <thead>
            <tr>
			<th>GID</th>
            <th>GName</th>
			<th>Description</th>
			<th>Price</th>
			<th>Stock</th>
			<th>Category</th>
			<th>Operation</th>
            </tr>
            </thead>
			<tbody>
	<?php
    foreach($rows as $row){
		?><tr><?php
		?><td><?php echo $row[0];?></td><?php 
		?><td><?php echo $row[1];?></td><?php 
		?><td><?php echo $row[2];?></td><?php
		?><td><?php echo $row[3];?></td><?php
		?><td><?php echo $row[4];?></td><?php
		?><td><?php echo $row[5];?></td><?php
		?><td><a href="admin_delete.php?itemid=<?php echo $row[0];?>" style="cursor: pointer;" onclick="return confirm('Delete?')">Delete</a></td><?php
		?></tr><?php
	}
	?>  
		 </tr>
        </tbody>
        </table> 
	<?php
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>
</div>

<!--item list end-->

<br><br>

<!--update-->
<h2 class="main-heading2">Update Item</h2>	
<div class="form-group">
  <br>
  <form class="form-inline" role="form" action="admin_update.php" method="post">
  
  		<table>
  		<tr>
  			<td>GID</td>
  			<td>GName</td>
  			<td>Description</td>
  			<td>Price</td>
  			<td>Stock</td>
  			<td>Category</td>
  		</tr>
  			<td><input name="u_GID" id="u_GID" type = "number"></td>
  			<td><input name="u_GName" id="u_GName" type = "text" size="12"></td>
  			<td><input name="u_des" id="u_des" type = "text" size="24"></td>
  			<td><input name="u_price" id="u_price" type = "number" step = "0.01" min = "0"></td>
  			<td><input name="u_stock" id="u_stock" type = "number"></td>
  			<td align="center">
  				<select name="u_cat" id="u_cat">
  					<option value=""></option>
  					<option value="1">Vegetable</option>
  					<option value="2">Fruit</option>
  					<option value="3">Diary</option>
  					<option value="4">Meats</option>
  					<option value="5">Snacks</option>
  					<option value="6">Beverage</option>
  				</select>	
  			</td>
  		<tr>
  			<td><button type = "submit">Submit</button></td>
  		</tr>
  		
  		
  		</table>
  	</form>
</div>  
<!--update end-->
	<br><br>
<!--add item-->	
	<h2 class="main-heading2">Add Item</h2>	
<div class="form-group">
  <br>
  <form class="form-inline" role="form" action="admin_add.php" method="post">
   <table>
  		<tr>
  			<td>GID</td>
  			<td>GName</td>
  			<td>Description</td>
  			<td>Price</td>
  			<td>Stock</td>
  			<td>Category</td>
  		</tr>
  			<td><input name="a_GID" id="a_GID" type = "number"></td>
  			<td><input name="a_GName" id="a_GName" type = "text" size="12"></td>
  			<td><input name="a_des" id="a_des" type = "text" size="24"></td>
  			<td><input name="a_price" id="a_price" type = "number" step = "0.01" min = "0"></td>
  			<td><input name="a_stock" id="a_stock" type = "number"></td>
  			<td align="center">
  				<select name="a_cat" id="a_cat">
  					<option value=""></option>
  					<option value="1">Vegetable</option>
  					<option value="2">Fruit</option>
  					<option value="3">Diary</option>
  					<option value="4">Meats</option>
  					<option value="5">Snacks</option>
  					<option value="6">Beverage</option>
  				</select>	
  			</td>
  		<tr>
  			<td><button type = "submit">Submit</button></td>
  		</tr>
  		
  		
  		</table>
  </form>
</div>

<!--content ends-->
</div>

</div>
<!--Main container end-->

<?php 
	include "footer.html";

?>

</div>
<!--wrapper ends-->
</body>
</html>