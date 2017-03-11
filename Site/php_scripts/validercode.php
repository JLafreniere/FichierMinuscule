<?php
include_once 'connexion_bd.php';
include_once 'formater_champ.php';

if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            
$_SESSION['code_insc'] = $_POST['code'];
$query = "select id_utilisateur, id_groupe from utilisateurs where BINARY code_acces = '".$_POST['code']."'";
  
  $mysqli = connexion();
  $myArray = array();
  if ($result = $mysqli->query($query)) {

    if ( mysqli_num_rows($result) == 1) 
    {

    $row = $result->fetch_array();
    if ($row[1] != '0'){
      echo 'Groupe';
    }
    else echo 'SansGroupe';
    }
    else
    {
    echo 'fail';
    }
    
  
  }

  $mysqli->close();  
 
  ?>