<?php 
include("db.php");
include("functions.php");


$email_error = "";
$emailField_error = "";
$username_error = "";
$usernameField_error = "";
$password_error = "";
$passwordField_error = "";
$passwordConfirm_error = "";
$passwordConfirmField_error = "";



if(!empty($_POST)){
	pr($_POST);

		// attribtion des variables
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordConfirm = $_POST['passwordConfirm'];


		// vérification des inputs
			// email
				// longueur de l'input

	if(empty($email)){
		$email_error = "Veuillez renseigner votre email";
		$emailField_error = "inputError";
	}
	elseif(strlen($email) < 4){
		$email_error = "Votre adresse email trop courte";
		$emailField_error = "inputError";
	}
	elseif (strlen($email) > 255) {
		$email_error = "Votre adresse email trop longue";
		$emailField_error = "inputError";
	}
				//validation de l'adresse email
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email_error = "Mauvais format d'adresse email";
		$emailField_error = "inputError";
	}

				// protection injection XSS et suppression des espaces en début et fin de chaîne...
	$email = trim(strip_tags($email));

			// username
				// longueur de l'input
	if (empty($username)) {
		$username_error = "Veuillez renseigner votre identifiant";
		$usernameField_error = "inputError";
	}
	elseif(strlen($username < 2)){
		$username_error = "Le nom d'utilisateur trop court";
		$usernameField_error = "inputError";
	}
	elseif (strlen($username) > 255) {
		$username_error = "Le nom d'utilisateur trop court";
		$usernameField_error = "inputError";
	}

				// protection injection XSS et suppression des espaces en début et fin de chaîne...
	$username = trim(strip_tags($username));

			// password
	if (empty($password)) {
		$password_error = "Veuillez renseigner votre mot de passe";
		$passwordField_error = "inputError";
	}
	elseif (strlen($password) < 6) {
		$passwordField_error = "Votre mot de passe doit contenir au moins 6 caractères";
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



		// préparation de la reqûete SQL

	if ($email_error == "" && $username_error == "" && $password_error == "" && $passwordConfirm_error == "") {
		$sql = "INSERT INTO users(id, email, username, password, date_created, date_modified) 
		VALUES (NULL, :email, :username, :password, NOW(), NOW())";
		

		$sth = $dbh->prepare($sql);
		
		// protection des injonctions sql
		$sth->bindValue(':email',$email);
		$sth->bindValue(':username',$username);
		$sth->bindValue(':password',$password);
		$sth->execute();
	}


}


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register page</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<h1>Inscription</h1>
		
		<form class="form-horizontal" method="post">
			<fieldset>

				<legend>Créer un compte</legend>

				<div class="form-group">
					<label for="email" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input class="form-control <?php echo $emailField_error?>" id="email" name="email" placeholder="Email" type="text">
					</div>
					<p class="lead text-danger">
						<?php echo $email_error?>
					</p>
				</div>
							
				<div class="form-group">
					<label for="username" class="col-lg-2 control-label">Nom d'utilisateur</label>
					<div class="col-lg-10">
						<input class="form-control <?php echo $usernameField_error?>" id="username" name="username" placeholder="Nom d'utilisateur" type="text">
					</div>
					<p class="lead text-danger">
						<?php echo $username_error?>
					</p>
				</div>

				<div class="form-group">
					<label for="password" class="col-lg-2 control-label">Mot de passe</label>
					<div class="col-lg-10">
						<input class="form-control <?php echo $passwordField_error?>" id="password" name="password" type="password">
					</div>
					<p class="lead text-danger">
						<?php echo $password_error?>
					</p>
				</div>
		
				<div class="form-group">
					<label for="passwordConfirm" class="col-lg-2 control-label">Confirmer votre mot de passe</label>
					<div class="col-lg-10">
						<input class="form-control <?php echo $passwordConfirmField_error?>" id="passwordConfirm" name="passwordConfirm" type="password">
					</div>
					<p class="lead text-danger">
						<?php echo $passwordConfirm_error?>
					</p>
				</div>
	
				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="reset" class="btn btn-default">Annuler</button>
						<button type="submit" class="btn btn-primary">Valider</button>
					</div>
				</div>

			</fieldset>

		</form>

	</div>
</body>
</html>