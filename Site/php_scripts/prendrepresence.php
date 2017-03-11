<?php
	include_once 'connexion_bd.php';
	include_once 'formater_champ.php';
	$activite_prevue=$_POST['ACTIVITE'];
	$eleves_presents = $_POST['PRESENTS'];

	if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }

		if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

	}else{ header('Location: accueil.php');};
	
	$query = "update utilisateur_activites set present=0 where id_activite_prevue = ".$activite_prevue;

		
		$mysqli = connexion();
		$mysqli->query($query);


		$query = "update activites_prevues  set presences_prises=1 where id_activite_prevue = ".$activite_prevue;

		echo $query;

		$mysqli = connexion();
		$mysqli->query($query);




		//$query = "delete from utilisateur_activites where ID_Activite_Prevue = ".$act;

		

		
		foreach ((array)$eleves_presents as $value) {
    	$query = "update utilisateur_activites set present=1 where id_utilisateur = ".$value;
    	echo $query;
		
		$mysqli->query($query);

		}	
		//		$mysqli = new mysqli('localhost','root','','bd_application');
		//$mysqli->query($query);
?>