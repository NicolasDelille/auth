<?php
	session_start();
	include('config.php');
	include('db.php');
	include ('functions.php');
	
	$login_error = "";
	
	
	if (!empty($_SESSION['login_error'])) {
		$login_error = $_SESSION['login_error'];
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Connexion</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<h1>Connexion</h1>
		
		<form action="login_handler.php" method="post">
			<fieldset>
				<legend>Saisissez vos identifiants</legend>

				<div class="form-group">
					<label for="email" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input class="form-control" id="email" name="email" placeholder="Email" type="text">
					</div>
				</div>

				<br>
				<br>
							
				<div class="form-group">
					<label for="password" class="col-lg-2 control-label">Mot de passe</label>
					<div class="col-lg-10">
						<input class="form-control" id="password" name="password" placeholder="Mot de passe" type="password">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="rememberMe" id="rememberMe" value="yes"> Remember me ?
						</label>
					</div>
					</div>
				</div>

				<br>
				<br>

				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="reset" class="btn btn-default">Annuler</button>
						<button type="submit" class="btn btn-primary">Valider</button>
						
						<p class="text-danger">
							<?php 
							echo $login_error;
							unset($_SESSION['login_error']);
							?>
					</p>
					</div>
					<div class="col-lg-10 col-lg-offset-2">
						<a href="forgot_password.php">Mot de passe oublié ?</a>
					</div>
				</div>

				
				

			</fieldset>
		</form>


	</div>
	
</body>
</html>
