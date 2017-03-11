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
	}
else{ header('Location: accueil.php');};

date_default_timezone_set('America/Montreal');

function is_in_session($query){

   $mysqli = connexion();

	if ($result = $mysqli->query($query)) {

	    $row = $result->fetch_array();
	    
	    if ($row['session_en_cours'] != 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }

	}

		
		$mysqli->close();
}


function verifier_date_activite()
{

	$dateHeureAct = $_POST['date_act'].' '.$_POST['heure_deb'];

	//Compare si la date et l'heure de l'activité est avant maintenant
	if(($dateHeureAct > date('Y-m-d H:i:s',time()))) 
	{

		for ($i = 0; $i <= $_POST['occurence']; $i++) {
			
				$start_date = $_POST['date_act'];  
				$date = strtotime($start_date);
				$date = strtotime("+".$i." week", $date);

			if (empty($_POST['participants_max']) )
			{
				$_POST['participants_max'] = 0;
			}
			if(empty($_POST['frais']) )
			{
				$_POST['frais'] = 0;
			}
			$req = "insert into activites_prevues values (null
											  ,'". date('Y/m/d', $date).
											 "','".$_POST['heure_deb'].
											 "',".$_POST['participants_max'].
											 ",".$_POST['frais'].
											 ",'".formater($_POST['endroit']).
											 "',".$_POST['nom_act'].", 0, 0, ".$_POST['responsable'].");";
			phpQuery($req);
		}
		if($_POST['occurence'] > 0)
		{
			echo "Les activités ont été planifiées avec succès";
		}
		else
		{
			echo "L'activité a été planifiée avec succès";
		}
	}
	else
	{
		echo "La date de l'activité doit se situer dans le futur";
	}
}


function verif_champs_obligatoires()
{
	if(($_POST['nom_act'] == "" ) || ($_POST['date_act'] == "") || ($_POST['heure_deb']==""))
	{
		echo "Veuillez renseigner les champs obligatoires";
	}
	else
	{
		if( ($_POST['occurence'] >= 0) && ($_POST['occurence'] <= 14))
		{
		verifier_date_activite();
		}
		else
		{
			echo "Veuillez saisir une répétition entre 0 et 14";
		}
	}
}

verif_champs_obligatoires();
?>