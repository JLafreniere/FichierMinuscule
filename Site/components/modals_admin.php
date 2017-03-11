<!-- Modal Création d'activité -->
<div id="modal_new_activite" class="modal">
  <div class="modal-content">
    <div class="row" style="text-align: center;">
      <h4 class="">Créer une activité</h4>
    </div>
    <div class="row">
      <div class="input-field col s12 l8">
        <input id="nom_activite" type="text" class="validate" maxlength="75">
        <label for="nom_activite">Nom de l'activité *</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6 l4">
        <label  for="duree">Durée (Minutes)</label>
        <input type="number" step="1" max="180" min="0" id="duree" name="duree" value="60"/>
      </div>
      <div class="input-field col s6 l4">
        <label  for="point">Nombre de points</label>
        <input type="number" step="0.5" max="3" min="0" value="1" id="point" name="point"/>
      </div>
    </div>
    Couleur de l'activité
    <div class="row">
      <div class="input-field col s12 l6">
           <input class="jscolor" value="3152C3" id="couleur_activite" maxlength="6">
      </div>
      <button class="btn col s12 l6" onclick="appliquer_couleur()" style="margin-top: 15px; height: 45px">Générer couleur</button>
    </div>
    <div class="row">
      <div class="input-field col s12 l12">
        <textarea id="description" class="materialize-textarea" maxlength="255"></textarea>
        <label for="description">Description</label>
      </div>
    </div>
    <div class="row">
      <div class="col s12 l12">
        <button class="btn green" onclick="creer_act()" style="width:100%"> Créer</button>
      </div>
      <div class="col s12 l12" style="height:15px"></div>
      <div class="col s12 l12">
        <a class="btn red" href="" style="width:100%"> Annuler</a>
      </div>
    </div>
  </div>
</div>

<!-- Génère un code hexadecimal et l'assigne au textbox -->
  <script>
   function generer_couleur()
    {
      let codeHex ="#";

      for(i = 0; i < 6; i++)
      {
        codeHex +=  ("0123456789ABCDEF".substr(Math.floor(Math.random()*16), 1));
      }
      return codeHex;
    }

  function appliquer_couleur(){
    
  let code_couleur = generer_couleur();
  $("#couleur_activite").css("background-color",code_couleur);
  $("#couleur_activite").val(code_couleur.substr(1,6));
}

  
//Fonction ajax pour créer une activité
  function creer_act(){
    $.ajax({
      type: "POST",
      url: "php_scripts/creer_activite.php",
      data: {
             'nom_act': $("#nom_activite").val(),
             'duree': $('#duree').val(),
             'nbr_pts': $('#point').val(),
             'couleur':$('#couleur_activite').val(),
             'desc':$('#description').val()
            },
      success: function (data) {
        alert(data);
        if(data == "L'activité à été créée avec succès")
        {
          location.reload();
        }
      },
      error: function (req) {
        alert("erreur");
      }
    });
  }
</script>

<!-- Modal Création d'activité -->
<div id="modal_mod_new_activite" class="modal">
  <div class="modal-content">
  <input type="hidden" name="id_mod_act" id="id_mod_act" value="1"/> 
    <div class="row" style="text-align: center;">
      <h4 class="">Modifier une activité</h4>
    </div>
    <div class="row">
      <div class="input-field col s12 l8">
        <input id="nom_activite_mod" type="text" class="validate" maxlength="75">
        <label for="nom_activite_mod" class="ACTIVER">Nom de l'activité *</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6 l4">
        <label  for="duree_mod" class="ACTIVER">Durée (Minutes)</label>
        <input type="number" step="1" max="180" min="0" id="duree_mod" name="duree"/>
      </div>
      <div class="input-field col s6 l4">
        <label  for="point_mod" class="ACTIVER">Nombre de points</label>
        <input type="number" step="0.5" max="3" min="0" id="point_mod" name="point"/>
      </div>
    </div>
   
    <div class="row">
      <div class="input-field col s12 l12">
        <textarea id="description_mod" class="materialize-textarea" maxlength="255"></textarea>
        <label for="description_mod">Description</label>
      </div>
    </div>
    <div class="row">
      <div class="col s12 l12">
        <button class="btn green" onclick="modifier_mod_new_act()" style="width:100%">Modifier</button>
      </div>
      <div class="col s12 l12" style="height:15px"></div>
      <div class="col s12 l12">
        <button class="btn red" onclick="$('#modal_mod_new_activite').modal('close');" style="width:100%"> Annuler</button>
      </div>
    </div>
  </div>
