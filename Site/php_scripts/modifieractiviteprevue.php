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

date_default_timezone_set('America/Montreal');


  $date = date("Y-m-d", strtotime($_POST['DATE_ACT']));

//Vérifie si la date modifiée est dans une session
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

  $dateHeureAct = $_POST['DATE_ACT'].' '.$_POST['HEURE_ACT'];

  //Compare si la date et l'heure de l'activité est avant maintenant
  if(($dateHeureAct > date('Y-m-d H:i:s',time()))) 
  {
    $query = "select count(*) as session_en_cours from sessions where '{$_POST['DATE_ACT']}' BETWEEN debut_session and fin_session";

    //Vérifie si la date choisie fait partie d'une session collégiale
    if(is_in_session($query))
    {
       $req = "update activites_prevues
                     set date_activite='{$_POST['DATE_ACT']}' ,
                         endroit='".formater($_POST['ENDROIT'])."',
                         frais={$_POST['FRAIS']},
                         id_activite={$_POST['ID_ACTIVITE']},
                         participant_max={$_POST['PARTICIPANTS_MAX']},
                         heure_debut='{$_POST['HEURE_ACT']}', 
                         responsable={$_POST['RESPONSABLE']} 
                         where id_activite_prevue = {$_POST['ID_ACTIVITE_PREVUE']}";  
      phpQuery($req);
      echo "L'activité a été modifiée avec succès!";
    }
    else
    {
      echo "L'activité doit être planifiée durant une session.";
    }
  }
  else
  {
    echo "La date de l'activité doit se situer dans le futur";
  }
}


function verif_champs_obligatoires()
{
  if(($_POST['ID_ACTIVITE'] == "" ) || ($_POST['DATE_ACT'] == "") || ($_POST['HEURE_ACT']==""))
  {
    echo "Veuillez renseigner les champs obligatoires";
  }
  else
  {
    verifier_date_activite();
  }
}

verif_champs_obligatoires();

?>
                
                