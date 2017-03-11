<?php

include_once 'formater_champ.php';
include_once 'connexion_bd.php';
if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }

	if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

	}else{ header('Location: accueil.php');};

	function phpQuery($query){
    $mysqli = connexion();
	$myArray = array();
	$mysqli->query($query);
	
	$mysqli->close();
	}

	if(empty($_POST['nom_act']))
		echo "Veuillez saisir le nom de l'activité";
	else{

	if(empty($_POST['duree']))
	{
		$_POST['duree'] = 0;
	}

	if(empty($_POST['nbr_pts']))
	{
		$_POST['nbr_pts'] = 0;
	}

	$req = "insert into activites values (null,'".formater($_POST['nom_act']).
										 "',".formater($_POST['duree']).
										 ",'".formater($_POST['desc'])."','".
										 $_POST['couleur'].
										 "',0,".$_POST['nbr_pts'].");";
	phpQuery($req);
	echo "L'activité à été créée avec succès";
	}

?>