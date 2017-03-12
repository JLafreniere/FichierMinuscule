<script>

/*
POST: stat
groupesParEnsemble
utilisateursParType
ratioSexe
nbAvecSansGroupe
utilisateursParEnsemble
participationParActiviteParSession
participationMoyenneParEtudiant
 */


    
    var app = angular.module("app_stats", []);
    app.controller("ctrl", function($scope) {

    $scope.sessions = $scope.sessions = <?php echo phpSelectQuery('select * from sessions order by debut_session ASC')?>;

    $scope.session_selectionnee;
    $scope.session_selectionnee = $scope.sessions[0].nom_session;
    $scope.master_id = $scope.sessions[0].id_session;

    $scope.stats = [
    				{"stat":"groupesParEnsemble", "valeur":"", "label":"Nombre de groupes par ensemble", "yAxis": "Nombre de groupes", "statCompile":{}},
					{"stat":"utilisateursParType", "valeur":"", "label": "Nombre d'utilisateurs par type", "yAxis": "Nombre d'utilisateurs", "statCompile":{}},
					{"stat":"ratioSexe", "valeur":"", "label": "Utilisateurs par sexe", "yAxis":"Nombre d'utilisateurs", "statCompile":{}},
					{"stat":"nbAvecSansGroupe", "valeur":"", "label": "Nombre d'utilisateurs avec et sans groupes", "yAxis":"Nombre d'utilisateurs", "statCompile":{}},
					{"stat":"utilisateursParEnsemble", "valeur":"", "label": "Nombre d'utilisateurs par ensemble", "yAxis":"Nombre d'utilisateurs", "statCompile":{}},
					{"stat":"participationParActiviteParSession", "valeur":"", "label": "Nombre de participations moyenne par activité", "yAxis": "Nombre de participations", "statCompile":{}},
					{"stat":"participationMoyenneParEtudiant", "valeur":"", "label": "Nombre de participations moyenne par étudiant", "yAxis": "Participation moyenne par étudiant", "statCompile":{}
				}];

	$scope.groupesParEnsemble = [];
	

	
	
    let statsGroupesEnsemble = [];

   
  	$( document ).ready(function() {
	 	$('#select_session').material_select();
		$('#select_session').on('change', function() {
	            

	            let x = $('#select_session').val();
	            $scope.master_id= x;
	            
	            $('#select_session').val(x);

	            
	            $scope.session_selectionnee =  $scope.nomSessionFromId(x);
	            
	            
	            $('#select_session').material_select();

	            ajusterSessions()



	    });
	    



	    $('#select_stat').on('change', function() {
	            let x = $('#select_stat').val();
	            $scope.stat_selectionnee = $scope.statsFromVal(x);
	            
	            $('#select_stat').val(x);
	            $('#select_stat').material_select();
	            
	            
	    });




	    ajusterSessions();
	    
	});

  	$scope.statsFromVal = function(statistique){
	return $scope.stats.filter(function (st) {
  		return st.stat == statistique;
		})[0];
	}


    $scope.nomSessionFromId = function(id) {
            let se = $scope.sessions.filter(function(se) {
                return se.id_session == id;
            })[0].nom_session;

            return se;
    }

    function ajusterSessions(){
	    
		
		for(let key in $scope.stats) {
			$.ajax({
	                type: "POST",
	                url: "php_scripts/req_stats.php",
	                data: {
                    'stat':$scope.stats[key].stat,
                    'session': $scope.master_id
                }, //TODO: CHANGE PROF ID
	            success: function(data) {

		            
	            	setValue(data, key);
		            
		         },
		        error: function(req) {
		           alert("erreur");
		         }
		     });

		}
		}
	
	





	function setValue(d, key){
		$scope.stats[key].valeur = JSON.parse(d);
		$scope.$apply();
	}

	$scope.formatSexe = function(sexe){
		if(sexe == 'H')
			return 'Homme';
		else return 'Femme'

	}
	
	














   


	});









</script>
