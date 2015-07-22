<?php
	include('config.php');
	include('db.php');
	include ('functions.php');

	if (!empty($_POST)) {
		// pr($_POST);

		$email = $_POST['email'];

		$sql = "SELECT email,token
				FROM users
				WHERE email = :email";

		$sth = $dbh->prepare($sql);
		$sth->bindValue(':email',$email);
		$sth->execute();
		
		$matchUser = $sth->fetch();
		pr($matchUser);
	}

	if (!empty($matchUser)) {
		echo "Nous vous avons envoyé un email";
	}
	else{
		echo "Votre email n'existe pas...";
	}
	// else{
	// 	header("Location: login.php");
	// 	die();
	// }
	

?>