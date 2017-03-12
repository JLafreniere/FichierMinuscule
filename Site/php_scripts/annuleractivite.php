<?php
	
	$act=$_POST['ID_ACTIVITE'];

	if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            
	if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

	}else{ header('Location: accueil.php');};

	
	$query = "update activites_prevues set hidden=1, presences_prises = 0 where id_activite_prevue = ".$act;

	include_once 'connexion_bd.php';
	$mysqli = connexion();

		ECHO $query;
	
		$mysqli->query($query);


	
?>