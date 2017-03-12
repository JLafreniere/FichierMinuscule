<?php
	include_once 'connexion_bd.php';
	include_once 'formater_champ.php';
	if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }

		if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

	}else{ header('Location: accueil.php');};

	$act=$_POST['ID_ACTIVITE'];

	$query = "update activites set hidden=true where id_activite = ".$act;

		ECHO $query;
		$mysqli = connexion();
		$mysqli->query($query);


	
?>