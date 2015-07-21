<?php
	session_start();
	if (empty($_SESSION)) {
		header("location: login.php");
	}
	include ('functions.php');

	// pr($_SESSION['user']);
	$user = $_SESSION['user'];
	// echo $user['username'];
		
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bienvenue</title>
</head>
<body>
	<h1>Bienvenue <?php echo $user['username']?>!</h1>
</body>
</html>