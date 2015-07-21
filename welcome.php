<?php
	session_start();
	include ('functions.php');
	// pr($_SESSION);
	if (empty($_SESSION['user'])) {
		header("location: login.php");
		die();
	}

	// pr($_SESSION['user']);
	// $user = $_SESSION['user'];
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
		
	<header><p><?php echo $_SESSION['user']['username']?></p>
		<a href="logout.php" class="btn btn-danger btn-xs">Log out</a>
	</header>
	<h1>Bienvenue <?php echo $_SESSION['user']['username']?>!</h1>
	
	</div>
</body>
</html>