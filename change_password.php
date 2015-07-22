<?php
	session_start();
	include("config.php");
	include("vendor/autoload.php");
	include("functions.php");
	include("db.php");

	$password_error = "";
	$passwordField_error = "";
	$passwordConfirm_error = "";
	$passwordConfirmField_error = "";

	if(!empty($_GET['i'])){

		// echo $_GET["i"];
		$token = $_GET["i"];

		$sql = "SELECT id, token, email, username, password, date_created, date_modified 
				FROM users 
				WHERE :token = token";

		$sth = $dbh->prepare($sql);
		$sth->bindValue(':token',$token);
		$sth->execute();

		$user = $sth->fetch();
		$_SESSION['user'] = $user;
	}

	// pr($user);

	// pr($_SESSION);

	if (!empty($_POST)) {
		$password = $_POST['password'];
		$passwordConfirm = $_POST['passwordConfirm'];
		$id = $_SESSION['id'];

		if (empty($password)) {
			$password_error = "Veuillez renseigner votre mot de passe";
			$passwordField_error = "inputError";
		}
		elseif (strlen($password) < 6) {
		$passwordField_error = "Votre mot de passe doit contenir au moins 6 caractères";
		}
		else{
			// le mot de passe contient au moins une lettre ?
			$containsLetter = preg_match('/[a-zA-Z]/', $password);
			// le mot de passe contient au moins un chiffre ?
			$containsDigit = preg_match('/\d/', $password);
			// le mot de passe contient au moins un caractère spécial ?
			$containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);
		}
		if (!$containsLetter || !$containsDigit || !$containsSpecial) {
			$password_error = "Veuillez choisir un mot de passe avec au moins une lettre, un chiffre et un caractère spécial !";
		}
				// protection injection XSS et suppression des espaces en début et fin de chaîne...
		$password = trim(strip_tags($password));

			// password confirm
		if (empty($passwordConfirm)) {
			$passwordConfirm_error = "Veuillez renseigner votre mot de passe";
			$passwordConfirmField_error = "inputError";
		}
		elseif ($passwordConfirm != $password) {
			$passwordConfirm_error = "Le mot de passe est différent !";
			$passwordConfirmField_error = "inputError";
		}

		if ($password_error == "" && $passwordConfirm_error == "") {
		$sql = "UPDATE users
				SET password = :password, token = NULL, date_modified = NOW() 
				WHERE :id = id";
		

		$sth = $dbh->prepare($sql);
		
		
		// hashage
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$sth->bindValue(':password',$hashedPassword);
		$sth->bindValue(':id',$id);

		$sth->execute();

		// connecter l'utilisateur programmatiquement
		// on va recherche toutes les infos que l'on vient d'insérer
		// $sql = "SELECT id, email, username, password, date_created, date_modified
		// 		FROM users
		// 		WHERE id = :id";

		// 		$sth = $dbh->prepare($sql);
		// 		$sth->bindValue(":id",$dbh->lastInsertId());
		// 		$sth->execute();
		// 		$user = $sth->fetch();

		header("location: welcome.php");
		die();

		}
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Changement de mot de passe</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
			
	<form action="change_password.php" method="post">
			<fieldset>
				<legend>Bonjour 
				<?php 
				// 	if (!empty($_GET)) {
				// 		echo $user['username'];
				// 	}
				// 	else{
				// 		echo $_SESSION['username'];
				// }

				?>
				, vous pouvez maintenant modifier votre mot de passe.</legend>

				<div class="form-group">
					<label for="password" class="col-lg-2 control-label">Nouveau Mot de passe</label>
					<div class="col-lg-10">
						<input class="form-control <?php echo $passwordField_error?>" id="password" name="password" type="password">
						<p class="text-danger"><?php echo $password_error?></p>
					</div>
				</div>
		
				<div class="form-group">
					<label for="passwordConfirm" class="col-lg-2 control-label">Confirmer votre  nouveau mot de passe</label>
					<div class="col-lg-10">
						<input class="form-control <?php echo $passwordConfirmField_error?>" id="passwordConfirm" name="passwordConfirm" type="password">
						<p class="text-danger"><?php echo $passwordConfirm_error?></p>
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="submit" class="btn btn-primary">Valider</button>
						<p class="text-danger"></p>
					</div>
				</div>
			</fieldset>
	</form>

	
	</div>
	
	
</body>
</html>
