<?php  
       if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
?>

<html ng-app='empty_app' ng-controller="ctrl">
  <head>
    <?php include_once 'components/headcontent.php';?>
    <style>
    .remove_margin_bottom{
        margin-bottom: 0px !important;
    }
   .fc-content {display:flex;flex-flow:column-reverse nowrap;}
    </style>
    <title>Défi Santé - Accueil</title>
    
  </head>
  <body>
    
    <header>
      <?php include 'components/nav.php';?>
      
    </header>
    <main>



          <?php 
    include_once 'php_scripts/connexion_bd.php';
     $mysqli = connexion();  
     $conn = connexion();
          include_once('components/carousel_accueil.php'); 
          if(isset($_SESSION['uid']) && $_SESSION['uid'] !=0){
                if(isset($_POST['SubInsAct'])){
                    // Create connection
                      
                      // Check connection
                      if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                      } 
                      $insert = true;
                      $query = "SELECT ap.id_activite_prevue
                              FROM  activites_prevues ap, utilisateur_activites ua 
                              where ap.id_activite_prevue = ua.id_activite_prevue
                              and ap.id_activite_prevue = ".$_POST['id_activite']." 
                              and ua.id_utilisateur = ".$_SESSION['uid'];
                    $result = $mysqli->query($query);
                    if ($result->num_rows > 0) {
                        $i = 1;
                                $insert = false;
                            }
                            
                        
                      $query = "SELECT ap.id_activite_prevue, count(ua.id_eleve_activite) as participant, ap.participants_max
                              FROM activites a, activites_prevues ap 
                              left join utilisateur_activites ua on ua.id_activite_prevue = ap.id_activite_prevue
                              where a.id_Activite = ap.id_activite
                              and ap.id_activite_prevue = ".$_POST['id_activite']."
                              group by ap.id_activite_prevue";
                    $result = $mysqli->query($query);
                    if ($result->num_rows > 0) {
                        $i = 1;
                        
                        while($row = $result->fetch_assoc()) {
                            if($row['participants_max'] != 0 and $row['participant']>=$row['participants_max']){
                                $insert = false;
                                break;
                            }
                            }
                        }
                    
                  if($insert){
                      $sql = "INSERT INTO utilisateur_activites (id_utilisateur,id_activite_prevue,present)
                      VALUES (".$_SESSION['uid'].",".$_POST['id_activite'].",0)";
                  
                      if ($conn->query($sql) === TRUE) {
                          echo "<script>
                              alert('Inscription à l\'activité réussie');
                          </script>";
                      } else {
                          echo "Error: " . $sql . "<br>" . $conn->error;
                      }
                  
                      $conn->close();
                }
          }else if(isset($_POST['Sub_liste_attente'])){
              $sql = "INSERT INTO utilisateur_activites (id_utilisateur,id_activite_prevue,present)
                      VALUES (".$_SESSION['uid'].",".$_POST['id_activite'].",2)";
                  
                      if ($conn->query($sql) === TRUE) {
                          echo "<script>
                              alert('Vous êtes inscrit sur la liste d'attente);
                          </script>";
                      } else {
                          echo "Error: " . $sql . "<br>" . $conn->error;
                      }
                  
                      $conn->close();
          }
          }
          ?>
          <div class="container">
  <div class="row">


  <div class="input-field col s12">

<div class="row">
  <div class="input-field col s12">
    <select onchange="TrieCalendrier(this.value)">
      <option value="" disabled selected>Choisissez une activité</option>
      <option value="n">Tout les sports</option>
      <?php
            
                    if ($mysqli->connect_errno) {
                        echo "Erreur de connexion vers MYSQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                    }
                    $query = "SELECT distinct nom_activite FROM activites";
                    $result = $mysqli->query($query);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='".$row['nom_activite']."'>".$row['nom_activite']."</option>";
                        }
                    }
      ?>
      
    </select>
    <label>Activité</label>
  </div>
  <div id="calendar"></div>

  </form>
