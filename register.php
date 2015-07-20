<?php 
	include 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register page</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		
		<form class="form-horizontal" method="post">
			<fieldset>
				<legend>Créer un compte</legend>
				<div class="form-group">
					<label for="email" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input class="form-control" id="email" name="email" placeholder="Email" type="text">
					</div>
				</div>
				<div class="form-group">
					<label for="username" class="col-lg-2 control-label">Nom d'utilisateur</label>
					<div class="col-lg-10">
						<input class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" type="text">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-lg-2 control-label">Mot de passe</label>
					<div class="col-lg-10">
						<input class="form-control" id="password" name="password" type="password">
					</div>
				</div>
				<div class="form-group">
					<label for="passwordConfirm" class="col-lg-2 control-label">Confirmer votre mot de passe</label>
					<div class="col-lg-10">
						<input class="form-control" id="passwordConfirm" name="passwordConfirm" type="password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="reset" class="btn btn-default">Cancel</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</body>
</html>