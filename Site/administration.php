<?php  
       if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == '0'){
     header('Location: accueil.php');
    }

}else{ header('Location: accueil.php');};

?>

<html ng-app='app_angular' ng-controller="ctrl">
  <head>
    <?php include 'components/headContent.php';?>
    <title>Défi Santé - Administration</title>
  </head>
  <body class="ng-cloak">
    
    <header>
      <?php include 'components/nav.php';?>
      
    </header>
    <main>

    <script>
      
      
    </script>
    <div class="container">
      <h4>Administration</h4>
      <ul class="collapsible" data-collapsible="expandable">
        <li>
          <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Groupes <span class="new badge blue right" data-badge-caption="">{{groupes.length}}</span></div>
          <div class="collapsible-body" class="collapsibleWithButton" style="padding-bottom: 45px !important">
          <div class="center"><h4>Groupes</h4></div>
          <div class="container">
            <div input-field class="center">
              <input type="checkbox" checked name="masquerGroupes" ng-model="masquerGroupes" id="masquerGroupes" value="1" class="field green filled-in">  
              <label for="masquerGroupes" style="margin-top: 10px" >Masquer les groupes dont je ne suis pas responsable</label>
              <br>
              <div class="row">
              <br><br>
              <b class="center">Limiter à la session</b>
              <select name="select_session" id="select_session" ng-model="SESSION" ng-change="test()">
                <option value="-1" disabled>Veuillez sélectionner une session</option>
                <option value="0" selected>Toutes les sessions</option>
                <option ng-repeat="s in sessions" value="{{s.ID_Session}}">{{s.Nom_Session}}</option>
              </select>
              <br>
              </div>
         
              
              
              
              </div>
              
          </div>

           

            <ul class="collapsible" data-collapsible="expandable" >
              
              <li ng-repeat="groupe in groupes" ng-show="((groupe.id_prof == <?=$_SESSION['uid']?>) || !masquerGroupes) && (groupe.id_session == SESSION || SESSION<=0)"> <!-- ANGULAR REPEAT -->
         

              <span class="hide-on-small-only new badge blue right" style="margin-right: 14px !important" data-badge-caption="">{{elevesDansGroupe(groupe.id_groupe).length}} élève<span ng-show="elevesDansGroupe(groupe.id_groupe).length>1">s</span></span>
              <div class="collapsible-header"><i class="material-icons">supervisor_account</i>{{groupe.nom_groupe}} <span class="hide-on-small-only new badge yellow darken-2 right"  data-badge-caption=""> Ens. {{groupe.ensemble}}</span>
                <span class="right">{{groupe.nom_session}}</span>

                <i class="material-icons right" ng-show="!(groupe.id_prof == <?=$_SESSION['uid']?>)" title="Vous n'êtes pas responsable de ce groupe">lock</i>
              </div>

              <div class="collapsible-body collapsibleWithButton"><div class="container">
              <b>Session: </b>{{groupe.nom_session}} <br>
              <b>Ensemble: </b>{{groupe.ensemble}} <br>
              <b>Professeur responsable: </b>{{eleveFromId(groupe.id_prof).nom}}, {{eleveFromId(groupe.id_prof).prenom}}


              </div>
              <div ng-show="elevesDansGroupe(groupe.id_groupe).length == 0"> 
                <br>  <br>  
                <div class="center">  
                <b>Aucun élève inscrit dans ce groupe pour l'instant  </b>
