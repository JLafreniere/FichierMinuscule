<?php
include_once 'connexion_bd.php';
function obtenir_info($id)
{
  $query = "select * from utilisateurs where id_utilisateur =".$id;
  $mysqli = connexion();
  $result = $mysqli->query($query);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      //Set Prenom
      echo "<script>$('#prenom_user').val('".str_replace("'","\'",$row['Prenom'])."');</script>";

      //Set Nom
      echo "<script>$('#nom').val('".str_replace("'","\'",$row['Nom'])."');</script>";

      //Set Courriel
      echo "<script>$('#email').val('".$row['Courriel']."');</script>";
      
      //Set Téléphone
      echo "<script>$('#tel').val('".$row['Telephone']."');</script>";
      
      //Set Sexe
      echo "<script>$('input[name=sexe][value=\"".$row['Sexe']."\"]').prop(\"checked\",true);</script>";
      
       //Set Lien Personne ressource
      echo "<script>$('#type_utilisateur_profil').val('{$row['Type_Utilisateur']}');</script>";
    }
  $result->close();
  }

  $mysqli->close();
}
  //Si l'utilisateur ne fait pas parti d'un groupe, alors on lui demande le type d'utilisateur qu'il est
  function afficher_select_type($id){

    $query = "select * from utilisateurs where id_utilisateur =".$id;
    $mysqli = connexion();
    $result = $mysqli->query($query);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      
      if ($row['ID_Groupe'] == 0)
      {
        echo "<script>$('#section_type_utilisateur').show();</script>";
      }
      else
      {
      echo "<script>$('#section_type_utilisateur').hide();</script>";
      }
    }
  $result->close();
  }
  $mysqli->close();
}

?>
