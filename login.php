<?php
session_start();
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Collect form data
	$username = $_POST["username"];
	$password = $_POST["password"];

	// Retrieve hashed password from the database based on the username
	$sql = "SELECT user_id, username, password FROM Users WHERE username = '$username'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if (password_verify($password, $row["password"])) {
			// Password is correct
			$_SESSION["user_id"] = $row["user_id"];
			$_SESSION["username"] = $row["username"];

			// Redirect to the user's dashboard or another secure page
			header("Location: dashboard.php");
			exit();
		} else {
			// Incorrect username or password
			$error = "Invalid username or password";
		}
	} else {
		// Incorrect username or password
		$error = "Invalid username or password";
	}

	$result->close();
}

$conn->close();
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>User Login</title>
</head>

<body>
	<h2 class="text-center display-4">User Login</h2>

	<div class="container ">
		<?php if (isset($error)) echo "<p>$error</p>"; ?>
		<form class="w-75" style="margin: 0 auto;" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputUsername">Username</label>
						<input type="text" name="username" class="form-control" id="exampleInputUsername" placeholder="Enter Username">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					</div>
				</div>
				<button type="submit" class="btn btn-primary ml-3">Login</button>

			</div>
			<div class="mt-3">
				Create an Account? <a href="register.php">Register</a>
			</div>



		</form>
	</div>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>