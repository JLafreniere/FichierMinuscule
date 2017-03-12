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


      $query = "update utilisateurs set administrateur=".$_POST['admin']." where id_utilisateur = ".$_POST['user'];
      ECHO $query;
      $mysqli = connexion();
      $mysqli->query($query);
      ?>