</div>

  <script>  
  //Fonction ajax pour créer une activité
  function modifier_mod_new_act(){
    $.ajax({
      type: "POST",
      url: "php_scripts/modifier_activite.php",
      data: {
             'id_act':$("#id_mod_act").val(),
             'nom_act': $("#nom_activite_mod").val(),
             'duree': $('#duree_mod').val(),
             'nbr_pts': $('#point_mod').val(),
             'desc':$('#description_mod').val()
            },
      success: function (data) {
        alert(data);
        if (data == "Mise à jour de l'activité réussie")
        {
        location.reload();
        }
      },
      error: function (req) {
        alert("erreur");
      }
    });
  }
</script>








<!-- Modal pour créer un groupe -->
<div id="modalNouveauGroupe" class="modal" style="height: 510px !important">
  <div class="modal-content">
    <div class="entete-modal" style="text-align:center;margin-bottom: 15px;">
      Ajouter un groupe
    </div>
    <div class="contenu-modal">
      <div class="row">
        <form class="col s12">
          <div class="row">
            <div class="input-field col s12" style="margin-top:15px">
              <i class="material-icons prefix">account_circle</i>
              <input name="nomgroupe" id="nomgroupe" type="text" class="validate" maxlength="65">
              <label for="nom_groupe">Nom du groupe</label>
            </div>
            
            <div class="input-field col s12" style="margin-top:15px">
            <i class="material-icons prefix">date_range</i>
            <select id="session" name="session" ng-options="session.Nom_Session as session.Nom_Session for session in sessions track by session.ID_Session" ng-model="session">

               <option value="" disabled selected>Session</option>
            </select>
            </div>

            <div class="input-field col s12" style="margin-top:15px">
            
            <select id="ensemble" name="ensemble" ng-model="selected">
            <option value="" disabled selected>Ensemble</option>
            <option value="1">Ensemble 1</option>
            <option value="2">Ensemble 2</option>
            <option value="3">Ensemble 3</option>
            </select>
            </div>
            <div class="input-field col s12" style="margin-top:15px">
              <i class="material-icons prefix">supervisor_account</i>
              <input type="number" id="rangeEleves" name="rangeEleves">
              <label for="rangeEleves">Nombre d'élèves</label>
            </div>
            <div class="col s12" style="margin-top:15px">
              <button id="CreerGroupe" class="btn col s12" type="button" ng-click="creergroupe()">Créer le groupe</button>
            </div>
            
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

  <div id="modalGroupe" class="modal" style="height: 300px !important">
    <div class="modal-content" style="height: 100%; ">
      <div class="entete-modal" style="margin-bottom: 15px; text-align:center;">
        Code d'accès du groupe "{{groupeFromId(codeGroupe).nom_groupe}}"
      </div>
      <div class="contenu-modal">
        <div class="row" >
          <div ng-repeat="compte in comptesAvecCodeDansGroupe(codeGroupe)">
            {{compte.code_acces}}
          </div>
          <div style="text-align:center;">
            <a class="waves-effect waves-light btn green" ng-click="print(groupe.id_groupe)" style="bottom: 15px; margin-top: 40px !important"><i class="material-icons left">print</i>Imprimer</a>
          </div>
        </div>
      </div>
    </div>

  
  
