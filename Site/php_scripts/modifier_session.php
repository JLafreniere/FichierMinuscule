<?php
	
	if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
	
	if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

	}else{ header('Location: accueil.php');};


include_once 'connexion_bd.php';
	include_once 'formater_champ.php';
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
		$requete = "SELECT ID_Session from sessions where '{$_POST['deb']}' <= Fin_Session and '{$_POST['fin']}' >= Debut_Session and ID_Session != {$_POST['id_session']} ";
		$mysqli = connexion();
		$result = $mysqli->query($requete);
		if ($result->num_rows == 0)
		{
		    $req = "UPDATE sessions
		    	set Nom_Session = '".formater($_POST['nom'])."',
					Debut_Session = '{$_POST['deb']}',
					Mi_Session = '{$_POST['mi']}',
					Fin_Session = '{$_POST['fin']}'
					where ID_Session = {$_POST['id_session']}";

			echo phpQuery($req);
			echo "Mise à jour de la session réussie";
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