</div>


 <div id="modalinsact" class="modal" >     
    <div class="modal-content">
        <form id="inscAct" method="POST" action="" hidden>
              <input type="text" class="remove_margin_bottom" id="id_act" name="id_activite" value="">
        </form>  
        <div class="row">
          <h3 id="titre" style="margin-bottom:0px;text-align:center;"></h3>
        </div>
        <div class="row">
            <div class="col l4" style="margin-top:14px;text-align:right">
                Date:
            </div>
            <div class="input-field col l8" style="margin-top:0px;">
                <input type="date"  class="remove_margin_bottom"  id="date"  readonly>
            </div>  
        </div>
        <div class="row">
            <div class="col l4" style="margin-top:14px;text-align:right">
                Début:
            </div>
            <div class="input-field col l8" style="margin-top:0px;">
                <input type="time"  class="remove_margin_bottom"  id="debut"  readonly>
            </div>  
        </div>
        <div class="row">
            <div class="col l4" style="margin-top:14px;text-align:right">
                Fin:
            </div>
            <div class="input-field col l8" style="margin-top:0px;">
                <input type="time"  class="remove_margin_bottom"  id="fin"  readonly>
            </div> 
        </div>
        <div class="row">
            <div class="col l4" style="margin-top:14px;text-align:right">
                Endroit:
            </div>
            <div class="input-field col l8" style="margin-top:0px;">
                <input type="text"  class="remove_margin_bottom"  id="endroit" value=""  readonly>
            </div> 
        </div>
        <div class="row" id="divSub">
            <?php
                    //vérification pour voir s'il est déja inscrit'
                   
                    if ($mysqli->connect_errno) {
                        echo "Erreur de connection vers MYSQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                    }
                    $query = "SELECT ap.id_activite_prevue, ap.date_activite, ap.heure_debut, a.duree 
                              FROM activites_prevues ap, activites a, utilisateur_activites ua
                              where ua.id_utilisateur = ".$_SESSION['uid']." 
                               and ap.id_activite = a.id_activite
                               and ua.id_activite_prevue = ap.id_activite_prevue";
                    $result = $mysqli->query($query);
                    echo "<script>activite_inscrit = [";
                    if ($result->num_rows > 0) {
                        $i = 1;
                        
                        while($row = $result->fetch_assoc()) {
                            
                            echo "[".$row['id_activite_prevue'].",'".$row['date_activite']."','".$row['heure_debut']."',".$row['duree']."]";
                            if ($result->num_rows > $i) {
                                echo ",";
                            }
                        }
                    }
                    echo "];
                    </script>";
                    
           
            ?>
        </div>
    </div>
    
     </div>
</main>

        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.js"></script>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <script src="js/moment.js">moment.locale="fr"</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js"></script>
    <script type="text/javascript" src="js/fullcalendar-fr.js"></script>
    <script type="text/javascript" src="js/gcal.js"></script>
    <script type="text/javascript" src="js/sc-date-time.js"></script>
        
<script>
        function daysInMonth(month,year) {
            return new Date(year, month, 0).getDate();
        }
        function pad(x){
            if(x< 10){
                x= "0"+x;
            }
            return x;
        }
        function ajout_jour_date_string(str,add){
            var date;
            var y = Number(str.substring(0,4));
            var m = Number(str.substring(5,7));
            var d = Number(str.substring(8,10)) + add;
            /*var h = Number(str.substring(11,13));
            var min = Number(str.substring(14,16));
            var s = Number(str.substring(17,19));*/
            
            if( d > daysInMonth(m,y)){
                m= m + Math.floor(d/daysInMonth(m,y));
                d = d - daysInMonth(m-1,y);
                if(m > 12){
                    m= m + Math.floor(m/12)
                    y=y+1;
                }
            }
            date = y+"/"+pad(m)+"/"+pad(d)/*+"T"+pad(h)+":"+pad(min)+":"+pad(s)*/
            return date;
        }
        
        function ajout_jour_Ajd(add){
            //ajoute un nombre de jour à la date du jour
         /*
         var x = v.getFullYear() + "/" + pad((v.getMonth()+1)) + "/"+pad(v.getDate()) + 
         "T" + pad(v.getHours()) + ":" + pad(v.getMinutes()) + ":"+ pad(v.getSeconds());
         */
            v = new Date();
            var date;
            var y = v.getFullYear();
            var m = v.getMonth()+1;
            var d = v.getDate() + add;
            /*var h = v.getHours();
            var min = v.getMinutes();
            var s = v.getSeconds();*/
            
            if( d > daysInMonth(m,y)){
                m= m + Math.floor(d/daysInMonth(m,y));
                d = d - daysInMonth(m-1,y);
                if(m > 12){
                    m= m + Math.floor(m/12)
                    y=y+1;
                }
            }
            date = y+"/"+pad(m)+"/"+pad(d)/*+"T"+pad(h)+":"+pad(min)+":"+pad(s)*/
            return date;
        }
        //initialisation du tableau de base des evenements du calendrier
    var view;
        eventbase = [
                    <?php
                   
                    if ($mysqli->connect_errno) {
                        echo "Erreur de connection vers MYSQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                    }
                    $query = "SELECT ap.id_activite_prevue, a.couleur, a.nom_activite, ap.date_activite, ap.heure_debut, a.duree, count(ua.id_eleve_activite) as participant, ap.participants_max, ap.endroit
                              FROM activites a, activites_prevues ap 
                              left join utilisateur_activites ua on ua.id_activite_prevue = ap.id_activite_prevue
                              where a.id_activite = ap.id_activite
                              group by ap.id_activite_prevue";
                    $result = $mysqli->query($query);
                    if ($result->num_rows > 0) {
                        $i = 1;
    
                        while($row = $result->fetch_assoc()) {
                            $timestamp = strtotime($row['heure_debut']) + $row['duree']*60;
                            $time = date('H:i:i', $timestamp);
                            
                            echo "{ title:'".$row['nom_activite']."', start:'".$row['date_activite']."T".$row['heure_debut']."', end:'".$row['date_activite']."T".$time."', allday: false,  id:".$row['id_activite_prevue'].", backgroundColor:'#".$row['couleur']."', borderColor:'black', participant:".$row['participant'].", participant_max:".$row['participants_max'].", Endroit:'".$row['endroit']."' }";
                            if ($result->num_rows > $i) {
                                echo ",";
                            }
                        }
                    }
                    ?>
                    ];
                    evenements = eventbase;
    function TrieCalendrier(s){
        view = $('#calendar').fullCalendar('getView');
        event_trie = [];
        if(s != "n"){
            for(i = 0;i<eventbase.length;i++){
                if(eventbase[i]['title'] == s){
                    event_trie.push(eventbase[i]);
                }
            }
            evenements = event_trie;
        }else if(s == "n"){
             evenements=eventbase;
        }
            
        //appel de l'initialisation du calendrier
        $('#calendar').fullCalendar('destroy');
        inicalendrier();
        }
        //initialisation du calendrier
        function inicalendrier() {
            
            $('#calendar').fullCalendar({
                header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
                slotEventOverlap: false,
                allDaySlot: false,
                events: evenements,
                timeFormat: 'H:mm',
                eventLimit: true,  
                eventLimitText: "Activité",
                eventClick: function(event) {
                    var inscrit = false;
                    var conflit = false;
                    var retard = false;
                    var trop_tot = false;
                    
                    
                    var date = event.start.toISOString().substring(0,event.start.toISOString().indexOf("T")).replace(new RegExp('/', 'g'), '-');
                    
                    var temps = event.start.toISOString().substring(event.start.toISOString().indexOf("T")+1,19);
                   
                    
                    
                    
                    $('#modalinsact').modal('open');
                    $('#id_act').attr({
                        value: event.id
                    });
                    $('#titre').text(event.title);
                    
                    $('#date').attr({
                        value: date
                    });
                    
                    $('#debut').attr({
                        value:temps
                    });
                    
                    $('#fin').attr({
                        value:event.end.toISOString().substring(event.start.toISOString().indexOf("T")+1,16)
                    });
                    $('#endroit').attr({
                        value:event.Endroit
                    });
                    var v = new Date();
                    var x = v.getFullYear() + "-" + pad((v.getMonth()+1)) + "-"+pad(v.getDate()) + "T" + pad(v.getHours()) + ":" + pad(v.getMinutes()) + ":"+ pad(v.getSeconds());
                    if(x > event.end.toISOString() ){
                        retard = true;
                    }
                    
                    if(ajout_jour_date_string(event.start.toISOString(),0) > ajout_jour_Ajd(14)){
                        trop_tot = true;
                    }
                    for(i=0;i<activite_inscrit.length;i++){
                            
                            if(event.id == activite_inscrit[i][0]){
                                inscrit = true;
                                break;
                            }
                            
                            if(activite_inscrit[i][1] == date ){                               
                                var debut = activite_inscrit[i][2];
                                var fin = addMinutes(activite_inscrit[i][2],activite_inscrit[i][3]);                             
                                if(debut <= temps && fin >=temps ){
                                    conflit = true;
                                    break;
                                }
                            }
                            
                    }
                    var con = 
                    <?php
                    $x = ($_SESSION['uid'] != 0) ? 'true' : 'false';
                    echo $x;
                    ?>;
                    if(con){
        
                    if(trop_tot){
                        $('#divSub').html("L'inscription pour cette activitée n'est pas disponible");
                    }else if(retard){
                        $('#divSub').html("L'activitée est déja terminée");
                    }else if(inscrit){
                        $('#divSub').html("Vous êtes déja inscrit à cette activitée");
                    }else if(conflit){
                        $('#divSub').html("Vous êtes inscrit à une activitée ayant un conflit d'horaire avec celle-cì");
                    }else if(event.participant_max != 0 && event.participant >= event.participant_max){
                        $('#divSub').html("Le nombre de participant maximum est atteint");
                        //$('#divSub').html("<button class='btn green col l12' name='Sub_Liste_attente' id='Sub_liste_Attente' type='submit' form='inscAct'>Rejoindre la liste d'attente</button>");
                    }else{
                        $('#divSub').html("<button class='btn green col l12' name='SubInsAct' id='SubInsAct' type='submit' form='inscAct'>S'inscrire</button>");
                    }
                    
                }else {
                    $('#divSub').html("Vous devez être connecté pour vous inscrire aux activités");
                }
            }
            })
                if (typeof view != 'undefined') {
                    $('#calendar').fullCalendar( 'changeView', view.name )
                }
            };
            function addMinutes(time, minsToAdd) {
                function D(J){ return (J<10? '0':'') + J;};
                var piece = time.split(':');
                var mins = piece[0]*60 + +piece[1] + +minsToAdd;
                return D(mins%(24*60)/60 | 0) + ':' + D(mins%60);  
                } 
            inicalendrier();
        </script>

      <script src="js/scripts.js"></script>
      




<script src="js/empty_app.js"></script>

<script>
  

  $('.modal').modal({
    dismissible: true, // Modal can be dismissed by clicking outside of the modal
    opacity: .3, // Opacity of modal background
    inDuration: 300, // Transition in duration
    outDuration: 200, // Transition out duration
    startingTop: '4%', // Starting top style attribute
    endingTop: '10%', // Ending top style attribute
    
    }
    );

  $(".slider").slider();
</script>
        
    </body>
</html>
