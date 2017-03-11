 <nav>


      <div class="nav-wrapper">
        <a href="accueil.php" class="brand-logo center" style="bottom: 0px !important;"><span class="hide-on-med-and-up"> <img href="accueil.php" style="margin-bottom: -18px !important; margin-left: -56px" src="image/logo.png" width="56" height="56"> </span>Défi Santé</a>


       <ul id="nav-mobile" class="left hide-on-med-and-down" style="margin-left: 10px">
          <li><a href="accueil.php"><img src="image/logo.png" href="accueil.php" width="64" height="64"></a></li>

          <?php
          if(isset($_SESSION['admin'] )){
           if($_SESSION['admin'] != 0){?>
          
          <li><a class="adminTabs" href="administration.php">Administration</a></li>
           <li><a href="stats.php">Statistiques</a></li>
          <?php }}?>


          
         
             <?php  if(isset($_SESSION['uid'] )){
           if($_SESSION['uid'] != 0){?>
          <li><a href="profil.php">Profil et Inscriptions</a></li>
           <?php }}?>
          
        </ul>
        
        <?php


        if(!isset($_SESSION['uid'])){
         $_SESSION['uid'] = 0;
          }
         if (isset($_SESSION['username'])){
                    }
        if ($_SESSION['uid'] == 0)
        {
        echo '
        <ul id="nav-mobile" class="right">
        
        <li><a data-target="modal_login"><i class="material-icons prefix">account_circle</i></a></li>
        </ul>';

        }
        else
        {     
          echo '
            <form action="Accueil.php" method="POST">
            <ul id="nav-mobile" class="right">
            <li></li>
            <li style="margin-right: 20px"><a href="profil.php"><span id="Greet_User" class="hide-on-med-and-down"></span></a></li>

            <li>  <button class="btn blue waves-effect waves-light right hide-on-small-only" style="margin-top:14px;margin-right:10px;" type="submit" name="deconnexion">Déconnexion
              </button></li>
            </form>';

           echo "<script> document.getElementById('Greet_User').innerHTML ='Bonjour ".$_SESSION['username']."'</script>";

          if (isset($_POST['deconnexion']))
          {
            $_SESSION['uid'] = 0;
            $_SESSION['admin'] = 0;
            $_SESSION['username'] = "nobody";
            header('Location: accueil.php');
          }
        }


        ?>

      </div>
    </nav>
    <div class="fixed-action-btn vertical click-to-toggle hide-on-large-only " style="margin-right: -20px" >
    <a class="btn-floating btn-large blue darken-2 waves-effect waves-light">
      <i class="material-icons">menu</i>
    </a>
    <ul id="nav_mobile_fab"> 
      <li><a class="btn-floating  waves-effect waves-light blue" href="accueil.php"><i class="material-icons">home</i></a></li>
      <li><a ng-show="<?=$_SESSION['uid']?> != 0" class="btn-floating  waves-effect waves-light blue" href="profil.php"><i class="material-icons">person</i></a></li>
      <li><a ng-show="<?=$_SESSION['admin']?> > 1" class="btn-floating  waves-effect waves-light blue" href="administration.php"><i class="material-icons">supervisor_account</i>Profil</a></li>
      <li><a ng-show="<?=$_SESSION['admin']?> > 1" class="btn-floating blue waves-effect waves-light" href="stats.php"><i class="material-icons">assessment</i></a></li>
      <li><a ng-show="<?=$_SESSION['uid']?> != 0" class="btn-floating blue waves-effect waves-light" onclick="deconnexion()" ><i class="material-icons">exit_to_app</i></a></li>
      <li><a ng-show="<?=$_SESSION['uid']?> == 0" class="btn-floating blue waves-effect waves-light" data-target="modal_login" ><i class="material-icons">account_circle</i></a></li>
      
    </ul>
  </div>

  <script>
    

    function deconnexion(){

         $.ajax({
            type: "POST",
            url: "accueil.php",
            data: {
                'deconnexion': true,
            }, //TODO: CHANGE PROF ID
            success: function(data) {
                   location.reload();
            },
            error: function(req) {
                alert("erreur");
            }
        });


    }

document.addEventListener('DOMContentLoaded', function() {

    $("#nav_mobile_fab").css("right", 30);
    $("#nav_mobile_fab a").css("margin-right", -30);
    $("#modal_login").on('keyup', function (e) {
    if (e.keyCode == 13) {
        post_connexion();
    }
      });

$("#modal_ins").on('keyup', function (e) {
    if (e.keyCode == 13) {
        valider();
    }
      });

$("#modal_code").on('keyup', function (e) {
    if (e.keyCode == 13) {
        confirmerCode();
    }
      });





    });


  </script>

    <?php
    include 'modal_connexion.php';
    ?>


