<?php 
  include 'modal_inscription.php';
  include 'modal_code_acces.php';
?>
<script>
    function post_connexion(){
    $.ajax({
            type: "POST",
            url: "php_scripts/connecter.php",
            data: {'nom_user': $("#username").val(),
                   'password': $('#pwd').val() }, 
            success: function (data) {
                alert(data);
                if(data == "Connexion réussie"){
                  location.reload();
                }               
        },
            error: function (req) {
                alert("erreur");
            }
        });
      }        

   function Close_Open_Modal(close_modal_id,open_modal_id)
  {
     $(close_modal_id).modal('close');
      $(open_modal_id).modal('open');
     
  }  
</script>


<div id="modal_login" class="modal">
  <div class="modal-content">

    <div class="entete-modal" style="text-align:center;margin-bottom: 15px;">
      <img src="http://www.cegeptr.qc.ca/wp-content/uploads/2013/01/defi-sante-300x251.png" id="imgDef" style="height:150px;width:150px;">
    </div>
    <div class="contenu-modal">
      <div class="row">
        <form class="col s12" id="frm_co">
          <div class="row">
            <div class="input-field col s12" style="margin-top:15px">
              <i class="material-icons prefix">account_circle</i>
              <input id="username" name="username" onkeypress="return RestrictSpecial(event)"  type="text" class="validate" maxlength="50">
              <label for="username">Nom d'utilisateur</label>
            </div>
            <div class="input-field col s12" style="margin-top:15px">
              <i class="material-icons prefix">lock</i>
              <input id="pwd" name="pwd" type="password" class="validate">
              <label for="pwd">Mot de passe</label>
            </div>
            <div class="col s12 l12" style="margin-top:15px">
              <button class="btn green waves-effect waves-light col s12 l12" onclick="post_connexion()" name="connexion" id="connexion" type="button">Connexion</button>
            </div>
            <div class="col s12 l12" style="margin-top:15px">
              <button class="btn green waves-effect waves-light col s12 l12" type="button" onclick="Close_Open_Modal('#modal_login','#modal_code')">Inscription</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<script src="js/verifstring.js"></script>	
</script>