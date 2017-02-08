<?php 
session_start();

// Connect to database
$con=mysqli_connect("localhost","root","root","final"); 

// Check connection
if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
} 


$filter="";

// pagination
if(isset($_GET["page"])){ //Get page number from $_GET["page"]
    $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
    if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number	
}
else{
    $page_number = 1; //if there's no page number, set it to 1
}

// get filter (search) information from $_GET["filter"]
if (isset($_GET["filter"])){   
	$filter = $_GET["filter"];
}
else {
	// if no filter information set it to category/search, search priority > category priority
    if (isset($_GET["q"])) {
		$filter = $_GET["q"];
		// echo "filter".$filter;
	}

	if (isset($_GET["search"])){
		$filter = $_GET["search"];
		// echo "filter".$filter;
	}
}
// echo "filter".$filter;

// echo "page number".$page_number;


$query = "SELECT * FROM FINAL.Grocery
		ORDER BY GID DESC";


// if need to filter/search
if ($filter != "") {
	//$category = $_GET["q"];
	$category = $filter;
	if($category != "all" && $category != "default") {
		//echo "in category: ".$category."! ";
		if ($category == "Diary" || $category == "Beverage" || $category == "Meats" ||
			$category == "Fruit" || $category == "Vegetable" || $category == "Snacks") {

			//echo "no all";
			$query = "SELECT * FROM FINAL.Grocery
				JOIN FINAL.GroceryCat
					ON FINAL.Grocery.GID = FINAL.GroceryCat.GID
				JOIN FINAL.Category
					ON FINAL.GroceryCat.CatID = FINAL.Category.CatID
				WHERE FINAL.Category.CatName = '$category'
				ORDER BY FINAL.Grocery.GID DESC";
		}

		else {
			//echo "in search: ".$category;
			$query = "SELECT * FROM FINAL.Grocery
				WHERE GName LIKE '%$category%' 
					ORDER BY GID DESC";
			//echo $query;
		}
	}
}
//echo $query;


$item_per_page = 4;

$result = mysqli_query($con, $query);

// hold total records in variable
$total = mysqli_num_rows($result);
//echo "total rows".$total;

$total_pages = ceil($total/$item_per_page); //break records into pages
//echo "total pages".$total_pages;


################# Display Records per page ############################
$page_position = (($page_number-1) * $item_per_page); //get starting position to fetch the records
$query = "SELECT * FROM FINAL.Grocery
 		ORDER BY GID DESC LIMIT $page_position, $item_per_page ";

// -------------BELOW IS WORKING---------------------- 
// if ($search != "" && $search!="[object HTMLCollection]"){
// 	// $query = "SELECT GID, GName, Description, Price FROM FINAL.Grocery
// 	// 		WHERE GName LIKE '%$search%' 
// 	// 			ORDER BY GID DESC";
// 	$query = "SELECT * FROM FINAL.Grocery
// 			WHERE GName LIKE '%$search%' 
// 				ORDER BY GID DESC LIMIT $page_position, $item_per_page";
// }
// else if ($category != "all" && $category != "default") {
// 	if ($category == "Diary" || $category == "Beverage" || $category == "Meats" ||
// 			$category == "Fruit" || $category == "Vegetable" || $category == "Snacks") {

// 		// $query = "SELECT GID, GName, Description, Price FROM FINAL.Grocery
// 		// 	JOIN FINAL.GroceryCat
// 		// 		ON FINAL.Grocery.GID = FINAL.GroceryCat.GID
// 		// 	JOIN FINAL.Category
// 		// 		ON FINAL.GroceryCat.CatID = FINAL.Category.CatID
// 		// 	WHERE FINAL.Category.CatName = '$category'
// 		// 	ORDER BY FINAL.Grocery.GID DESC LIMIT $page_position, $item_per_page";
// 		$query = "SELECT * FROM FINAL.Grocery
// 			JOIN FINAL.GroceryCat
// 				ON FINAL.Grocery.GID = FINAL.GroceryCat.GID
// 			JOIN FINAL.Category
// 				ON FINAL.GroceryCat.CatID = FINAL.Category.CatID
// 			WHERE FINAL.Category.CatName = '$category'
// 			ORDER BY FINAL.Grocery.GID DESC LIMIT $page_position, $item_per_page";
// 	}

// 	// else {
// 	// 	$query = "SELECT GName, Description, Price FROM FINAL.Grocery
// 	// 		WHERE GName LIKE '%$category%' 
// 	// 			ORDER BY GID DESC LIMIT $page_position, $item_per_page";
// 	// }
// }
// -----------ABOVE IS WORKING------------------

