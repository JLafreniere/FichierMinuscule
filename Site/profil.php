<?php
session_start();
?>
<html ng-app="app_profil" ng-controller="ctrl">
<head>

  <?php include 'components/headContent.php' ?>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/ajax_coord_perso.js"></script>
</head>

<?php include 'php_scripts/afficher_info_user.php'; ?>
<body class="ng-cloak">
  <header>
        <?php include 'components/nav.php';?>
        <title>Défi Santé - Profil</title>
  </header>
  <main>

  <div class="container">

    <h5>Bonjour <?php echo $_SESSION['username'] ?></h5><br>

  <div id="spEnsemble1" ng-show="ensemble == 1"><b>Vous avez accumulé</b> <p style="margin-left: 20px; margin-top: 0px"> {{pointsReguliersForEleve(<?php echo $_SESSION['uid'] ?>)}} point(s) <br>
  {{pointsBonusEnsemble1ForEleve(<?php echo $_SESSION['uid'] ?>)}} point(s) bonus </p>
   Votre note: <b style="color: green">{{pointsReguliersForEleve(<?php echo $_SESSION['uid'] ?>) + pointsBonusEnsemble1ForEleve(<?php echo $_SESSION['uid'] ?>)}}/5</b><br></div>

  <span id="spEnsemble2" ng-show="ensemble == 2"><b>Vous avez accumulé</b>  <p style="margin-left: 20px; margin-top: 0px">{{pointsEnsemble2(<?php echo $_SESSION['uid'] ?>)}} point(s)</p>
  Votre note: <b style="color: green">{{pointsEnsemble2(<?php echo $_SESSION['uid'] ?>)}}/5</b><br>
 
  </span>

  <span id="spEnsemble3" ng-show="ensemble == 3"><b>Vous avez accumulé</b> <p style="margin-left: 20px; margin-top: 0px">{{pointsDebutForEleve(<?php echo $_SESSION['uid'] ?>)}} point(s) au début de la session <br> {{pointsFinForEleve(<?php echo $_SESSION['uid'] ?>)}} point(s) entre la mi-session et la fin de la session <br> {{pointsBonusForEleve(<?php echo $_SESSION['uid'] ?>)}} point(s) bonus <br>
 

  </p>
   Votre note: <b style="color: green">{{pts3(<?php echo $_SESSION['uid'] ?>)}}/10</b></span>

    <ul class="collapsible" data-collapsible="expandable">
      <!-- Coordonées personnelle -->
      <li class="">
        <div class="collapsible-header"><i class="material-icons">person</i>Coordonnées personnelles</div>
        <div class="collapsible-body container" style="display: none;">
        
        <!-- Nom prénom -->
          <div class="row">
            <div class="input-field col s6 l4">
              <input id="prenom_user" name="prenom_user" type="text" class="validate" maxlength="50">
              <label for="prenom_user">Prénom *</label>
            </div>

            <div class="input-field col s6 l4">
              <input id="nom" name="nom" type="text" class="validate" maxlength="50">
              <label for="nom">Nom *</label>
            </div>
          </div>

       <!-- Courriel Téléphone -->
          <div class="row">
            <div class="input-field col s12 l5">
              <input id="email" name="email" type="email" class="validate" maxlength="75">
              <label for="email">Courriel *</label>
            </div>
         
            <div class="input-field col s6 l3">
              <input id="tel" name="tel" type="text" class="validate" maxlength="14">
              <label for="tel">Téléphone</label>
            </div>
          </div>

          <!-- Sexe -->
          <div class="row">
                <div class="col s6 l6">
                  <input name="sexe" type="radio" id="sH" value="H" class="with-gap" />
                  <label for="sH" style="margin:auto;">Homme</label>
                  <input name="sexe" type="radio" id="sF" value="F" class="with-gap" />
                  <label for="sF" style="margin:auto;">Femme</label>
               </div>
          </div>
          <div class="row">
               <div class="col s6 l6">
                <div id="section_type_utilisateur">                 
                 <label for='type_utilisateur_profil'>Type d'utilisateur</label>
                  <select id='type_utilisateur_profil'>
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
               <?php 
               afficher_select_type($_SESSION['uid']);
               ?>

          </div>

          <!-- Boutons annuler/enregistrer -->
          <div class="row center">
            <div class="">
            <button class="btn green" type="button"  onclick="transfert_coord_perso()">Enregistrer</button>
            </div>
            <div  style="height:15px"></div>
            <div >
            <button class="btn red" type="button"  onclick="location.reload()">Annuler</button>
            </div>
          </div>
        </div>
      </li>
      <!-- ACTIVITE -->
      <li class="act">
        <div class="collapsible-header"><i class="material-icons">directions_bike</i>Activités</div>
        <div class="collapsible-body" style="display: none;">
           <span ng-show="activites.length == 0">Vous n'êtes pas inscrit à une activité, inscrivez-vous depuis <a href="accueil.php">l'accueil</a></span>
           <ul class="collapsible" ng-show="activites.length > 0"data-collapsible="expandable" id="liste_activite">

            <span ng-repeat="activite in activites"></span>


           <!-- Chaque LI représente 1 activité -->
           <li  ng-repeat="activite in activites" id="li_activite">
           <div class="collapsible-header"><i class="material-icons">directions_bike</i>{{activite.Nom_Activite}} {{activite.date_activite}}<i class=" material-icons right " ng-click="annuler_participation(activite)" >cancel</i></div>
           <div class="collapsible-body">
           <input type="hidden" id="id_act_utilisateur" value="{{activite.ID_Eleve_Activite}}"/>
            <div class="row">
                <div class="input-field col s6 l4">
                  <input id="nom_activite" type="text" class="validate" disabled value="{{activite.Nom_Activite}}" format='yyyy-mm-dd' />
                  <label for="nom_activite">Nom de l'activité</label>
                </div>
              </div>
              <div class="row">

                <div class="input-field col s12 l4">
                    <input id="date_act" type="text" value="{{activite.date_activite}}" disabled />
                    <label for="date_act">Date de l'activité</label>
                </div>

                <div class="input-field col s6 l4">
                    <label for="heure_deb">Heure de début</label>
                    <input id="heure_deb"  type="text" value="{{activite.Heure_Debut}}" disabled />
                </div>
                <div class="input-field col s6 l4">
                     <label for="duree">Durée (Minutes)</label>
                  <input type="text" id="duree" name="duree" value="{{activite.Duree}}" disabled />
                 </div>
                </div>
                <div class="row">
                <div class="input-field col s6 l4">
                  <label  for="frais">Frais de l'activité</label>
                  <input type="text" id="frais" name="frais" value="{{activite.Frais}}" disabled />
                </div>
              
                <div class="input-field col s6 l4">
                  <label  for="point">Nombre de points</label>
                  <input type="text" step="0.5" maximum="3" minimum="0" id="point" name="point" value="{{activite.Ponderation}}" disabled />
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12 l12">
                  <input id="endroit" type="text" value="{{activite.Endroit}}" disabled />
                  <label for="endroit">Endroit</label>
                </div>
              </div>
                  
              <div class="row">
                <div class="input-field col s12 l12">
                  <input id="commentaire" type="text" value="{{activite.Commentaire}}" disabled />
                  <label for="commentaire">Commentaire</label>
                </div>
              </div>

           </div>
           </li>           
        </div>
      </li>


      <li class="act" ng-show="activites_responsable.length >= 1">
        <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Activités dont vous êtes responsable</div>
        <div class="collapsible-body" style="display: none;">
           <span ng-show="activites_responsable.length == 0">Vous n'êtes pas inscrit à une activité, inscrivez-vous depuis <a href="accueil.php">l'accueil</a></span>
              <div class="center">
          <h4>Activités Planifiées</h4>
          </div>
             <div class="container">

          <input type="checkbox" checked name="masquerPresence" id="masquerPresence" ng-model="masquerPresence" value="1" class="filtresActivites field filled-in">  
            <label for="masquerPresence" style="margin-top: 10px" >Masquer les activités où les présences ont été prises</label>


            <br><br>  <br>
          </div>

           <ul class="collapsible" ng-show="activites_responsable.length > 0"data-collapsible="expandable" id="liste_activite">

            
          


            <li ng-repeat="activite in activites_responsable" class="coll_act_prev"  ng-show="!(activite.presences_prises > 0 && masquerPresence) && !(toDate(activite[2]) < now && masquerPasse) ">

            <!-- ANGULAR REPEAT -->
            <div class="collapsible-header">
              <i class="material-icons">directions_bike</i>{{activite .Nom_Activite}} le {{activite.Date_Activite}} à {{activite.Heure_debut}} 
                
              <span class=" hide-on-small-only new badge green right" data-badge-caption="">{{getElevesForActivitePrevue(activite.ID_activite_prevue).length}}/{{activite.Participants_Max}}</span>
              <i class=" hide-on-small-only material-icons right" ng-show="activite.presences_prises > 0">playlist_add_check</i>
              <i class=" hide-on-small-only material-icons right" style="pointer-events: visiblePainted !important;" ng-click="show_params(activite)">settings</i>

              
            </div>
            <div class="collapsible-body collapsibleWithButton container">
              <div class="center" >
              
              <i class=" hide-on-med-and-up material-icons " style="margin-right: 30px !important; margin-left: 30px !important" ng-show="activite.presences_prises > 0" >playlist_add_check</i>
              <i class=" hide-on-med-and-up material-icons " style="margin-left: 30px !important; margin-right: 30px !important;" ng-click="show_params(activite)">settings</i><br> <br>  
              <br>
            </div>
              <table>
                <b>Responsable: </b><b style="color: green">Vous êtes le responsable de cette activité</b>
                <br>  
                <b>Frais: </b> {{activite.Frais}}$ <br>  
                <b>Endroit: </b> {{activite.Endroit}} <br>  
                <b>Commentaire: </b>{{activiteFromId(activite.ID_Activite).Commentaire}} <br> 
                <b>Nombre de participants inscrits: </b>{{getElevesForActivitePrevue(activite.ID_activite_prevue).length}}/{{activite.Participants_Max}}
                  <br>
                  
                  <br>  
                    <h5>Liste de présences <span style="color: green; font-size: 0.75em" ng-show="activite.presences_prises > 0"> - Présences prises</span></h5> 
                    <span ng-show="getElevesForActivitePrevue(activite.ID_activite_prevue).length == 0">Aucune inscription pour le moment <br><br></span>
                 <table ng-show="getElevesForActivitePrevue(activite.ID_activite_prevue).length >= 1"> 
                 <thead><th>Nom</th><th class="center">Présent</th>  </thead>
                <tr  ng-repeat="eleve in getElevesForActivitePrevue(activite.ID_activite_prevue)">
                  <td class="col s8">{{eleve.nom}}, {{eleve.prenom}}</td><td class="col s2 center">
                  
                  <input class="field filled-in" ng-checked="{{getPresenceForEleve(activite.ID_activite_prevue, eleve.id_utilisateur)}}" type="checkbox" name="viewid{{activite.ID_activite_prevue}}" value="{{eleve.id_utilisateur}}" disabled readonly
                  id="viewid{{activite.ID_activite_prevue}}-{{eleve.id_utilisateur}}" style="margin-right: 15px; margin-top: 15px">
                  <label for="viewid{{activite.ID_activite_prevue}}-{{eleve.id_utilisateur}}" style="margin-top: 10px" ></label>
                  
                  
                </td>
              </tr>
               </table>   
              
            </table>
            <div style="text-align: center">
              <div class="row" style="margin-bottom: 0px">
                <button type="button" data-target="modalPresence{{activite.ID_activite_prevue}}" class="btn l6 green s12 waves-effect waves-light " style="height: 30px; margin-top: 7px; margin-right: 7px"><span ng-show="activite.presences_prises > 0">Re</span>Prendre les présences</button>
                <button ng-click="annulerActivite(activite.ID_activite_prevue)" type="button" class="btn l6 s12 red waves-effect waves-light " style="height: 30px; margin-top: 7px; margin-right: 7px">Annuler l'activité</button>
              </div>
            </div>
          </div>
           </li>
              
           
        </div>
      </li>

  </div>
      </li>
