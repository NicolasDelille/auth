<?php
session_start();
	include('config.php');
	include('db.php');
	include ('functions.php');

	if (!empty($_POST)) {
		// pr($_POST);

		$email = $_POST['email'];

		$sql = "SELECT email
				FROM users
				WHERE email = :email";

		$sth = $dbh->prepare($sql);
		$sth->bindValue(':email',$email);
		$sth->execute();
		
		$matchUser = $sth->fetchColumn();
		pr($matchUser);

		if (!empty($matchUser)) {
			header("location: send_email_handler.php");
			$_SESSION['email'] = $matchUser;
			die();

		}
		else{
			$_SESSION['login_error'] = "Votre email n'existe pas";
			header("location: login.php");
			die();
		}
	}

	// else{
	// 	header("Location: login.php");
	// 	die();
	// }
	

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Forgot Password</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		
	<form action="forgot_password.php" method="post">
			<fieldset>
				<legend>Mot de passe oublié ? Veuillez indiquer votre adresse email</legend>

				<div class="form-group">
					<label for="email" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input class="form-control" id="email" name="email" placeholder="Email" type="text">
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="submit" class="btn btn-primary">Valider</button>
					</div>
				</div>
			</fieldset>
	</form>

	
	</div>
</body>
</html>