</div>
              </div>

              <div ng-show="elevesDansGroupe(groupe.id_groupe).length > 0"> 
              <br>  <br>  
              <table class="striped" align="center" ng-show="groupe.ensemble == 1"><!--Ensemble 1 -->
                  <thead><tr><th>Nom </th><th class="center"><span class="hide-on-med-and-up">Pts reg.</span><span class="hide-on-small-only">Points Réguliers</span></th><th class="center"><span class="hide-on-med-and-up">Pts bon.</span><span class="hide-on-small-only">Points Bonus</span></th><th class="center"><span class="hide-on-med-and-up">Pen.</span><span class="hide-on-small-only">Pénalité</span></th><th class="center">Total</th></tr></thead>
                  <tr  ng-repeat="eleve in elevesDansGroupe(groupe.id_groupe)">
                    
                    <td class="">{{eleve.nom}}, {{eleve.prenom}}</td>
                    <td style="text-align: center" class="center">{{pointsReguliersForEleve(eleve.id_utilisateur)}}/5</td><td class="center">{{pointsBonusEnsemble1ForEleve(eleve.id_utilisateur)}}/5</td><td class="center"><span ng-show="penaliteForEleve(eleve.id_utilisateur) > 0" style="color: red">{{penaliteForEleve(eleve.id_utilisateur)}}</span>   </td><td class="center">{{pointsBonusEnsemble1ForEleve(eleve.id_utilisateur)+pointsReguliersForEleve(eleve.id_utilisateur) - penaliteForEleve(eleve.id_utilisateur)}}/10</td>
                    
                  </div>
                </tr>
              </table>

                <table class="striped" align="center" ng-show="groupe.ensemble == 2"><!--Ensemble 2 -->
                  <thead><tr><th>Nom </th><th class="center">Nombre de points</th><th class="center">Pénalité</th><th class="center">Total</th></tr></thead>
                  <tr  ng-repeat="eleve in elevesDansGroupe(groupe.id_groupe)">
                    
                    <td>{{eleve.nom}}, {{eleve.prenom}}</td><td class="center">{{pointsEnsemble2(eleve.id_utilisateur)}}/5</td><td class="center"><span ng-show="penaliteForEleve(eleve.id_utilisateur) > 0" style="color: red">{{penaliteForEleve(eleve.id_utilisateur)}}</span>  </td><td class="center">{{pointsEnsemble2(eleve.id_utilisateur)-penaliteForEleve(eleve.id_utilisateur)}}</td>
                    
                  </div>
                </tr>
              </table>



                <table class="striped" align="center" ng-show="groupe.ensemble == 3"><!--Ensemble 3 -->
                  <thead><tr><th>Nom </th><th class="center"><span class="hide-on-med-and-up">Deb.</span><span class="hide-on-small-only">Début</span></th><th class="center">Fin</th><th class="center"><span class="hide-on-med-and-up">Bon.</span><span class="hide-on-small-only">Bonus</span></th><th class="center"><span class="hide-on-med-and-up">Pen.</span><span class="hide-on-small-only">Pénalité</span></th><th class="center"><span class="hide-on-med-and-up">Total</span><span class="hide-on-small-only">Total</span></th></tr></thead>
                  <tr  ng-repeat="eleve in elevesDansGroupe(groupe.id_groupe)">
                    
                    <td class="">{{eleve.nom}}, {{eleve.prenom}}</td>
                    <td style="text-align: center" class="center">{{pointsDebutForEleve(eleve.id_utilisateur)}}/5</td><td class="center"> {{pointsFinForEleve(eleve.id_utilisateur)}}/5</td><td class="center"> {{pointsBonusForEleve(eleve.id_utilisateur)}}/5</td>
                    <td class="center"><span ng-show="penaliteForEleve(eleve.id_utilisateur) > 0" style="color: red">{{penaliteForEleve(eleve.id_utilisateur)}}</span>  </td>
                    <td class="center">{{pointsDebutForEleve(eleve.id_utilisateur)+pointsFinForEleve(eleve.id_utilisateur)+pointsBonusForEleve(eleve.id_utilisateur)}}/15</td>
                    
                  </div>
                </tr>
              </table>
              </div>
              <div class="container">
              <div class="row" style="text-align: center">
              
              <button data-target="modalGenGroupe" ng-click="setGroupe(groupe.id_groupe)" ng-show="(groupe.id_prof == <?=$_SESSION['uid']?>)" style="margin-bottom: 15px !important; margin-top: 30px !important" class=" green btn" >Générer des codes d'accès</button></div>
              <div class="row"  style="text-align: center">
                <button ng-click="setGroupe(groupe.id_groupe)" data-target="modalGroupe" ng-show="(groupe.id_prof == <?=$_SESSION['uid']?>)" style="margin-bottom: 15px !important" class="btn  green modal-trigger">Afficher les codes d'accès</button>
              </div>
              <div class="row"  style="text-align: center">
                <button data-target="modalPromotion" onclick="" ng-click="setPromotionId(groupe.id_groupe)" style="margin-bottom: 15px !important" class="btn green modal-trigger">Promouvoir</button>
              </div>
              <div class="row"  style="text-align: center">
                <button ng-click="supprimerGroupe(groupe.id_groupe, groupe.nom_groupe)" ng-show="(groupe.id_prof == <?=$_SESSION['uid']?>)" style="margin-bottom: 15px !important" class="btn red modal-trigger">Supprimer le groupe</button>
              </div>
          </div>
            </div>
            
          </li>
        </ul>
        <br>
        <div class="center">
        <button data-target="modalNouveauGroupe" style="margin-bottom: 0px !important" class="btn green">Nouveau Groupe</button>
        </div>
        <br>

          <ul class="collapsible" data-collapsible="expandable" >
              
              <li> <!-- SANS GROUPE -->
              <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Utilisateurs sans groupes
                
                <span class="new badge blue right hide-on-small-only" data-badge-caption="">{{utilisateursSansGroupes.length}} Utilisateur<span ng-show="utilisateursSansGroupes.length>1">s</span></span>
              </div>
              <div class="collapsible-body collapsibleWithButton">
              
                <div ng-show="utilisateursSansGroupes.length == 0"> 
                <br>  
                <div class="center">  
                <b>Aucun élève sans groupe inscrit pour l'instant</b>
                </div>
                </div>


              <table class="striped" align="center" ng-show="utilisateursSansGroupes.length > 0">
              <thead> <th>Utilisateurs</th></thead>
                    <tr ng-repeat="eleve in utilisateursSansGroupes"><td> {{eleve.Nom}}, {{eleve.Prenom}}</td></tr>
              </table>
              <div class="container">

                                 <div class="row" style="text-align: center">
              <button data-target="modalGenGroupe0" ng-click="setGroupe(0)" style="margin-bottom: 15px !important; margin-top: 30px !important" class="btn green" >Générer des codes d'accès</button></div>
              <div class="row"  style="text-align: center">
                <button data-target="modalGroupe0" style="margin-bottom: 15px !important" class="btn green modal-trigger">Afficher les codes d'accès</button>
              </div>
              <div class="row"  style="text-align: center">
                <button data-target="modalPromotion" ng-click="setPromotionId(0)" style="margin-bottom: 15px !important" class="btn green modal-trigger">Promouvoir</button>
              </div>

              </div>
