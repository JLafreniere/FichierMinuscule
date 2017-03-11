<?php
	include_once 'connexion_bd.php';
	include_once 'queryfunctions.php';
	$mysqli = connexion();

	if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
	
		if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

	}else{ header('Location: accueil.php');};



	echo "insert into groupes(nom_groupe, id_prof, id_session, ensemble) values(\"".$_POST['nomgroupe']."\", ".$_SESSION['uid'].",".$_POST['session'].",".$_POST['ensemble'].")";
	phpQuery("insert into groupes(nom_groupe, id_prof, id_session, ensemble) values(\"".$_POST['nomgroupe']."\", ".$_SESSION['uid'].",".$_POST['session'].",".$_POST['ensemble'].")");
	echo  "insert into groupes(nom_groupe, id_prof, session, ensemble) values(\"".$_POST['nomgroupe']."\", ".$_SESSION['uid'].",".$_POST['session'].",".$_POST['ensemble'].")";
	

	$session = 1; //SELECT SESSION WHERE SYSDATE

	



?>





