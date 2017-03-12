<?php
include_once 'queryfunctions.php';
if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
	
		if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

	}else{ header('Location: accueil.php');};


 echo phpQuery('delete from groupes where id_groupe = '.$_POST['id_groupe'])?>
?>



