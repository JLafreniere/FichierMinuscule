<script>
    var app = angular.module("app_angular", []);
    app.controller("ctrl", function($scope) {


        $scope.eleves = <?php echo phpSelectQuery('select id_utilisateur, nom, prenom, id_groupe,code_acces, actif, courriel, telephone, sexe, username, password, administrateur from utilisateurs order by nom ASC')?>;

        $scope.groupes = <?php echo phpSelectQuery('select id_groupe, nom_groupe, id_prof, ensemble, nom_session, groupes.id_session, sessions.nom_session from groupes, sessions where groupes.id_session = sessions.id_session order by sessions.debut_session,  groupes.nom_groupe ASC')?>;

        $scope.activites = <?php echo phpSelectQuery('select * from activites where hidden=false or hidden is null')?>;

        $scope.activites_prevues = <?php echo phpSelectQuery('select * from activites_prevues where hidden=false or hidden is null order by presences_prises, date_activite ')?>;

        $scope.eleves_activites = <?php echo phpSelectQuery('select * from utilisateur_activites')?>;

        $scope.sessions = <?php echo phpSelectQuery('select * from sessions order by debut_session ASC')?>;

        $scope.codesAdmin = <?php echo phpSelectQuery('select * from utilisateurs where administrateur >= 1 and not CODE_ACCES="" order by administrateur')?>;

        $scope.ensembles = [1, 2, 3];

        $scope.utilisateursSansGroupes = <?php echo phpSelectQuery('select * from utilisateurs where (id_groupe is null or id_groupe = 0) and  CODE_ACCES="" order by nom ASC')?>;

        $scope.comptesAdministrateur = <?php echo phpSelectQuery('select * from utilisateurs where administrateur >= 1 and CODE_ACCES="" order by nom ASC')?>;

        $scope.points_debut = <?php echo phpSelectQuery('select sum(ponderation) as points_debut, utilisateurs.id_utilisateur
            from utilisateurs, activites, activites_prevues, utilisateur_activites, sessions, groupes 
            where activites_prevues.id_activite = activites.id_activite 
            and activites_prevues.presences_prises = 1
            and utilisateur_activites.id_activite_prevue = activites_prevues.ID_activite_prevue 
            and utilisateur_activites.id_utilisateur = utilisateurs.id_utilisateur
            and utilisateurs.ID_Groupe = groupes.ID_Groupe
            and groupes.ID_Session = sessions.ID_Session
            and activites_prevues.date_activite > sessions.Debut_Session
            and activites_prevues.date_activite < sessions.mi_session
            and utilisateur_activites.present = 1
            group by utilisateurs.id_utilisateur')?>;

        $scope.points_fin = <?php echo phpSelectQuery('select sum(ponderation) as points_fin, utilisateurs.id_utilisateur
         from utilisateurs, activites, activites_prevues, utilisateur_activites, sessions, groupes 
            where activites_prevues.id_activite = activites.id_activite 
            and activites_prevues.presences_prises = 1
            and utilisateur_activites.id_activite_prevue = activites_prevues.ID_activite_prevue 
            and utilisateur_activites.id_utilisateur = utilisateurs.id_utilisateur
            and utilisateurs.ID_Groupe = groupes.ID_Groupe
            and groupes.ID_Session = sessions.ID_Session
            and activites_prevues.date_activite > sessions.mi_Session
            and activites_prevues.date_activite < sessions.fin_session
            and utilisateur_activites.present = 1
            group by utilisateurs.id_utilisateur')?>

        $scope.penalites = <?php echo phpSelectQuery('select sum(ponderation) as penalite, utilisateurs.id_utilisateur from utilisateurs, activites, activites_prevues, utilisateur_activites, sessions, groupes where activites_prevues.id_activite = activites.id_activite and utilisateur_activites.id_activite_prevue = activites_prevues.ID_activite_prevue and utilisateur_activites.id_utilisateur = utilisateurs.id_utilisateur and utilisateurs.ID_Groupe = groupes.ID_Groupe and groupes.ID_Session = sessions.ID_Session and activites_prevues.date_activite > sessions.Debut_Session and activites_prevues.date_activite < sessions.fin_session and utilisateur_activites.present = 0 and activites_prevues.presences_prises = 1 group by utilisateurs.id_utilisateur')?>;

        $scope.responsableSelectionne;

        $scope.SESSION = 0;
    
        $scope.masquerPresence = true;

        $scope.masquerPasse = true;

        $scope.masquerGroupes = true;

        $scope.groupePromotion;

        $scope.codeGroupe = -1;

        $scope.activiteSelectionne = -1;

        $scope.afficherAdmins = true;
        $scope.afficherResponsables = true;

        $scope.formatHeure = function(heure){
            return heure.slice(0, -3);
        }

        $scope.setActSelectionne = function(id){
            $scope.activiteSelectionne = id;
        }

        $scope.setGroupe = function(id){
                $scope.codeGroupe = id;            
        }

        $scope.show_params = function(activite) {
            $('#modal_mod_planif').modal('open');
            $('#ID_ACT_PLAN').val(activite.ID_activite_prevue);
            $('#mod_nom_act').val(activite.ID_Activite);
            $('#mod_nom_act').material_select();
            $('#mod_date_act').val(activite.Date_Activite);
            $('#mod_heure_deb').val(activite.Heure_debut);
            $('#mod_participants_max').val(activite.Participants_Max);
            $('#mod_frais').val(activite.Frais);
            $('#mod_endroit').val(activite.Endroit);
            $('#mod_responsable').val(activite.responsable);
            $('#mod_responsable').material_select();
            $('.ACTIVER').addClass("active");
        }

        $('#select_session').on('change', function() {
            let x = $('#select_session').val();
            $('#select_session').val(x);
            $scope.SESSION = x;
            $scope.$apply();
            $('#select_session').material_select();
        });




        $scope.pointsDebutForEleve = function(id) {

            let pts = 0;
            try {
                pts = $scope.points_debut.filter(function(el) {

                    return el.id_utilisateur == id;
                })[0].points_debut;

                if (pts > 5) {
                    return 5;
                }
            } catch (err) {}
            return parseInt(pts);



        }

        $scope.penaliteForEleve = function(id){
            try{

            let pts = parseInt($scope.penalites.filter(function(el) {
                    return el.id_utilisateur == id;
                })[0].penalite);
            return pts;
        }
            catch(err){
        
                return 0;
            }

        }


        $scope.pointsFinForEleve = function(id) {

            let pts = 0;
            try {
                pts = $scope.points_fin.filter(function(el) {

                    return el.id_utilisateur == id;
                })[0].points_fin;

                if (pts > 5) {
                    return 5;
                }
            } catch (err) {}
            return parseInt(pts);
        }



        $scope.pointsBonusForEleve = function(id) {
            let pts_fin = 0;
            let pts_debut = 0;

            try {
                pts_fin = $scope.points_fin.filter(function(el) {
                    return el.id_utilisateur == id;
                })[0].points_fin;
            } catch (err) {}


            try {
                pts_debut = $scope.points_debut.filter(function(el) {

                    return el.id_utilisateur == id;
                })[0].points_debut;
            } catch (err) {}

            let pts_bonus = 0;

            if (pts_fin > 5) {
                pts_bonus += pts_fin - 5;
            }

            if (pts_debut > 5) {
                pts_bonus += pts_debut - 5;
            }

            if(pts_bonus > 5){
                return parseInt(5);
            }else return parseInt(pts_bonus);
        }

        $scope.pointsReguliersForEleve = function(id) {
            let pts_fin = 0;
            let pts_debut = 0;
            try {
                pts_fin = $scope.points_fin.filter(function(el) {
                    return el.id_utilisateur == id;
                })[0].points_fin;
            } catch (err) {}


            try {
                pts_debut = $scope.points_debut.filter(function(el) {

                    return el.id_utilisateur == id;
                })[0].points_debut;
            } catch (err) {}


            let pts_reg = 0;

            if (parseInt(pts_debut) + parseInt(pts_fin)  > 5) {
                pts_reg = 5;
            } else pts_reg = parseInt(pts_debut) + parseInt(pts_fin);
            
            return parseInt(pts_reg);
        }




        $scope.pointsBonusEnsemble1ForEleve = function(id) {

            let pts_fin = 0;
            let pts_debut = 0;
            try {
                pts_fin = $scope.points_fin.filter(function(el) {
                    return el.id_utilisateur == id;
                })[0].points_fin;
            } catch (err) {}


            try {
                pts_debut = $scope.points_debut.filter(function(el) {

                    return el.id_utilisateur == id;
                })[0].points_debut;
            } catch (err) {}


            let pts_reg = (parseInt((parseInt(pts_debut) + parseInt(pts_fin))));

            console.log(pts_reg+" "+id)

            if (pts_reg > 5) {

                    return parseInt(pts_reg - 5);
             
            }
            else return 0;



        }


        $scope.pointsEnsemble2 = function(id) {

            let pts_fin = 0;
            let pts_debut = 0;

            try {
                pts_fin = $scope.points_fin.filter(function(el) {
                    return el.id_utilisateur == id;
                })[0].points_fin;
                pts_fin = parseInt(pts_fin);
            } catch (err) {}
            pts_fin = parseInt(pts_fin);

            try {
                pts_debut = $scope.points_debut.filter(function(el) {
                    return el.id_utilisateur == id;
                })[0].points_debut;
                pts_debut = parseInt(pts_debut);
            } catch (err) {}
            pts_debut= parseInt(pts_debut);
            let pts_totaux = parseInt(pts_fin) + parseInt(pts_debut);

            if (pts_totaux > 5) {
                pts_totaux = 5;
            }


            return pts_totaux;


        }




        $scope.modifierActivitePrevue = function() {

            $.ajax({
                type: "POST",
                url: "php_scripts/modifierActivitePrevue.php",
                data: {
                    'ID_ACTIVITE_PREVUE': $('#ID_ACT_PLAN').val(),
                    'ID_ACTIVITE': $('#mod_nom_act').val(),
                    'DATE_ACT': $('#mod_date_act').val(),
                    'HEURE_ACT': $('#mod_heure_deb').val(),
                    'PARTICIPANTS_MAX': $('#mod_participants_max').val(),
                    'FRAIS': $('#mod_frais').val(),
                    'ENDROIT': $('#mod_endroit').val(),
                    'RESPONSABLE': $('#mod_responsable').val()
                }, //TODO: CHANGE PROF ID
                success: function(data) {

                    alert(data);
                    if (data.trim() == "L'activité a été modifiée avec succès!") {
                        location.reload();
                    }



                },
                error: function(req) {
                    alert("Erreur");
                }
            });


        }

        $scope.supprimerActivite = function(id) {



            if (confirm("Vous êtes sur le point de supprimer cette activité, êtes vous sûr?") == true) {
                $.ajax({
                    type: "POST",
                    url: "php_scripts/supprimeractivite.php",
                    data: {
                        'ID_ACTIVITE': id,
                    }, //TODO: CHANGE PROF ID
                    success: function(data) {
                        location.reload();
                    },
                    error: function(req) {
                        alert("Erreur");
                    }
                });


            }
        }

        $scope.modifierActivite = function(activite) {

            $('#id_mod_act').val(activite.ID_Activite);
            $('#nom_activite_mod').val(activite.Nom_Activite);
            $('#duree_mod').val(activite.Duree);
            $('#point_mod').val(activite.Ponderation);
            $('#description_mod').val(activite.Commentaire);
            $('#modal_mod_new_activite').modal("open");
            $('#modal_mod_new_activite label').addClass("active");
        }

        $scope.modifierSession = function(session) {

            $('#id_session_mod').val(session.ID_Session);
            $('#nom_session_mod').val(session.Nom_Session);
            $('#deb_session_mod').val(session.Debut_Session);
            $('#mi_session_mod').val(session.Mi_Session);
            $('#fin_session_mod').val(session.Fin_Session);
            $('#modal_session_mod').modal('open');
            $('#modal_session_mod label').addClass("active");

        }

        $scope.niveauxAdmin = ['Administrateur', 'Planificateur'];

        $scope.saveAdmin = function() {
            $.ajax({
                type: "POST",
                url: "php_scripts/updateAdmin.php",
                data: {
                    'user': $('#utilisateurNivAdmin').val(),
                    'admin': $('#niveauUser').val()
                }, //TODO: CHANGE PROF ID
                success: function(data) {
                    location.reload();

                },
                error: function(req) {
                    alert("Erreur");
                }
            });

        }

        $scope.now = new Date();

        $scope.toDate = function(dateMod) {
            return new Date(dateMod);
        }

        $scope.scopePrint = function(val) {
        }


        $scope.activiteFromId = function(id) {

            let act = $scope.activites.filter(function(ac) {
                return ac.ID_Activite == id;
            })[0];

            return act;

        }



        $scope.groupeFromId = function(id) {

            let gr = $scope.groupes.filter(function(gr) {
                return gr.id_groupe == id;
            })[0];

            return gr;

        }


        $scope.adminLevelFromID = function(admin) {

            let adminLevel;

            switch (admin) {
                case '2':
                    adminLevel = 'Administrateur';
                    break;
                case '1':
                    adminLevel = 'Responsable';
                    break;
                default:
                    adminLevel = 'Utilisateur Régulier';

            }
            return adminLevel;

        }


        $scope.elevesDansGroupe = function(groupe) {
            return $scope.eleves.filter(function(el) {

                return el.id_groupe == groupe && el.code_acces == "";
            });
        }

        $scope.eleveFromId = function(id) {
            return $scope.eleves.filter(function(el) {

                return el.id_utilisateur == id;
            })[0];
        }




        $scope.getElevesForActivitePrevue = function(activite) {

            let liste_el_ac = ($scope.eleves_activites.filter(function(ac) {
                return ac.ID_Activite_Prevue == activite;
            }));


            var listeId = liste_el_ac.map(function(a) {
                return a.ID_Utilisateur;
            });

            let arr = [];

            for (var i = 0; i < listeId.length; i++) {
                arr.push($scope.eleveFromId(listeId[i]));
            }
            return arr;

        }

        $scope.getPresenceForEleve = function(activite_prevue, eleve) {
            try {
                let present = ($scope.eleves_activites.filter(function(ac) {
                    return ac.ID_Activite_Prevue == activite_prevue && ac.ID_Utilisateur == eleve;
                }))[0].Present;

                if (present == 1) {
                    return true;
                } else return false;
            } catch (err) {
                return false
            }


        }

        $scope.annulerActivite = function(activite) {

            if (confirm("Vous êtes sur le point de supprimer cette activité, êtes vous sûr?") == true) {
                $.ajax({
                    type: "POST",
                    url: "php_scripts/annulerActivite.php",
                    data: {
                        'ID_ACTIVITE': activite,
                    }, //TODO: CHANGE PROF ID
                    success: function(data) {
                        location.reload();

                    },
                    error: function(req) {
                        alert("Erreur");
                    }
                });

            }




        }



        $scope.eleveFromId = function(id) {


            let elev = $scope.eleves.filter(function(el) {
                return el.id_utilisateur == id;
            })[0];

            return elev;

        }


        $scope.enregistrerPresence = function(activite_prevue) {
            var values = new Array();
            $.each($("input[name='presenceActivite']:checked"), function() {
                values.push($(this).val());
            });

            alert(values);  

            $.ajax({
                type: "POST",
                url: "php_scripts/prendrePresence.php",
                data: {
                    'PRESENTS': values,
                    'ACTIVITE': $scope.activiteSelectionne
                }, //TODO: CHANGE PROF ID
                success: function(data) {
                    location.reload();
                },
                error: function(req) {
                    alert("Erreur");
                }
            });



        }


        $scope.comptesAvecCodeDansGroupe = function(groupe) {
            return $scope.eleves.filter(function(el) {
                return el.id_groupe == groupe && el.code_acces != "";
            });
        }



        $scope.comptesAdmin = function(groupe) {
            return $scope.eleves.filter(function(el) {
                return el.administrateur >= 1 && el.code_acces == "";
            });
        }



        $scope.genererCodePourGroupe = function(groupe, nb_codes) {

            $.ajax({
                type: "POST",
                url: "php_scripts/generercode.php",
                data: {
                    'admin': 0,
                    'id_groupe': $scope.codeGroupe,
                    'nb_codes': $("#codeGroupe").val()
                },
                success: function(data) {

                    location.reload();

                },
                error: function(req) {
                    alert("Erreur");
                }
            });

        }


        $scope.genererCodePourGroupe0 = function(){

             $.ajax({
                type: "POST",
                url: "php_scripts/generercode.php",
                data: {
                    'admin': 0,
                    'id_groupe': $scope.codeGroupe,
                    'nb_codes': $("#codeGroupe0").val()
                },
                success: function(data) {
                    alert(data);
                    location.reload();

                },
                error: function(req) {
                    alert("Erreur");
                }
            });

        }

        $scope.genererCodeAdmin = function(nb_codes) {

            $.ajax({
                type: "POST",
                url: "php_scripts/generercode.php",
                data: {
                    'admin': $('input[name=niveauAdmin]:checked').val(),
                    'id_groupe': 'null',
                    'nb_codes': $("#codeAdmin").val()
                },
                success: function(data) {

                    location.reload();
                },
                error: function(req) {
                    alert("Erreur");
                }
            });

        }

        $scope.setPromotionId = function(groupe) {

            $scope.groupePromotion = $scope.elevesDansGroupe(groupe);



        }


        $scope.promoteUser = function(id_user) {

            if (confirm("Êtes-vous sûr de vouloir promouvoir cet utilisateur?"))
                $.ajax({
                    type: "POST",
                    url: "php_scripts/updateAdmin.php",
                    data: {

                        'user': id_user,
                        'admin': 1


                    }, //TODO: CHANGE PROF ID
                    success: function(data) {

                        location.reload();

                    },
                    error: function(req) {
                        alert("Erreur");
                    }
                });

        }

        $scope.demoteUser = function(id_user){
                        if (confirm("Êtes-vous sûr de vouloir rétrograder cet utilisateur?"))
                $.ajax({
                    type: "POST",
                    url: "php_scripts/updateAdmin.php",
                    data: {

                        'user': id_user,
                        'admin': 0


                    }, //TODO: CHANGE PROF ID
                    success: function(data) {

                        location.reload();

                    },
                    error: function(req) {
                        alert("Erreur");
                    }
                });

        }



        $scope.creergroupe = function() {

            $.ajax({
                type: "POST",
                url: "php_scripts/creergroupe.php",
                data: {
                    'nomgroupe': $("#nomgroupe").val(),
                    'id_prof': 0,
                    'nb_codes': $("#rangeEleves").val(),
                    'ensemble': $("#ensemble").val(),
                    'session': $("#session").val()

                }, //TODO: CHANGE PROF ID
                success: function(data) {
                    location.reload();

                },
                error: function(req) {
                    alert("Erreur");
                }
            });
        }




        $scope.ouvrirModalModifierPermission = function(id_admin, niveau) {

            $("#utilisateurNivAdmin").val(id_admin);
            $('#modal_niveauAdmin').modal('open');
            $('#niveauUser').val(niveau).change();
            $('#niveauUser').material_select();

        }

        $scope.print = function(groupe) {
            var prtContent = document.getElementById('codesGroupe' + groupe);
            var WinPrint = window.open('', '', 'left=0,top=0,width=1920,height=2000,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write("LISTE DES CODES D'ACCÈS <br>" + prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }

        $scope.supprimerGroupe = function(groupe, nomGroupe) {

            var nom_Groupe = prompt("Pour confirmer la suppression, veuillez entrer le nom du groupe", "");

            if (nom_Groupe == nomGroupe) {
                $.ajax({
                    type: "POST",
                    url: "php_scripts/supprimergroupe.php",
                    data: {
                        'id_groupe': groupe,
                    }, //TODO: CHANGE PROF ID
                    success: function(data) {

                        location.reload();
                    },
                    error: function(req) {
                        alert("Erreur");
                    }
                });
            }else alert("Le groupe saisi ne correspond pas au groupe que vous souhaitez supprimer. La suppression est annulée")
        }

    });

    $("#selectResponsable").val($("#selectResponsable option:first").val());
    $('#selectResponsable').material_select();

</script>