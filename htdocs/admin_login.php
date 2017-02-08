<html lang="en">

<?php
include 'header.html';
?>

<body>

	<!-- Main Container Starts -->
		<div id="main-container">
		<!-- Main Heading Starts -->
			<h2 class="main-heading text-center">
				Admin Login
			</h2>
		<!-- Main Heading Ends -->
		<!-- Login Form Section Starts -->
			<section class="login-area">
				<div class="row">
					<div class="col-md-offset-2 col-sm-8 text-center">
					<!-- Login Panel Starts -->
						<div class="panel panel-smart">
							<div class="panel-heading">
								<h3 class="panel-title">Login</h3>
							</div>
							<div class="panel-body">
								<p>
									Please login using your admin account
								</p>
							<!-- Login Form Starts -->
								<form class="form-inline" role="form" method="POST" action="admin_check.php">
									<div class="form-group">
										<label class="sr-only" for="admin">Admin</label>
										<input type="text" class="form-control" name="admin" id="admin" placeholder="Admin">
									</div>
									<div class="form-group">
										<label class="sr-only" for="password">Password</label>
										<input type="password" class="form-control" name="password" id="password" placeholder="Password">
									</div>
									<button type="submit" class="btn btn-danger">
										Login
									</button>
								</form>
							<!-- Login Form Ends -->
							</div>
						</div>
					<!-- Login Panel Ends -->
					</div>
					
				</div>
			</section>
		<!-- Login Form Section Ends -->
		</div>
	<!-- Main Container Ends -->


</body>


<?php
include 'footer.html';
?>

</html>