</div>
            
               </li>
          </ul>
          <br>
      
      </div>
      
      <li>
        <div class="collapsible-header"><i class="material-icons">directions_bike</i>Activités Prévues<span class="new badge green right" data-badge-caption="">{{activites_prevues.length}}</span></div>
        
        <div class="collapsible-body">
          <div class="center">
          <h4>Activités Planifiées</h4>
          </div>
          <div class="container">
          <input type="checkbox" checked name="masquerPasse" ng-model="masquerPasse" id="masquerPasse" value="1" class="filtresActivites field filled-in">  
            <label for="masquerPasse" style="margin-top: 10px" >Masquer les activités passées</label>
          <br>

          <input type="checkbox" checked name="masquerPresence" id="masquerPresence" ng-model="masquerPresence" value="1" class="filtresActivites field filled-in">  
            <label for="masquerPresence" style="margin-top: 10px" >Masquer les activités où les présences ont été prises</label>


            <br><br>  <br>
          </div>
          <ul ng-show="activites_prevues.length > 0" class="collapsible" data-collapsible="expandable">
            <li ng-repeat="activite in activites_prevues" class="coll_act_prev" ng-show="!(activite.presences_prises > 0 && masquerPresence) && !(toDate(activite.Date_Activite) < now && masquerPasse) ">
            <!-- ANGULAR REPEAT -->
            <div class="collapsible-header">
              <i class="material-icons">directions_bike</i>{{activiteFromId(activite.ID_Activite).Nom_Activite}} le {{activite.Date_Activite}} à {{formatHeure(activite.Heure_debut)}}
                
              <span class=" hide-on-small-only new badge green right" data-badge-caption="">{{getElevesForActivitePrevue(activite.ID_activite_prevue).length}}/{{activite.Participants_Max}}</span>
              <i class=" hide-on-small-only material-icons right" ng-show="activite.presences_prises > 0">playlist_add_check</i>
              <i class=" hide-on-small-only material-icons right" style="pointer-events: visiblePainted !important;" ng-click="show_params(activite)">settings</i>

              
            </div>
            <div class="collapsible-body collapsibleWithButton ">
              <div class="center" >
              
              <i class=" hide-on-med-and-up material-icons " ng-show="activite.presences_prises > 0" >playlist_add_check</i><br>
              <br> <br>  
              <br>
            </div>
            <div class="container">
              <table>
                <b>Responsable: </b>{{eleveFromId(activite.responsable).nom}}, {{eleveFromId(activite.responsable).prenom}}
                <br>  
                <b>Frais: </b> {{activite.Frais}}$ <br>  
                <b>Pondération: </b> {{activiteFromId(activite.ID_Activite).Ponderation}} point<span ng-show="activiteFromId(activite.ID_Activite).Ponderation > 1">s</span><br> 
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
</div>
            <div style="text-align: center">
              
              <button type="button" class="btn green waves-effect waves-light" style="height: 30px !important" ng-click="show_params(activite)">Modifier</button><br>
                <button type="button" ng-click="setActSelectionne(activite.ID_activite_prevue)" data-target="modalPresence" class="btn green waves-effect waves-light " style="height: 30px;"><span ng-show="activite.presences_prises > 0">Re</span>Prendre les présences</button><br>
                <button ng-click="annulerActivite(activite.ID_activite_prevue)" type="button" class="btn red waves-effect waves-light " style="height: 30px;">Annuler l'activité</button>
              
            </div>
          </div>
          
        </li>
      </ul>
    <div class="center">
    <br>
      <a class="waves-effect green waves-light btn" data-target="modal_planif" style="margin-top: 0px;">Planifier une activité</a></div>
      <br>
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
                <span class="new badge blue right" data-badge-caption="">{{comptesAdmin().length}}</span>
            </div>
            <div class="collapsible-body collapsibleWithButton container">
              
              <table class="striped">
              <thead><th class="center">Compte</th><th class="center">Niveau</th></thead>
            
              <tr ng-repeat="admin in comptesAdmin()"><td>{{admin.nom}}, {{admin.prenom}}</td><td class="center">{{adminLevelFromID(admin.administrateur)}}</td><td class="center"><button type="button" class="hide-on-small-only btn green small" ng-click="ouvrirModalModifierPermission(admin.id_utilisateur, admin.administrateur)" style="margin-top: 0px !important"><span class="">Permissions</span></button><i ng-click="ouvrirModalModifierPermission(admin.id_utilisateur, admin.administrateur)" class="hide-on-med-and-up material-icons">settings</i></td></tr>
                </table>
                <div class="center">
              <div class="row center">
              <a class="waves-effect waves-light btn green" style="margin-top: 15px;" data-target="modalCodeAdmin">Générer des codes d'accès</a></div>
              <div class="row">
            <a class="waves-effect waves-light btn green" style="margin-top: 15px;" type="button" data-target="modalAfficherCodeAdmin" onclick="$('#modalAfficherCodeAdmin').modal('open')">Afficher les codes d'accès</a></div>


              
              
              </div>
             </div>
            </li>

            <li> <!-- ANGULAR REPEAT -->
            <div class="collapsible-header">
              <i class="material-icons">explore</i>
              Activités
                <span class="new badge green right" data-badge-caption="">{{activites.length}}</span>
            </div>
            <div class="collapsible-body collapsibleWithButton container">
              
              
                <table class="striped">
                <thead>
                  <th class="center">Activités Disponibles</th><th class="center hide-on-med-and-down">Durée (Minutes)</th><th class="center hide-on-med-and-down">Pondération</th><th></th>
                </thead>                
                <tr ng-repeat="activite in activites">
                  <td class="center">{{activite.Nom_Activite}}</td>
                  <td class="center hide-on-med-and-down">{{activite.Duree}}</td>
                  <td class="center hide-on-med-and-down">{{activite.Ponderation}} point<span ng-show="activite.Ponderation>1">s</span></td> 
                  <td class="center"><a class="btn-floating  waves-effect waves-light green" ng-click="modifierActivite(activite)"><i class="material-icons">edit</i></a></td>
                  <td class="center"><a class="btn-floating  waves-effect waves-light red" ng-click="supprimerActivite(activite.ID_Activite)"><i class="material-icons">delete</i></a></td>
                </tr>
  

                </table>




              
              
              <row>
              <br><br>
              <div style="text-align: center">
              <button type="button"  class="btn l5 waves-effect waves-light green"  data-target="modal_new_activite" style="height: 30px; margin-top: 7px; margin-right: 7px">Ajouter une activité</button>
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
              
              <table class="striped"><thead><th>Nom de la session</th><th class="hide-on-med-and-down">Début</th>
              <th class="hide-on-med-and-down">Mi-Session</th>
              <th class="hide-on-med-and-down">Fin</th><th></th></thead>
              <tr ng-repeat="session in sessions"><td>{{session.Nom_Session}}</td><td class="hide-on-med-and-down">{{session.Debut_Session}}</td><td class="hide-on-med-and-down">{{session.Mi_Session}}</td><td class="hide-on-med-and-down">{{session.Fin_Session}}</td><td><a class="btn-floating waves-effect waves-light green " ng-click="modifierSession(session)"><i class="material-icons">edit</i></a></td><td><a class="btn-floating waves-effect waves-light blue " ng-click="afficherStats(session.ID_Session)"><i class="material-icons">assessment</i></a></td>
              </tr>
              </table>
              <br>
              
              <div class="center">
              <button type="button"  class="green btn l6 s12 waves-effect waves-light " data-target="modal_session" style="height: 30px; margin-top: 7px; margin-right: 7px">Ajouter une session</button>
              </div>

              </row>
             </div>
            </li>



      </ul>
      </div>

      </li>    
  </ul>
  
