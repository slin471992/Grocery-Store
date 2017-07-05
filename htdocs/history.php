<?php 
session_start();

// Connect to database
$con=mysqli_connect("localhost","root","root","final"); 

// Check connection
if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
} 

include_once 'header.html';


// if customer is logged in
if (isset($_SESSION['userName'])) {
	$customer = $_SESSION['userName'];

	// $customer = "aaa";
	echo '<h1>Your Order History -- Username: '.$customer.'</h1>';


	// find all orders of customer
	$query = "SELECT * FROM FINAL.Orders WHERE Cusername = '$customer' ORDER BY FINAL.Orders.OrderID DESC";
	$result = mysqli_query($con, $query);

	while($row = $result->fetch_assoc()) {
		$orderid = $row["OrderID"];
		echo '
		<div class="panel panel-smart">
			<div class="panel-heading">
				<h3 class="panel-title">Order ID: '.$orderid.'. Date and Time: '.$row["Date_Time"].
	 			'. Total: $'.$row["OrderTotal"].'. Status: '.$row["OrderStatus"].'</h3>
			</div>
		</div>';

		echo '
		<div id="cart" class="table-responsive shopping-cart-table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td class="text-center">Item Name</td>							
						<td class="text-center">Quantity</td>
						<td class="text-center">Price</td>
						<td class="text-center">Total</td>
					</tr>
				</thead>
				<tbody>';
	

	// echo "OrderID: ".$orderid." Order Date and Time: ".$row["Date_Time"].
	//  	" Customer: ".$row["Cusername"]." Order Total: ".$row["OrderTotal"]." Status: ".$row["OrderStatus"];
	// echo "<br>";
	// echo "<br>";
	// // for each order, find all order items
	// $queryItems = "SELECT GName FROM FINAL.Grocery, 
	// 		JOIN FINAL.OrderItems 
	// 		ON FINAL.OrderItems.ItemID = FINAL.Grocery.GID 
	// 		WHERE FINAL.OrderItems.OrderID = '$orderid'";
		$queryItems = "SELECT FINAL.Grocery.GName as name, FINAL.OrderItems.UnitPrice as price, 
					FINAL.OrderItems.Quantity as quantity, FINAL.OrderItems.Total as total FROM FINAL.Grocery 
	 					JOIN FINAL.OrderItems 
	 						ON FINAL.OrderItems.ItemID = FINAL.Grocery.GID 
	 					WHERE FINAL.OrderItems.OrderID = '$orderid'";

		$resultItems = mysqli_query($con, $queryItems);
		while($rowitems = $resultItems->fetch_assoc()) {
			echo '
			<tr>
				<td><strong>'.$rowitems["name"].'</strong></td>
				<td>'.$rowitems["quantity"].'</td>
				<td>'.$rowitems["price"].'</td>
				<td align=right>$'.$rowitems["total"].'</td>
			</tr>';	
		// echo $rowitems["name"]." ".$rowitems["price"]." ".$rowitems["quantity"]." ".$rowitems["total"];
		// // echo $rowitems["GName"];
		// echo "<br>";
		}
		echo '
			</tbody>
			</table>
			</div>';

	}
}

// customer is not log in, redirect to login page
else {
	echo "<script>window.alert('Please login to view your order history.')
                        window.location.href='login.html';</script>";
}


include_once "footer.html";
?>