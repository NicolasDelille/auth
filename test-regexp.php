<?php

	$yearRegexp = "/^\d{4}$/";
	// autre formulation
	// $yearRegexp = "/^[0-9]{4}$/";
	
	// quand on conditionne (par exemple une date de naissance -> [1-2] pour les années 1000 à 2000)
	$yearRegexp = "/^[1-2][0-9]{3}$/";

	$emailRegexp ="/^[a-zA-Z0-9._-]{1,}@[a-zA-Z0-9_-]{1,}\.[a-zA-z]{2,}$/i";//le "i" après la balise de fermeture rend l'expression insensible à la casse
	
	// autre formulation
	// $emailRegexp ="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9_-]+\.[a-zA-z]{2,}$/";

	// $usernameRegexp = "/^[a-zA-Z0-9._-]{2,100}$/";
	$usernameRegexp = "/^[\p{L}0-9._-]{2,100}$/u";//le "u" correspond à "utf-8"


	if (preg_match($usernameRegexp, "")) {
		echo "match";
	}
	else{
		echo "no match";
	}

	// gestion du password
	