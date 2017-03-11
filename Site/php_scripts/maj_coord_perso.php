<?php
	session_start();
	include_once 'connexion_bd.php';
	include_once 'formater_champ.php';
	include_once 'queryFunctions.php';

	function mettre_a_jour($id){
		$req = "update utilisateurs
				set
				Prenom = '".formater($_POST['prenom'])."',
				Nom = '".formater($_POST['nom'])."',
				Courriel = '".formater($_POST['courriel'])."',
				Telephone = '".$_POST['telephone']."',
				Sexe = '".$_POST['sexe']."'";

		$query = "select * from utilisateurs where id_utilisateur =".$id;
	    $mysqli = connexion();
	  	$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {

				  if ($row['ID_Groupe'] == 0)
				  {
				  	$req = $req .",Type_Utilisateur ='".$_POST['type_user']."'
					where id_utilisateur = ".$_SESSION['uid'].";";
					phpQuery($req);
					echo 'Mise à jour du profil réussie';
				  }
				  else
				  {
				  	$req = $req. " where id_utilisateur = ".$_SESSION['uid'].";";
					phpQuery($req);
					echo 'Mise à jour du profil réussie';					
				  }
			  
			}	  
		}
	}

	if (empty($_POST['prenom']) || (empty($_POST['nom'])) )
	{
		echo "Veuillez renseigner les champs obligatoires";
	}
	else
	{
	mettre_a_jour($_SESSION['uid']);
	}
?>