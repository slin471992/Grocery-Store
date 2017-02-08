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

if(!empty($_GET["action"])) {
	//echo $_GET["action"];
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$gid = $_GET["code"];
			//echo "gid".$gid;
			$query = "SELECT * FROM FINAL.Grocery WHERE GID='$gid'";
			$result = mysqli_query($con, $query);
			while($row = $result->fetch_assoc()) {
				$resultset[] = $row;
			}		
			if(!empty($resultset)) {
				$productByCode = $resultset;
			}
			//echo $productByCode;
			//echo $productByCode[0]["GName"];
			// $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");

			$itemArray = array($productByCode[0]["GID"]=>array('name'=>$productByCode[0]["GName"], 'code'=>$productByCode[0]["GID"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["Price"]));
			//echo "<br>";
			//print_r($itemArray);
			//echo "<br>";
			if(!empty($_SESSION["cart_item"])) {
				//echo "<br>";
				//echo $productByCode[0]["GID"];
				//echo "<br>";
				//if(in_array($productByCode[0]["GID"],$_SESSION["cart_item"])) {
				// if(in_array($productByCode[0]["GID"], $_SESSION["cart_item"])) {
				// 	echo "true";
				// 	echo "<br>";
				$updated = false;
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["GID"] == $k) {
								//echo "true";
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
								$updated = true;

							}
					}
				//} 
				// else {
				if ($updated == false) {
					//echo "else";
					//echo "<br>";
					// $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					$_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
					// print_r($_SESSION["cart_item"]);
					// foreach ($_SESSION["cart_item"] as $item){
					// 	echo $item["name"];
					// }
				}
				//print_r($_SESSION["cart_item"]);
					foreach ($_SESSION["cart_item"] as $item){
						//echo $item["name"];
					}
			} 
			else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}


// while($statement->fetch()){
        
//         //fetch product name, price from db and add to new_product array
//         $new_product["product_name"] = $product_name; 
//         $new_product["product_price"] = $price;
        
//         if(isset($_SESSION["cart_products"])){  //if session var already exist
//             if(isset($_SESSION["cart_products"][$new_product['product_code']])) //check item exist in products array
//             {
//                 unset($_SESSION["cart_products"][$new_product['product_code']]); //unset old array item
//             }           
//         }
//         $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item  
//     } 
// }
echo '
<div id="cart" class="table-responsive shopping-cart-table">
	<table class="table table-bordered">
		<thead>
			<tr>
				<td class="text-center">Name</td>							
				<td class="text-center">Quantity</td>
				<td class="text-center">Price</td>
				<td class="text-center">Total</td>
				<td class="text-center">Action</td>
			</tr>
		</thead>
		<tbody>';
foreach ($_SESSION["cart_item"] as $item){
		echo '
				<tr>
				<td><strong>'.$item["name"].'</strong></td>
				<td>
					<form method="post" action="cart.php?action=add&code='.$item["code"].'">
						<div class="input-group">
							<input type="text" name="quantity" value="'.$item["quantity"].'" size="1" class="form-control" />
							<span class="input-group-btn">
								<button type="submit" title="Update" class="btn btn-default tool-tip">
									<i class="fa fa-refresh"></i>
								</button>
							</span>
						</div>
					</form>
				</td>
				<td>'.$item["price"].'</td>
				<td align=right>$'.$item["price"]*$item["quantity"].'</td>
				<td><a href="cart.php?action=remove&code='.$item["code"].'" class="btnRemoveAction">Remove Item</a></td>
				</tr>
		';		
        $item_total += ($item["price"]*$item["quantity"]);
		}
// echo $item_total;
echo '
</tbody>
<tfoot>
	<tr>
		<td colspan="4" class="text-right"><strong>Total :</strong></td>
		<td colspan="2" class="text-left">$'.$item_total.'</strong></td>
	</tr>
</tfoot>
</table>
</div>';

echo '
<div class="row">
	<div class="text-uppercase clearfix">
		<a href="checkout.php?total='.$item_total.'" class="btn btn-default col-md-3 pull-right">
			<span class="hidden-xs">Checkout</span>
		</a>
		<a href="grocery_list.html" class="btn btn-default col-md-3 pull-right">		
			Continue Shopping
		</a>	
	</div>
</div>';

include_once "footer.html";
?>














