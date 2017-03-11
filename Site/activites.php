<html ng-app='app_angular' ng-controller="ctrl">
  <head>
    <?php include 'components/headcontent.php';?>
      <meta charset="UTF-8">
      <title>Défi Santé - Activités</title>
  </head>
  <body>
    
    <header>
      <?php include 'components/nav.php';?>
      
    </header>
    <main>
    <div class="container">
      <h4>Administration</h4>
      <ul class="collapsible" data-collapsible="expandable">
        <li>
          <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Groupes <span class="new badge blue right" data-badge-caption="">{{groupes.length}}</span></div>
          <div class="collapsible-body" class="collapsibleWithButton" style="padding-bottom: 45px !important">
            
            <ul class="collapsible" data-collapsible="expandable" >
              
              <li ng-repeat="groupe in groupes"> <!-- ANGULAR REPEAT -->
              <div class="collapsible-header"><i class="material-icons">supervisor_account</i>{{groupe.nom_groupe}}
                <span class="new badge blue right" data-badge-caption="">{{elevesDansGroupe(groupe.id_groupe).length}} élève<span ng-show="elevesDansGroupe(groupe.id_groupe).length>1">s</span></span>
              </div>
              <div class="collapsible-body collapsibleWithButton">
                <table class="striped" align="center">
                  <thead><tr><td>Nom</td><td class="center">Points accumulés</td></tr></thead>
                  <tr  ng-repeat="eleve in elevesDansGroupe(groupe.id_groupe)">
                    
                    <td class="">{{eleve.nom}}, {{eleve.prenom}}</td>
                    <td style="text-align: center" class="center">{{}}/15</td>
                    
                  </div>
                </tr>
              </table>
              <div class="row" style="text-align: center">
              <button data-target="modalGenGroupe{{groupe.id_groupe}}" style="margin-bottom: 15px !important; margin-top: 30px !important" class="btn" >Générer des codes d'accès</button></div>
              <div class="row"  style="text-align: center">
                <button data-target="modalGroupe{{groupe.id_groupe}}" style="margin-bottom: 15px !important" class="btn  modal-trigger">Afficher les codes d'accès</button>
              </div>
              <div class="row"  style="text-align: center">
                <button ng-click="supprimerGroupe(groupe.id_groupe, groupe.nom_groupe)" style="margin-bottom: 15px !important" class="btn red modal-trigger">Supprimer le groupe</button>
              </div>
            </div>
            
          </li>
        </ul>


          <ul class="collapsible" data-collapsible="expandable" >
              
              <li> <!-- SANS GROUPE -->
              <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Utilisateurs sans groupes
                <span class="new badge blue right" data-badge-caption="">{{utilisateursSansGroupes.length}} Utilisateur<span ng-show="utilisateursSansGroupes.length>1">s</span></span>
              </div>
              <div class="collapsible-body collapsibleWithButton">
                    <div ng-repeat="eleve in utilisateursSansGroupes">{{eleve.Nom}}, {{eleve.Prenom}}</div>

                                 <div class="row" style="text-align: center">
              <button data-target="modalGenGroupe0" style="margin-bottom: 15px !important; margin-top: 30px !important" class="btn" >Générer des codes d'accès</button></div>
              <div class="row"  style="text-align: center">
                <button data-target="modalGroupe0" style="margin-bottom: 15px !important" class="btn  modal-trigger">Afficher les codes d'accès</button>
              </div>

              </div>

            
               </li>
          </ul>

        <button data-target="modalNouveauGroupe" style="margin-bottom: 0px !important" class="btn right">Nouveau Groupe</button>
      </div>
      
      <li>
        <div class="collapsible-header"><i class="material-icons">directions_bike</i>Activités <span class="new badge green right" data-badge-caption="">{{activites_prevues.length}}</span></div>
        
        <div class="collapsible-body">
          
          <ul class="collapsible" data-collapsible="expandable">
            
            
            <li ng-repeat="activite in activites_prevues"> <!-- ANGULAR REPEAT -->
            <div class="collapsible-header">
              <i class="material-icons">directions_bike</i>{{nomActiviteFromId(activite.ID_Activite)}} le {{activite.Date_Activite}} à {{activite.Heure_debut}}
              <span class="new badge green right" data-badge-caption="">{{getElevesForActivitePrevue(activite.ID_activite_prevue).length}}/{{activite.Participants_Max}}</span>
            </div>
            <div class="collapsible-body collapsibleWithButton container">
              
              <table>
                <div class="row" ng-repeat="eleve in getElevesForActivitePrevue(activite.ID_activite_prevue)">
                  <div class="col s8">{{eleve.nom}}, {{eleve.prenom}}</div><div class="col s2">
                  
                  <input class="field filled-in" ng-checked="{{getPresenceForEleve(activite.ID_activite_prevue, eleve.id_utilisateur)}}" type="checkbox" name="viewid{{activite.ID_activite_prevue}}" value="{{eleve.id_utilisateur}}" disabled readonly
                  id="viewid{{activite.ID_activite_prevue}}-{{eleve.id_utilisateur}}" style="margin-right: 15px; margin-top: 15px">
                  <label for="viewid{{activite.ID_activite_prevue}}-{{eleve.id_utilisateur}}" style="margin-top: 10px" ></label>
                  
                  
                </div>
              </div>
              
            </table>
            <div style="text-align: center">
              <div class="row" style="margin-bottom: 0px">
                <button type="button" data-target="modalPresence{{activite.ID_activite_prevue}}" class="btn l6 s12 waves-effect waves-light " style="height: 30px; margin-top: 7px; margin-right: 7px">Prendre les présences</button>
                <button ng-click="annulerActivite(activite.ID_activite_prevue)" type="button" class="btn l6 s12 red waves-effect waves-light " style="height: 30px; margin-top: 7px; margin-right: 7px">Annuler l'activité</button>
              </div>
            </div>
          </div>
          
        </li>
      </ul>
  
      <a class="waves-effect waves-light btn right" data-target="modal_planif" style="margin-top: 0px;">Planifier une activité</a>
      <div style="margin-bottom: 40px"></div>
      </div></li>
    

  <!-- ADMINISTRATION -->


 
      <li>
        <div class="collapsible-header"><i class="material-icons">settings</i>Paramètres administratifs</div>
        
        <div class="collapsible-body">
          
          <ul class="collapsible" data-collapsible="expandable">
            
            
            <li> <!-- ANGULAR REPEAT -->
            <div class="collapsible-header">
              <i class="material-icons">supervisor_account</i>
              Comptes Administrateurs
                <span class="new badge green right" data-badge-caption="">{{comptesAdmin().length}}</span>
            </div>
            <div class="collapsible-body collapsibleWithButton container">
              
              <ul>
              <li ng-repeat="admin in comptesAdmin()">{{admin.nom}}, {{admin.prenom}}</li>
              </ul>
              <row>
              <button type="button" data-target="modalCodeAdmin" class="btn l6 s12 waves-effect waves-light " style="height: 30px; margin-top: 7px; margin-right: 7px">Générer des codes d'accès</button>
              <button type="button" data-target="modalAfficherCodeAdmin" onclick="$('#modalAfficherCodeAdmin').modal('open')" class="btn l6 s12 waves-effect waves-light " style="height: 30px; margin-top: 7px; margin-right: 7px">Afficher les codes d'accès</button>
              </row>
             </div>
            </li>

            <li> <!-- ANGULAR REPEAT -->
            <div class="collapsible-header">
              <i class="material-icons">explore</i>
              Activités
                <span class="new badge green right" data-badge-caption="">{{activites.length}}</span>
            </div>
            <div class="collapsible-body collapsibleWithButton container">
              
              
                <table class="">
                <thead>
                  <th class="center">Activité</th><th class="center">Durée (Minutes)</th><th class="center">Pondération</th>
                </thead>                
                <tr ng-repeat="activite in activites">
                  <td class="center">{{activite.Nom_Activite}}</td>
                  <td class="center">{{activite.Duree}}</td>
                  <td class="center">{{activite.Ponderation}}</td>
                </tr>
  

                </table>




              
              
              <row>
              <br><br>
              <div style="text-align: center">
              <button type="button"  class="btn l6 s12 waves-effect waves-light"  data-target="modal_new_activite" style="height: 30px; margin-top: 7px; margin-right: 7px">Ajouter une activité</button>
              </div>
              </row>
              
             </div>
            </li>


            <li> <!-- SESSIONS REPEAT -->
            <div class="collapsible-header">
              <i class="material-icons">date_range</i>
              Sessions
                
            </div>
            <div class="collapsible-body collapsibleWithButton container">
              
              <table><thead><th>Nom de la session</th><th>Début</th>
              <th>Mi-Session</th>
              <th>Fin</th></thead>
              <tr ng-repeat="session in sessions"><td>{{session.Nom_Session}}</td><td>{{session.Debut_Session}}</td><td>{{session.Mi_Session}}</td><td>{{session.Fin_Session}}</td>
              </tr>
              </table>
              
              
              
              <button type="button"  class="btn l6 s12 waves-effect waves-light " data-target="modal_session" style="height: 30px; margin-top: 7px; margin-right: 7px">Ajouter une session</button>
              


