<?php
	session_start();
	require ("config.php");
	require ("db.php");
	require ("vendor/autoload.php");
	require ("functions.php");


	// insertion du token dans la bdd

	$email = $_SESSION['email'];
	$token = randomString();
	$hashedToken = password_hash($token, PASSWORD_DEFAULT);
	
	// echo $token;

	$sql = "UPDATE users
			SET token = :hashedtoken, date_modified = NOW()
			WHERE email = :email";

	$sth = $dbh->prepare($sql);
	$sth->bindValue(':email', $email);
	$sth->bindValue(':hashedToken',$hashedToken);
	$sth->execute();


	//instance de PHPMailer
	$mail = new PHPMailer;

	//config de l'envoi
	$mail->isSMTP();
	$mail->setLanguage('fr');
	$mail->CharSet = 'UTF-8';

	//debug
	$mail->SMTPDebug = 2;	//0 pour désactiver les infos de débug
	$mail->Debugoutput = 'html';

	//config du serveur smtp
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = SMTPUSER;
	$mail->Password = SMTPPASS;

	//qui envoie, et qui reçoit
	$mail->setFrom('info@nanterre.com');
	$mail->addAddress($email);

	//mail au format HTML
	$mail->isHTML(true); 

	//sujet 
	$mail->Subject = 'Renouvellement de votre mot de passe';

	//message (avec balises possibles)
	$mail->Body = 'Bonjour, veuillez cliquer sur le lien pour renouveler votre mot de passe :
	<a href="http://localhost/auth/change_password.php?i='.$token.'&j='.$email.'">Cliquez ici pour créer un nouveau mot de passe</a>';

	// $mail->addAttachment('panda.gif');

	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}