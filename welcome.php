<?php
	session_start();
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