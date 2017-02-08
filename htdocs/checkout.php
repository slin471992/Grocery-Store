<?php 
session_start();
//unset($_SESSION["cart_item"]);
// Connect to database
$con=mysqli_connect("localhost","root","root","final"); 

// Check connection
if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
} 

include_once 'header.html';

// if customer is log in
if (isset($_SESSION['userName'])) {
	$customer = $_SESSION['userName'];


	// if cart is not empty and total variable presents
	if(!empty($_GET["total"]) && !empty($_SESSION["cart_item"])){
		$order_total = $_GET["total"];
		$order_total = mysqli_real_escape_string($con, $order_total);
		//echo $order_total;
		//var_dump($order_total);


		// check if there are enough stock for each item before adding to database
		$can_add = TRUE;
		foreach ($_SESSION["cart_item"] as $item){
			$itemID = (int)$item["code"];
			$price = (double)$item["price"];
			$quantity = (int)$item["quantity"];
			$total = (double)$item["price"]*$item["quantity"];

			// retrive stock information of the item
			$query = "SELECT * FROM FINAL.Grocery WHERE FINAL.Grocery.GID = '$itemID'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_array($result);
			$stock = $row["Stock"];
			//echo "$stock";

			// there is not enough stock 
			if ( $stock - $quantity < 0) {
				$can_add = FALSE;
				// $failed_item = $itemID;
				// $failed_quantity = $quantity;

				// $query = "SELECT GName FROM FINAL.Grocery WHERE FINAL.Grocery.GID = '$failed_item'";
				// $result = mysqli_query($con, $query);
				// $row = mysqli_fetch_array($result);
				// $failed_item = $row["GName"];
				echo '<h1>Failed to place your order.</h1>
				  	<h2>Quantity '.$quantity.' exceeds stock value for Item '.$item["name"].'!<h2>';

				echo '<h1><a href="cart.php">Return to your Cart</a></h1>';
			
				break;
			}

		}

		// if can_add is true
		if ($can_add == TRUE){
			$status = "Processing";
			// get customer username
			//$customer = "aaa";

			$query = "INSERT INTO FINAL.Orders 
					(Date_Time, Cusername, OrderTotal, OrderStatus)
          			VALUES
          			(NOW(), '$customer', '$order_total', '$status')";

			if (mysqli_query($con, $query) == TRUE){
				//echo "success";
			}
			else{
				//echo "failed";
			}

			// retrive order id
			$query = "SELECT * from FINAL.Orders ORDER BY FINAL.Orders.OrderID DESC LIMIT 1";
			$result = mysqli_query($con, $query);

			$row = mysqli_fetch_array($result);
			$orderID = (int)$row["OrderID"];
			//echo $orderID;


			foreach ($_SESSION["cart_item"] as $item){
				$itemID = (int)$item["code"];
				$price = (double)$item["price"];
				$quantity = (int)$item["quantity"];
				$total = (double)$item["price"]*$item["quantity"];

				// retrive stock information of the item
				$query = "SELECT * FROM FINAL.Grocery WHERE FINAL.Grocery.GID = '$itemID'";
				$result = mysqli_query($con, $query);
				$row = mysqli_fetch_array($result);
				$stock = $row["Stock"];
				//echo $stock;

				$query = "INSERT INTO FINAL.OrderItems
						(OrderID, ItemID, UnitPrice, Quantity, Total)
						VALUES
						('$orderID', '$itemID', '$price', '$quantity', '$total')";
				$result = mysqli_query($con, $query);
				if ($result == TRUE){
					//echo "<br>";
					//echo "success";
				}
				else {
					//echo "<br>";
					//echo "success";
				}

				// update stock value in Grocery
				$new_stock = $stock - $quantity;
				$new_stock = (int)$new_stock;
				//var_dump($new_stock);
				//echo "new_stock: ".$new_stock;
				//echo "id: ".$itemID;
				$query = "UPDATE FINAL.Grocery SET FINAL.Grocery.Stock=".$new_stock."
							WHERE FINAL.Grocery.GID=".$itemID;

				$result = mysqli_query($con, $query) or die(mysqli_error($con));
				if ($result == TRUE){
					//echo "<br>";
					//echo "update successed";
				}
				else {
					//echo "<br>";
					//echo "update failed";
				}
			}
	
			// after add order to databse, show success message
			echo '<h1>Congratulation, your order is placed successfully!</h1>';

			echo '
			<div class="panel panel-smart">
				<div class="panel-heading">
					<h3 class="panel-title">Your Order Summary -- OrderID: '.$orderID.'</h3>
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

			foreach ($_SESSION["cart_item"] as $item) {
				$itemID = (int)$item["code"];
				$price = (double)$item["price"];
				$quantity = (int)$item["quantity"];
				$total = (double)$item["price"]*$item["quantity"];
	
				echo '
				<tr>
					<td><strong>'.$item["name"].'</strong></td>
					<td>'.$item["quantity"].'</td>
					<td>'.$item["price"].'</td>
					<td align=right>$'.$item["price"]*$item["quantity"].'</td>
				</tr>';		
			}	

			echo '
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" class="text-right"><strong>Total :</strong></td>
					<td colspan="2" class="text-left">$'.$order_total.'</strong></td>
				</tr>
			</tfoot>
			</table>
			</div>';

			// after checkout successfully competed, empty cart --> delete session variable
			unset($_SESSION["cart_item"]);
		}
	}

	else {
		echo '<h1>Your cart is empty!</h1>
		  	<h1><a href="grocery_list.html">Continue Shopping</a></h1>';
	}
}

// customer is not log in, redirect to login page
else {
	echo "<script>window.alert('Please login to checkout.')
                        window.location.href='login.html';</script>";
}

//$now = (new \DateTime())->format('Y-m-d H:i:s');
//echo $now;
include_once "footer.html";
?>






