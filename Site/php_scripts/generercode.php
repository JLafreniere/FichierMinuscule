<?php

	include_once 'connexion_bd.php';
	include_once 'queryfunctions.php';
	if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }

		if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

	}else{ header('Location: accueil.php');};

	$mysqli = connexion();

	//MAIN

	$nb_codes = 0;
	echo 'NB_POSTES: '.$_POST['nb_codes'];
	if ($_POST["nb_codes"] > 60){
		$nb_codes = 60;
	}
	else{
		$nb_codes = $_POST['nb_codes'];
	}
	for ($x = 0; $x < $nb_codes; $x++) {
		$query ='insert into utilisateurs(id_groupe, code_acces, administrateur) values('.$_POST['id_groupe'].', "'.substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", 5)), 0, 5).'",'.$_POST['admin'].')';
		echo $query;
	 echo phpQuery($query);
	}

 ?>