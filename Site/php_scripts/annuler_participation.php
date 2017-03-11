<?php
include_once 'queryfunctions.php';

if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            
if(isset($_SESSION['uid'])){
}else{ header('Location: accueil.php');};

date_default_timezone_set('America/Montreal');
$temps_courrant = date("H:i",time()); 

if($_POST['date_activite'] == date('Y-m-d'))
{
	if($_POST['heure'] - $temps_courrant < "1:00:00")
	{
		echo "Impossible de quitter l'activité";
	}
	else
	{
		$query = "delete from utilisateur_activites where id_eleve_activite = {$_POST['id_act_utilisateur']}";
		phpQuery($query);
		echo "Vous avez quitté l'activité avec succès";
	}
}
else
{
		$query = "delete from utilisateur_activites where id_eleve_activite = {$_POST['id_act_utilisateur']}";
		phpQuery($query);
		echo "Vous avez quitté l'activité avec succès";
	}
?>