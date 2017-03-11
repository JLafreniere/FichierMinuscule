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

	function phpQuery($query){
    $mysqli = connexion();
	$myArray = array();
	$mysqli->query($query);
	
	$mysqli->close();
	}

	if(($_POST['nom'] !='') && ($_POST['deb'] !='') && ($_POST['mi'] !='') && ($_POST['fin'] !=''))
	{
		if (($_POST['deb'] < $_POST['mi']) && ($_POST['mi'] < $_POST['fin']) )
		{

			$requete = "SELECT id_session from sessions where '{$_POST['deb']}' <= fin_session and '{$_POST['fin']}' >= debut_session";
			$mysqli = connexion();
			$result = $mysqli->query($requete);
			if ($result->num_rows == 0)
			{
			    $req = "insert into sessions values (null,'{$_POST['deb']}','{$_POST['fin']}','{$_POST['mi']}','".formater($_POST['nom'])."');";

				echo phpQuery($req);
				echo "Création de la session réussie";
			}
			else
			{
			echo "Une autre session se déroule durant cette période";
			}
			 
		}
		else
		{
			echo "Les dates saisies ne sont pas significatives";
		}
	}
	else
	{
		echo "Veuillez remplir les champs obligatoires";
	}
?>