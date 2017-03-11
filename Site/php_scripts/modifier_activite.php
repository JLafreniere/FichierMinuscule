<?php
	include_once 'connexion_bd.php';
	include_once 'formater_champ.php';
	include_once 'queryfunctions.php';
	if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }

		if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

	}else{ header('Location: accueil.php');};

	if(empty($_POST['nom_act']))
	{
		echo "Veuillez saisir le nom de l'activité";
	}
	else
	{
		if (empty($_POST['duree']))
		{
			$_POST['duree'] = 0;
		}

		if (empty($_POST['nbr_pts']))
		{
			$_POST['nbr_pts'] = 0;
		}

		$req = "UPDATE activites
				set nom_activite = '".formater($_POST['nom_act'])."',
					duree = {$_POST['duree']},
					ponderation = {$_POST['nbr_pts']},
					commentaire = '".formater($_POST['desc'])."'
					where id_activite = {$_POST['id_act']}";
					
		phpQuery($req);
		echo "Mise à jour de l'activité réussie";
	}

?>