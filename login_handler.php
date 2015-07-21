<?php
	session_start();
	include("config.php");
	include("vendor/autoload.php");
	include("functions.php");
	include("db.php");

	// pr($_POST);
	if (empty($_POST)) {
		header("Location: login.php");
		die();
	}
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM users
			WHERE email = :email
			OR username = :email
			LIMIT 1";


	$sth = $dbh->prepare($sql);
	$sth->bindValue(':email',$email);
	$sth->execute();

	$foundUser = $sth->fetch();

	if($foundUser){
		//check password
		
		// pr($foundUser);
		
		// echo $password . "<br />";
		// echo $password_hash;

		$foundPassword = $foundUser['password'];
		$isValidPassword = password_verify($password,$foundPassword);

		if($isValidPassword){
			// echo "le mot de passe est correct";
			unset($foundUser['password']);
			$_SESSION['user'] = $foundUser;
			// pr($_SESSION['user']);

			// redirection
			header("Location: welcome.php");
			die();
		}
		else{
			// echo "mot de passe incorrect";
			$_SESSION['login_error'] = "Mot de passe ou nom d'utilisateur erroné !";
			header("location: login.php");
			die();
		}

	}
	else {
		// redirection to login.php with errorMessage
		// echo 'not found !';
		$_SESSION['login_error'] = "Mot de passe ou nom d'utilisateur erroné !";
			header("location: login.php");
			die();
	}