</div>


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
           <option ng-repeat="activite in activites" value={{activite.ID_Activite}}>{{activite.Nom_Activite}}, {{activite.Duree}} minutes</option>
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
           <input type="number" step="1"  min="0" max="180" id="mod_participants_max" name="participants_max"/>
         </div>
 
         <div class="input-field col s6 l6">
           <label class="ACTIVER"  for="mod_frais">Frais de l'activité</label>
           <input type="number" step="5" min="0" id="mod_frais" name="frais"/>
         </div>
       </div>
 
       <div class="row">
         <div class="input-field col s12 l12">
           <input type="text" id="mod_endroit" class="materialize-textarea"></textarea>
           <label class="ACTIVER" for="mod_endroit">Endroit</label>
         </div>
       </div>

        <div class="row" id="">
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

<?php include 'js/ScriptsAdmin.php';

include 'components/modals_admin.php';
?>








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
 

  $(document).ready(function(){
  $('.slider').slider();
 });
 
$('#date_act').pickadate();
$('#mod_date_act').pickadate();
$('input[type="date"]').pickadate();

$("select").material_select();

$(".session:last").attr("checked", true);
    $('#select_session').val(0);    
   $('#select_session').material_select();   

});


 



</script>
<div class="hiddendiv common"></div>

</body></html>
