<?php 
session_start();

// Connect to database
$con=mysqli_connect("localhost","root","root","final"); 

// Check connection
if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
} 

// fetch latest four grocery items
$query = "SELECT * FROM FINAL.Grocery
			ORDER BY GID DESC LIMIT 8";

$result = mysqli_query($con, $query);


// while ($row1m = mysqli_fetch_array($result1m, MYSQLI_ASSOC)) {
// 	echo "<tr>";
// 	echo "<td>".$row1m["name"]."</td>";
// 	echo "<td>".$row1m["ranking"]."</td>";
// 	echo "</tr>";
// }
include 'header_index.html';


// <!-- Wrapper Starts -->
echo '

		<div class="row">
			<div class="col-xs-12">
				<div id="owl-product" class="owl-carousel">';

// <div class="image">
								//<img src="images/product-images/1.jpg" alt="product" class="img-responsive" />
							//</div>
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	echo '
						
					<div class="item">
						<div class="product-col">
							
							<div class="caption">
								<h2>'.$row["GName"].'</h2>
								<div class="description"><h5>'.$row["Description"].'</h5></div>
								<div class="price">
									<span class="price-new">$'.$row["Price"].'</span> 
								</div>
								<form method="post" action="cart.php?action=add&code='.$row["GID"].'">
									<label class="control-label text-uppercase" for="input-quantity">Qty:</label>
									<input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
									<div class="cart-button button-group">
										<button id="cart_button" type="submit" class="btn btn-cart">
											<i class="fa fa-shopping-cart"></i>	
											Add to Cart		 
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>';
}

echo '			</div>
			</div>
		</div>
	';


include 'footer.html';

?>