</div>


  <div id="modalGenGroupe" class="modal" style="height: 300px">
    <div class="modal-content" style="text-align: center">
      <div class="entete-modal" style="text-align:center;margin-bottom: 15px;">
        Générer des codes d'accès pour le groupe "{{groupeFromId(codeGroupe).nom_groupe}}"
      </div>
      <div class="contenu-modal">

        <div class="row">
          <label for="qt_code">Nombre de codes</label>
          <input type="number" name="qt_code" id="codeGroupe" min="1" max="60" ng-min="1" ng-max="60" validate>
        </div>
        <button type="button" class="btn green" ng-click="genererCodePourGroupe(codeGroupe)">Générer</button>
      </div>
    </div>
  </div>




  <div id="modalGenGroupe0" class="modal" style="height: 300px">
    <div class="modal-content" style="text-align: center">
      <div class="entete-modal" style="text-align:center;margin-bottom: 15px;">
        Générer des codes d'accès pour le groupe "{{groupe.nom_groupe}}"
      </div>
      <div class="contenu-modal">
        <div class="row">
          <label for="qt_code">Nombre de codes</label>
          <input type="number" name="qt_code" id="codeGroupe0" min="1" max="60" ng-min="1" ng-max="60" validate>
        </div>
        <button type="button" class="btn" ng-click="genererCodePourGroupe0()">Générer</button>
      </div>
    </div>
  </div>

    <div id="modalGroupe0" class="modal" style="height: 300px !important">
    <div class="modal-content" style="height: 100%; ">
      <div class="entete-modal" style="margin-bottom: 15px; text-align:center;">
        Code d'accès sans groupe
      </div>
      <div class="contenu-modal">
        <div class="row" >

          <div ng-repeat="compte in comptesAvecCodeDansGroupe(0)" >
            <div ng-show="compte.administrateur <1">{{compte.code_acces}}</div>
          </div>
          <div style="text-align:center;">
            <a class="waves-effect green waves-light btn" ng-click="print(groupe.id_groupe)" style="bottom: 15px; margin-top: 40px !important"><i class="material-icons left">print</i>Imprimer</a>
          </div>
        </div>
      </div>
    </div>
    </div>



  <div id="modalPresence" class="modal" style="height: 400px; width: 400px" >
    <div class="modal-content" style="text-align: center; height: 100%" >
                                      <div class="entete-modal" style="text-align:center;margin-bottom: 15px;">
                                        <h5>Liste de présence </h1>
                                      </div>
                <div class="contenu-modal">
                  <div class="row ">
                    <div ng-repeat="eleve in getElevesForActivitePrevue(activiteSelectionne)" class="row presence">
                      <div class="col s8 field">{{eleve.nom}}, {{eleve.prenom}}</div><div class="field col s2"></div> <input class="field filled-in" checked="checked" type="checkbox" name="presenceActivite" value="{{eleve.id_utilisateur}}"
                      id="checkboxid{{activiteSelectionne}}-{{eleve.id_utilisateur}}" style="margin-right: 15px; margin-top: 15px"><label for="checkboxid{{activiteSelectionne}}-{{eleve.id_utilisateur}}" style="margin-top: 10px" ></label>
                    </div>
                    <button ng-click="enregistrerPresence(activiteSelectionne)" type="button" class="btn" style="position: relative; margin-bottom: 45px; margin-top: 15px">Enregistrer</button>
                  </div>
                </div>
    </div>
  </div>










  <div id="modalCodeAdmin" class="modal" style="height: 400px; width: 400px" >
    <div class="modal-content container" style="text-align: center; height: 100%" >
      <div class="entete-modal" style="text-align:center;margin-bottom: 15px;">
        <h5>Générer des codes administrateurs</h1>
      </div>
      <div class="contenu-modal">


        <div class="row">
          <label for="qt_code">Nombre de codes</label>
          <input type="number" name="qt_code" id="codeAdmin" min="1" max="10" ng-min="1" ng-max="10" validate>
   </div>
  <div style="text-align: left;">
    <p>
      <input name="niveauAdmin" type="radio" id="adminNiveauAdmin" value="2"/>
      <label for="adminNiveauAdmin">Administrateur</label>
    </p>
    <p>
      <input name="niveauAdmin" type="radio" id="adminNiveauPlanif" value="1"/>
      <label for="adminNiveauPlanif">Responsable</label>
    </p>

 </div>

     
          <button ng-click="genererCodeAdmin()" type="button" class="btn" style="position: relative; margin-bottom: 45px; margin-top: 15px">Générer</button>
    
      </div>
    </div>
  </div>





  <div id="modalAfficherCodeAdmin" class="modal" style="width: 400px;" >
    <div class="modal-content" style="text-align:center;" >
      <div class="entete-modal" style="text-align:center;margin-bottom: 15px;">
        <h5>Codes administrateurs</h1>
      </div>
      <div class="contenu-modal">
      <div class="input-field">
        <input type="checkbox" class="filled-in field" id="chkResponsable" ng-model="afficherResponsables">
         <label for="chkResponsable">Afficher les codes responsables</label>
        
      </div>
      <div class="input-field">
        <input type="checkbox" class="filled-in field" id="chkAdmin" name="chkAdmin" ng-model="afficherAdmins">
        <label for="chkAdmin">Afficher les codes administrateurs</label>
      </div>

        <br><br>
        
        <div class="row ">
        <table class="striped">
        <thead><th class="center">Code</th><th class="center">Niveau d'accès</th></thead>
        <tr ng-repeat="admin in codesAdmin | orderBy:'admin.administrateur'" ng-show="(afficherAdmins  && admin.administrateur == 2) || (afficherResponsables && admin.administrateur == 1)">
           <td class="center">{{admin.CODE_ACCES}}</td>
           <td class="center"><span ng-show="admin.administrateur == 1">Responsable</span><span ng-show="admin.administrateur == 2">Administrateur</span></td>
        </div>
        </table>
       
         
        </div>

      </div>

    </div>
    <div class="center container">
                   <button onclick="$('.modal').modal('close')" type="button" class="btn red" style="margin-bottom: 45px">Fermer</button>
                   </div>
  </div>