</ul>
</div>
</li>
</ul>
</div>
<?php
if(($_SESSION['uid'] != 0) and (isset($_SESSION['uid'])))
{
obtenir_info($_SESSION['uid']);
}
?>

</main>
<footer class="page-footer" style="width: 100%!important">

</footer>

 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<!--Import jQuery before materialize.js-->
<script src="js/moment.js">moment.locale="fr"</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/fr-ca.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js"></script>
<script type="text/javascript" src="js/fullcalendar-fr.js"></script>
<script type="text/javascript" src="js/gcal.js"></script>
<script type="text/javascript" src="js/sc-date-time.js"></script>
<script src="js/scripts.js"></script>
<script src="js/inputmask/dist/inputmask/inputmask.js"></script>
<script src="js/inputmask/dist/inputmask/jquery.inputmask.js"></script>
<script src="js/inputmask/dist/inputmask/inputmask.???.Extensions.js"></script>
<script>
	 var selector = document.getElementById("tel");
	 Inputmask({"mask": "(999) 999-9999", showMaskOnHover: false }).mask(selector);
</script>

 <?php include 'js/ScriptsProfil.php'; ?>


 <script>

  $( document ).ready(function() {
    
     $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });

     $('.modal').modal();

});
   
 </script>
<div class="hiddendiv common">
  

