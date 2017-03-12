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

<html ng-app='app_stats' ng-controller="ctrl">
  <head>
    <?php include 'components/headcontent.php';?>
    <title>Défi Santé - Statistiques</title>
  </head>
  <body class="ng-cloak">
    
    <header>
      <?php include 'components/nav.php';?>
      
    </header>
    <main>

    <script>
      
      
    </script>
    <div class="container row">
      <h4>Statistiques</h4>
	 

  <ul id="tabs-swipe-demo" class="tabs" style="overflow:hidden">
    <li class="tab col s3"><a class="active" href="#statsParSession">Par Session</a></li>
    
  </ul>
  <div id="statsParSession">
  <div id="Stats_Session_Selectionne">
  <div class="center">
	<h4>Statistiques par session</h4></div>
  		 <div class="input-field">
	  <label for="select_session"></label>
      <select name="sel_session" id="select_session">
      <option ng-repeat="session in sessions" class="col s3" value="{{session.id_session}}">{{session.nom_session}}</option>
      </select>
      </div>
      	
		<table class="striped">
			<thead>
			<tr>
			<th style="text-align: center !important" colspan="2"><h5>Statistiques pour la session {{session_selectionnee}}</h5></th></tr>
				<th class="center">Statistique</th>
				<th class="center">Valeur</th>
			</thead>
			<tr>
				<td>
					<b>{{stats[0].label}}</b>
				</td>
				<td>
				<table>
					<tr ng-repeat="x in stats[0].valeur track by $index"><td>Ens. {{x.Ensemble}}:</td><td class="right mr"> {{x.NbGroupe}}</td></tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<b>{{stats[1].label}}</b>
				</td>
				<td>
				<table>
					<tr ng-repeat="x in stats[1].valeur track by $index"><td>{{x.Type}}s</td><td class="right mr">{{x.Nbr}}</td></tr>
					</table>
				</td>
			</tr>



			<tr>
				<td>
					<b>{{stats[2].label}}</b>
				</td>
				<td>
				<table>
					<tr ng-repeat="x in stats[2].valeur track by $index"><td>{{formatSexe(x.sexe)}}</td><td class="right mr">{{x.nbr}}</td></tr>
				</table>
				</td>
			</tr>


			<tr>
				<td>
					<b>{{stats[3].label}} </b>
				</td>
				<td>
				<table>
					<tr>	<td>Utilisateurs avec groupe</td><td class="right mr">{{stats[3].valeur[0].NbGroupe}}</td></tr>
					<tr>    <td>Utilisateurs sans groupes</td><td class="right mr">{{stats[3].valeur[0].NbAutres}}</td></tr>
				</table>												   
				</td>
			</tr>


			<tr>
				<td>
					<b>{{stats[4].label}}</b>
				</td>
				<td>
				<table>
					<tr ng-repeat="x in stats[4].valeur track by $index "><td>Ensemble {{x.Ensemble}}</td><td class="right mr">{{x.Nbr}}</td> </tr>
				</table>
				</td>
			</tr>



			<tr>
				<td><b>
					{{stats[5].label}}
					</b>
				</td>
				<td>
					<table>
					<tr ng-repeat="x in stats[5].valeur track by $index"><td>{{x.nom_activite}}</td><td class="right mr">{{x.nbr_participations}}</td></tr>
					</table>
				</td>
			</tr>


			<tr>
				<td><b>
					{{stats[6].label}}
					</b>
				</td>
				<td>
				<table>
					<tr><td>Nombre de participations</td><td class="right mr"> {{stats[6].valeur[0].participations}}</td>
					<tr><td>Nombre d'élèves inscrits</td><td class="right mr">{{stats[6].valeur[0].nbrEleves}}</td></tr>
					<tr><td>Moyenne</td><td class="right mr">{{stats[6].valeur[0].moyenne}}</td></tr>
					</tr>
					</table>
				</td>
			</tr>
		</table>



      </div>
</div><!--
  <div id="EvolStat"><div class="center">
  	<h4>Évolution d'une statistique</h4>
  </div>

	  		 <div class="input-field">
	  <label for="select_stat"></label>
      <select name="select_stat" id="select_stat">
      <option ng-repeat="stat in stats" class="col s3" value="{{stat.stat}}">{{stat.label}}</option>
      </select>

	<div id="chartContainer">

      </div>
		


	</div>

-->



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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>



<script src="https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/js/materialize.clockpicker.js"></script>

<?php include 'js/scriptsstats.php';


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