<a class="waves-effect waves-light btn" href="#modal_ins">ins</a>



<a class="waves-effect waves-light btn" href="#modal_login">Login</a>

<a class="waves-effect waves-light btn" href="#modal_code">code</a>




              </row>
             </div>
            </li>



      </ul>
      </div>

      </li>    
  </ul>
  
</div>














<?php

include 'components/modals_admin.php';

if (isset($_SESSION['admin']))
echo ' <script>window.onload = function(){ if('.$_SESSION['admin'].'){$(".adminTabs").remove()}}</script>';
//INVERSE
?>
</div>



</main>
<footer class="page-footer" style="width: 100%!important">

</footer>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="js/moment.js">moment.locale="fr"</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/fr-ca.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js"></script>
<script type="text/javascript" src="js/fullcalendar-fr.js"></script>
<script type="text/javascript" src="js/gcal.js"></script>
<script type="text/javascript" src="js/sc-date-time.js"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/js/materialize.clockpicker.js"></script>

<?php include 'js/ScriptsAdmin.php';?>








<script>

$(document).ready(function(){
// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
$('.modal').modal();
$('.timepicker').pickatime({
    default: 'now',
    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    donetext: 'OK',
  autoclose: false,
  vibrate: true // vibrate the device when dragging clock hand
});




});



</script>
<div class="hiddendiv common"></div>

</body></html>