</div>

<?php include 'components/modals_admin.php'; ?>



<!-- MODIFIER ACTIVITE -->
<div id="modal_mod_planif" class="modal">
      <div class="modal-content">
      <input type="hidden" id="ID_ACT_PLAN">
       <div class="row" style="text-align:center">
           <h4>Modifier une activité</h4>
       </div>
        <div class="row">
         <div class="input-field col s12">
           <select required id="mod_nom_act" name="nom_act">
           <option value="">Choisir une activité *</option>
           <option ng-repeat="activite in liste_activites" value={{activite.ID_Activite}}>{{activite.Nom_Activite}}, {{activite.Duree}} minutes</option>
           </select>
           <label class="ACTIVER" for="mod_nom_act">Nom de l'activité *</label> 
         </div>
         </div>

          <div class="row">
          <div class="input-field col s12">
           <input id="mod_date_act" type="date" class="datepicker">
           <label  class="ACTIVER" for="mod_date_act">Date de l'activité *</label>
         </div>
         </div>
 
         <div class="row">
           <div class="input-field col s12">
             <label class="ACTIVER" for="mod_heure_deb">Heure de début*</label>
             <input id="mod_heure_deb" class="timepicker" type="time" ng-model="$ctrl.NA">
           </div>
         </div>
 
 
       <div class="row">
         <div class="input-field col s6 l6">
           <label   class="ACTIVER" for="mod_participants_max">Nombre de participants maximum</label>
           <input type="number" step="1" maximum="180" minimum="0" id="mod_participants_max" name="participants_max"/>
         </div>
 
         <div class="input-field col s6 l6">
           <label class="ACTIVER"  for="mod_frais">Frais de l'activité</label>
           <input type="number" step="5" minimum="0" id="mod_frais" name="frais"/>
         </div>
       </div>
 
       <div class="row">
         <div class="input-field col s12 l12">
           <input type="text" id="mod_endroit" class="materialize-textarea"></textarea>
           <label class="ACTIVER" for="mod_endroit">Endroit</label>
         </div>
       </div>

        <div class="row" id="select_responsable">
         <div class="input-field col s12 l12">
              <select id="mod_responsable" name="mod_responsable">
              <option value="null">Choisir un responsable</option>
              <option ng-repeat="admin in comptesAdministrateur" value="{{admin.id_utilisateur}}">{{admin.Nom}}, {{admin.Prenom}}</option>
            </select>
         </div>
       </div>
      
        <div class="row">
         <div class="col s12 l12">
           <button type="button" class="btn green" href="" style="width:100%" ng-click="modifierActivitePrevue()">Enregistrer</button>
         </div>
         <div class="col s12 l12" style="height: 15px;"></div>
         <div class="col s12 l12">
           <button class="btn red"  style="width: 100%" onclick="$('.modal').modal('close');">Annuler</button>
         </div>
     </div>  
 
   </div>
  </div>
 </div>
</body>
</html>


























