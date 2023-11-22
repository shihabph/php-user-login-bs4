<?php
require_once('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Collect form data
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	$fullname = $_POST["full_name"];

	// Hash the password
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	// Insert user into the database
	$sql = "INSERT INTO Users (username, password, email, full_name) VALUES ('$username', '$hashedPassword', '$email', '$fullname')";
	if ($conn->query($sql) === TRUE) {
		// Redirect to login page after registration
		header("Location: login.php");
		exit();
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
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

	<title>Register</title>
</head>

<body>
	<h2 class="text-center display-4">User Registration</h2>

	<div class="container w-75">
		<form style="margin: 0 auto;" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
				<label for="exampleInputName">Full Name:</label>
				<input type="text" name="full_name" class="form-control" id="exampleInputName" placeholder="Enter Full Name">
			</div>
			<div class="form-group">
				<label for="exampleInputUsername">Username</label>
				<input type="text" name="username" class="form-control" id="exampleInputUsername" placeholder="Enter Username">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<div class="mt-3">
			Already Have an Account? <a href="login.php">Login</a>
		</div>
	</div>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>