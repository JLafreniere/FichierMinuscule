<script src="js/ajax_inscription.js"></script>

<?php 
include_once 'php_scripts/afficher_info_user.php'; 
?>
<div class="modal" id="modal_ins">
  <div class="modal-content ">
    <div class="row" style="text-align: center;">
      <h4 class="">Inscription</h4>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">perm_identity</i>
        <input name="username" id="user" type="text" onkeypress="return restrictSpecial(event)" class="validate" maxlength="30">
        <label for="username">Nom d'utilisateur*</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12 l6">
        <!--    <i class="material-icons prefix">person_pin</i> -->
        <input name="prenom" id="prenom" type="text" class="validate" maxlength="50">
        <label for="prenom">Prénom*</label>
      </div>
      
      <div class="input-field col s12 l6">
        <input name="nom" id="nom_t" type="text" class="validate" maxlength="50">
        <label for="nom">Nom*</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">email</i>
        <input name="courriel" id="courriel" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="validate" maxlength="75">
        <label for="courriel">Courriel*</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s10">
        <i class="material-icons prefix">phone</i>
        <input name="telephone" id="telephone" type="text"  data-input-showMaskOnHover="false" class="validate" maxlength="14">
        <label for="telephone">Téléphone</label>
      </div>
    </div>

    <div class="row">
      <div class="col s12">
        <i class="material-icons prefix">people</i>
        <input name="sexe" type="radio" id="s1" value="H" checked class="with-gap" />
        <label for="s1" style="margin:auto;">Homme</label>
        <input name="sexe" type="radio" id="s2" value="F" class="with-gap"/>
        <label for="s2" style="margin:auto;">Femme</label>
      </div>
    </div>

    <div class="row">
      <div class="col s12 l12">                 
            <div id='nePasAfficher'>
            <label for='type_utilisateur'>Type d'utilisateur</label>
              <select id='type_utilisateur'>
                <option value='eleve'>Élève</option>
                <optgroup label='Membre du personnel'>
                  <option value='administration'>Administration</option>
                  <option value='enseignant'>Enseignant</option>
                  <option value='professionnel'>Professionnel</option>
                  <option value='soutien'>Soutien</option>
                </optgroup>
                <optgroup label='Autre'>
                  <option value='ami'>Ami</option>
                  <option value='parent'>Parent</option>
                </optgroup>
            </select>
            </div>
      </div>

    </div>

    <div class="row">  
      <div class="input-field col s12">
        <i class="material-icons prefix">lock</i>
        <input name="password" id="pass" type="password" class="validate">
        <label for="password">Mot de passe*</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">lock</i>
        <input name="confpass" id="confpass" type="password" class="validate">
        <label for="confpass">Confirmer le mot de passe*</label>
      </div>
    </div>
    <div class="center">
      <button type="button" class="btn green" href="" onclick="valider()" >Enregistrer</button>
      
      <button type="button" class="btn red" href="" onclick="$('#modal_ins').modal('close')">Annuler</button>
    </div>
</div>

</div><script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script  src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script src="js/inputmask/dist/inputmask/inputmask.js"></script>
<script src="js/inputmask/dist/inputmask/jquery.inputmask.js"></script>
<script src="js/inputmask/dist/inputmask/inputmask.???.Extensions.js"></script>
<script src="js/verifstring.js"></script>


<script>
	 
	 var selector = document.getElementById("telephone");
   showMaskOnHover: false
	 
	 Inputmask({"mask": "(999) 999-9999", showMaskOnHover: false }).mask(selector);



</script>