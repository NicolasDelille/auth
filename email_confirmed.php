<?php
	session_start();
	if (!empty($_SESSION)) {
		$confirmMail = $_SESSION['flash'];
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Message envoyé !</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<p class="lead text-success"><?php echo $confirmMail?></p>
	</div>
</body>
</html>