<!-- Modal pour créer des sessions -->
<div id="modal_session" class="modal">
  <div class="modal-content">
    <div class="row" style="text-align: center;">
      <h4 class="">Créer une session</h4>
    </div>
    <div class="row">
      <div class="input-field col s12 l8">
        <input id="nom_session" type="text" class="validate" maxlength="60">
        <label for="nom_session">Nom de la session*</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12 l8">
        <input type="date" class="datepicker" id="deb_session">
        <label for="deb_session">Date du début de la session*</label>  
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12 l8">
        <input type="date" class="datepicker" id="mi_session">
        <label for="mi_session">Date de la mi-session*</label>
      </div>  
    </div>

    <div class="row">
      <div class="input-field col s12 l8">
        <input type="date" class="datepicker" id="fin_session">
        <label for="fin_session">Date de la fin de la session*</label> 
      </div>
    </div>

    <div class="row">
      <div class="col s12 l12">
        <button class="btn green" onclick="creer_session()" style="width:100%">Créer</button>
      </div>
      <div class="col s12 l12" style="height:15px"></div>
      <div class="col s12 l12">
        <a class="btn red" href="" style="width:100%"> Annuler</a>
      </div>
    </div>
  </div>
</div>

<!-- Fonction AJAX pour créer des sessions -->
<script>
  function creer_session(){
    $.ajax({
            type: "POST",
            url: "php_scripts/creer_session.php",
            data: {'nom': $("#nom_session").val(),
                   'deb': $('#deb_session').val(),
                   'mi': $("#mi_session").val(),
                   'fin': $('#fin_session').val() }, 
            success: function (data) {
                alert(data);
                if (data == "Création de la session réussie")
                {
                  location.reload();
                }           
        },
            error: function (req) {
                alert("erreur");
            }
        });
}        
</script>


<div id="modal_session_mod" class="modal">
  <div class="modal-content">
  <input type="hidden" name="id_session_mod" id="id_session_mod" />
    <div class="row" style="text-align: center;">
      <h4 class="">Modifier une session</h4>
    </div>
    <div class="row">
      <div class="input-field col s12 l8">
        <input id="nom_session_mod" type="text" class="validate" maxlength="60">
        <label for="nom_session_mod">Nom de la session*</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12 l8">
        <input type="date" class="datepicker" id="deb_session_mod">
        <label for="deb_session_mod">Date du début de la session*</label>  
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12 l8">
        <input type="date" class="datepicker" id="mi_session_mod">
        <label for="mi_session_mod">Date de la mi-session*</label>
      </div>  
    </div>

    <div class="row">
      <div class="input-field col s12 l8">
        <input type="date" class="datepicker" id="fin_session_mod">
        <label for="fin_session_mod">Date de la fin de la session*</label> 
      </div>
    </div>

    <div class="row">
      <div class="col s12 l12">
        <button class="btn green" onclick="modifier_session()" style="width:100%">Enregistrer</button>
      </div>
      <div class="col s12 l12" style="height:15px"></div>
      <div class="col s12 l12">
        <a class="btn red" href="" style="width:100%"> Annuler</a>
      </div>
    </div>
  </div>
</div>

<script>
  function modifier_session(){
    $.ajax({
            type: "POST",
            url: "php_scripts/modifier_session.php",
            data: {'id_session': $('#id_session_mod').val(),
                   'nom': $('#nom_session_mod').val(),
                   'deb': $("#deb_session_mod").val(),
                   'mi': $('#mi_session_mod').val(),
                   'fin': $('#fin_session_mod').val() }, 
            success: function (data) {
                alert(data);
                if (data == "Mise à jour de la session réussie")
                {
                  location.reload();
                }  
        },
            error: function (req) {
                alert("erreur");
            }
        });
}        
</script>




