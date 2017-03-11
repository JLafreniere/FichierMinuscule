<?php
include_once 'connexion_bd.php';
include_once 'formater_champ.php';

if(isset($_POST['nom_user']) and isset($_POST['password'])){
$x = $_POST['nom_user'];
$y = $_POST['password'];
}
session_start();


function verifier_user_existant($username,$pwd_input)
{
  $query = "select * from utilisateurs where lower(username) = lower('".$username."')";
  
  $mysqli = connexion();
  $myArray = array();
  if ($result = $mysqli->query($query)) {

    if ( mysqli_num_rows($result) == 1) 
    {
    $row = $result->fetch_array();
    
    verifier_password($row['id_utilisateur'],$username, $pwd_input, $row['password']);
    } 
    else
    {
      echo "Nom d'utilisateur ou mot de passe invalide";
    }
  }

  $mysqli->close();  
}

function verifier_password($id,$username,$pwd_input,$pwd)
{ 
  if (password_verify($pwd_input,$pwd))
  {
    $mysqli = connexion();
    $getAdmin =  $mysqli->query("SELECT administrateur FROM utilisateurs WHERE id_utilisateur =".$id)->fetch_object()->administrateur; 
    
    
    $_SESSION['admin'] = $getAdmin;
    $_SESSION['uid'] = $id;
    $_SESSION['username'] = formater($username);

    echo "Connexion réussie";
  }
  else
  {
    echo "Nom d'utilisateur ou mot de passe invalide";
  }


}

verifier_user_existant($_POST['nom_user'], $_POST['password']);

?>