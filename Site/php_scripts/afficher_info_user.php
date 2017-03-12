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
      echo "<script>$('#prenom_user').val('".str_replace("'","\'",$row['prenom'])."');</script>";

      //Set Nom
      echo "<script>$('#nom').val('".str_replace("'","\'",$row['nom'])."');</script>";

      //Set Courriel
      echo "<script>$('#email').val('".$row['courriel']."');</script>";
      
      //Set Téléphone
      echo "<script>$('#tel').val('".$row['telephone']."');</script>";
      
      //Set Sexe
      echo "<script>$('input[name=sexe][value=\"".$row['sexe']."\"]').prop(\"checked\",true);</script>";
      
       //Set Lien Personne ressource
      echo "<script>$('#type_utilisateur_profil').val('{$row['type_utilisateur']}');</script>";
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
      
      if ($row['id_groupe'] == 0)
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