<!-- Modal pour planifier des activités -->
<div id="modal_planif" class="modal">
     <div class="modal-content">
    
       <div class="row" style="text-align:center">
           <h4>Planifier une activité</h4>
       </div>
  
         <div class="input-field col s12">
           <select required id="nom_act" name="nom_act">
           <option value="">Choisir une activité *</option>
           <option ng-repeat="activite in activites" value={{activite.ID_Activite}}>{{activite.Nom_Activite}}, {{activite.Duree}} minutes</option>
           </select>
           <label>Nom de l'activité</label>
         </div>
 
         <div class="input-field col s12">
           <input id="date_act" type="date" class="datepicker">
           <label for="date_act">Date de l'activité *</label>
         </div>
 
         <div class="row">
           <div class="input-field col s12 l6">
             <label for="heure_deb">Heure de début *</label>
             <input id="heure_deb" class="timepicker" type="time" ng-model="$ctrl.NA">
           </div>
          <div class="input-field col s12 l6">
             <label  for="occuence">Répéter l'activité *</label>
             <input type="number" step="1" max="15" min="0" id="occurence" name="occurence" value="0"/>
           </div>
         </div>
 
       <div class="row">
         <div class="input-field col s6 l6">
           <label  for="participants_max">Nombre de participants maximum</label>
           <input type="number" step="1" max="180" min="5" id="participants_max" name="participants_max"/>
         </div>
 
         <div class="input-field col s6 l6">
           <label  for="frais">Frais de l'activité</label>
           <input type="number" step="5" min="0" id="frais" name="frais"/>
         </div>
       </div>
 
       <div class="row">
         <div class="input-field col s12 l12">
           <input type="text" id="endroit" class="materialize-textarea"></textarea>
           <label for="endroit">Endroit</label>
         </div>
       </div>

       <div class="row">
         <div class="input-field col s12 l12">
              <select id="selectResponsable" name="selectResponsable">
              <option value="null">Choisir un responsable</option>
              <option ng-repeat="admin in comptesAdministrateur" value="{{admin.id_utilisateur}}">{{admin.Nom}}, {{admin.Prenom}}</option>
            </select>
         </div>
       </div>
      
        <div class="row">
         <div class="col s12 l12">
           <button type="button" class="btn green" style="width:100%"  onclick="planifier_act();"> Planifier</button>
         </div>
         <div class="col s12 l12" style="height: 15px;"></div>
         <div class="col s12 l12">
           <button class="btn red" onclick="location.reload()" style="width: 100%"> Annuler</button>
         </div>
     </div>  
 
   </div>
  
 </div>
<!-- Fonction AJAX pour  Modal Planifier-->
<script>
  function planifier_act(){
    if($('#frais').val() >= 0){
      if($('#participants_max').val() >= 5){
    $.ajax({
      
      type: "POST",
      url: "php_scripts/planifier_activite.php",
      data: {
             'nom_act': $("#nom_act").val(),
             'date_act': $("#date_act").val(),
             'heure_deb': $("#heure_deb").val(),
             'participants_max': $('#participants_max').val(),
             'occurence':$("#occurence").val(),
             'frais': $('#frais').val(),
             'endroit':$('#endroit').val(),
             'responsable':$('#selectResponsable').val()
            },
      success: function (data) {
        
        alert(data);
        if ((data == "L'activité a été planifiée avec succès") || (data == "Les activités ont été planifiées avec succès") )
          {
            location.reload();
            console.log("1"); 
          }
      },
      error: function (req) {
        alert("erreur");
      }
    });
  }else alert("Le nombre de participant maximum doit être supérieur ou égal à 5");
  }else alert("Les frais d'activités doivent être supérieur ou égal à 0");
  }
</script>









 <div id="modal_niveauAdmin" class="modal" style="height: 300px!important">
     <div class="modal-content">
       <div class="row" style="text-align:center">
           <h4>Modifier les permissions</h4>
       </div>
          <input type="hidden" id="utilisateurNivAdmin">
          <select id="niveauUser">
            <option value="1">Responsable</option>
            <option value="2">Administrateur</option>
            <option value="0">Utilisateur Régulier</option>
          </select>
          <br>
          <div class="center">
          <button type="button" class="blue btn" ng-click="saveAdmin()">Enregistrer</button>
        </div>
 
   </div>
  
 </div>


<!-- MODAL PROMOTION -->



<div id="modalPromotion" class="modal">
  <div class="modal-content">
    <div class="row" style="text-align: center;">
      <h4 class="">Promouvoir un élève</h4>
    </div>

   

   <table>
     <thead>
       <th>Nom</th><th></th>
     </thead>
     <tr ng-repeat="el in groupePromotion">
      <td>{{el.nom}}, {{el.prenom}}</td><td><i ng-show="el.administrateur >= 1" ng-click="demoteUser(el.id_utilisateur)" style="color: green" class="material-icons prefix">verified_user</i><i ng-show="el.administrateur < 1" style="color: black" class="material-icons prefix" ng-click="promoteUser(el.id_utilisateur)">verified_user</i></td>    
     </tr>
   </table>
   

    
    <div class="row">
      <div class="col s12 l12">
        <a class="btn red" href="" style="width:100%" onclick="$('#modalPromotion').modal('close')"> Annuler</a>
      </div>
    </div>
  </div>
</div>






 <script>
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });

    $("#select_responsable").hide();
 </script>