// if need to filter/search
if ($filter != ""){
	$category = $filter;
	//$filter = $_GET["filter"];
	if ($category != "all" && $category != "default") {
		if ($category == "Diary" || $category == "Beverage" || $category == "Meats" ||
			$category == "Fruit" || $category == "Vegetable" || $category == "Snacks") {

			$query = "SELECT * FROM FINAL.Grocery
				JOIN FINAL.GroceryCat
					ON FINAL.Grocery.GID = FINAL.GroceryCat.GID
				JOIN FINAL.Category
					ON FINAL.GroceryCat.CatID = FINAL.Category.CatID
				WHERE FINAL.Category.CatName = '$category'
				ORDER BY FINAL.Grocery.GID DESC LIMIT $page_position, $item_per_page";
		}

		else {
			$query = "SELECT * FROM FINAL.Grocery
				WHERE GName LIKE '%$category%' 
					ORDER BY GID DESC LIMIT $page_position, $item_per_page";
		}
	}
}

$results = mysqli_query($con, $query);


//Display records fetched from database.
while($row = $results->fetch_assoc()) {
    	echo '	
					<div class="item col-md-3">
						<div class="product-col">
							<div class="caption">
								<h2>'.$row["GName"].'</h2>
								<div class="description"><h5>'.$row["Description"].

								'</h5></div>
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
					</div>
				';

}  

// We call the pagination function here. 
echo '<div class=col-md-12>';
//echo "<br>";
//echo "filter".$filter;
//echo "<br>";
echo paginate_function($item_per_page, $page_number, $total, $total_pages, $filter);
echo '</div>';
echo '
					</div>
				</div>
			</div>
		</div>';


// https://www.sanwebe.com/2011/05/php-pagination-function
################ pagination function #########################################
// function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url)
// {
//     echo "inside function";
//     $pagination = '';
//     if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
//         $pagination .= '<ul class="pagination">';
       
//         $right_links    = $current_page + 3;
//         $previous       = $current_page - 3; //previous link
//         $next           = $current_page + 1; //next link
//         $first_link     = true; //boolean var to decide our first link
       
//         if($current_page > 1){
//             $previous_link = $current_page - 1;
//             $pagination .= '<li class="first"><a href="'.$page_url.'?page=1" title="First">&laquo;</a></li>'; //first link
//             $pagination .= '<li><a href="'.$page_url.'?page='.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
//                 for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
//                     if($i > 0){
//                         $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
//                     }
//                 }  
//             $first_link = false; //set first link to false
//         }
       
//         if($first_link){ //if current active page is first link
//             $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
//         }elseif($current_page == $total_pages){ //if it's the last active link
//             $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
//         }else{ //regular current link
//             $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
//         }
               
//         for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
//             if($i<=$total_pages){
//                 $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
//             }
//         }
//         if($current_page < $total_pages){
//                 $next_link = $current_page + 1;
//                 $pagination .= '<li><a href="'.$page_url.'?page='.$next_link.'" >&gt;</a></li>'; //next link
//                 $pagination .= '<li class="last"><a href="'.$page_url.'?page='.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
//         }
       
//         $pagination .= '</ul>';
//     }
//     return $pagination; //return pagination links
// }
//https://www.sanwebe.com/2013/03/ajax-pagination-with-jquery-php
// function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
// {
//     //echo "inside function";
//     $pagination = '';
//     if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
//         $pagination .= '<ul class="pagination">';
       
//         $right_links    = $current_page + 3;
//         $previous       = $current_page - 3; //previous link
//         $next           = $current_page + 1; //next link
//         $first_link     = true; //boolean var to decide our first link
       
//         if($current_page > 1){
//             $previous_link = $current_page - 1;
//             $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
//             $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
//                 for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
//                     if($i > 0){
//                         $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
//                     }
//                 }  
//             $first_link = false; //set first link to false
//         }
       
//         if($first_link){ //if current active page is first link
//             $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
//         }elseif($current_page == $total_pages){ //if it's the last active link
//             $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
//         }else{ //regular current link
//             $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
//         }
               
//         for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
//             if($i<=$total_pages){
//                 $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
//             }
//         }
//         if($current_page < $total_pages){
//                 $next_link = $current_page + 1;
//                 $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
//                 $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
//         }
       
//         $pagination .= '</ul>';
//     }
//     return $pagination; //return pagination links
// }

function paginate_function($item_per_page, $current_page, $total_records, $total_pages, $filter)
{
    //echo "inside function";
    //echo $filter;
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
       
        $right_links    = $current_page + 3;
        $previous       = $current_page - 3; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
       
        if($current_page > 1){
            $previous_link = $current_page - 1;
            $pagination .= '<li class="first"><a href="#" data-page="1" data-filter="'.$filter.'" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" data-filter="'.$filter.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" data-filter="'.$filter.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }  
            $first_link = false; //set first link to false
        }
       
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
        }else{ //regular current link
            $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
        }
               
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" data-filter="'.$filter.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){
                $next_link = $current_page + 1;
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" data-filter="'.$filter.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" data-filter="'.$filter.'" title="Last">&raquo;</a></li>'; //last link
        }
       
        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}

//include_once 'footer.html';

?>












