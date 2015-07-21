<?php
	session_start();
	include ('functions.php');
	// pr($_SESSION);
	if (empty($_SESSION['user'])) {
		header("location: login.php");
	}

	// pr($_SESSION['user']);
	$user = $_SESSION['user'];
	// echo $user['username'];
		
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bienvenue</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		
	<header><p><?php echo $user['username']?>
		<a href="logout.php" class="btn btn-primary btn-xs">Log out</a></p>
	</header>
	<h1>Bienvenue <?php echo $user['username']?>!</h1>
	
	</div>
</body>
</html>