<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Absences</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/botstrap-grid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="offre.css" />
    <!--Fonction qui permet de modifier la visibilité-->
    <script>
    function afficher(etat){
        document.getElementById("champ").style.visibility=etat;
    }
    </script>
</head>
<body>
    
<?php
include ('db_connect.php');
include ('header.php');
?>
<!--Formulaire d'absences et de congés-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <form name="absence" method="post" action="traitement_absence.php" enctype="multipart/form-data">
                    <fieldset class="absform">
                        <legend>Déclarer une absence</legend><br />
                        
                        <p>Type d'absence à déclarer :
                            <label class="choix" for="absence">Absence</label>
                            <!--Si le radio = absence : afficher la div "champ" qui correspond au justifcatif-->
                            <input type="radio" name="abs" value="absence" id="absence" onclick="afficher('visible');">
                            <label class="choix" for="conges">Congés</label>
                            <!--Si le radio = conges : masquer la div "champ" qui correspond au justifcatif-->
                            <input type="radio" name="abs" value="conge" id="conges" onclick="afficher('hidden');">
                        </p>

                        <label class="label" for="noEmp">noEmp :</label>
                        <input class="input" type="number" name="noEmp" id="noEmp"/><br /><br />

                        <label class="label" for="dateAbsD">Date :</label>
                        Du : <input class="input" type="date" name="dateAbsD" id="dateAbsD" required/><br /><br />
                        <label class="label" for="dateAbsF"></label>
                        Au : <input class="input fin" type="date" name="dateAbsF" id="dateAbsF" required/><br /><br />

                        <label class="label" for="motif">Motif :</label>
                        <textarea class="input" type="text" name="motif" id="motif"></textarea><br /><br />
                        
                        <div id="champ">
                        <label class="label" for="justificatif">Justificatif :</label>
                        <input class="input choisir" type="file" name="justificatif" id="justificatif"/><br /><br />
                        </div>
                        
                        <input name="envoyer" class="btn-submit" type="submit" value="Envoyer" />
                    </fieldset>
                </form>
            </div>
            <div class="col-md-1"></div>

            <!--Historique de congés-->
            <div class="col-md-6">
            <fieldset>
                <legend>Historique des absences</legend>
                <p>Dates des absences :
                <p class="search">Rechercher un employé :</p>

                <!--Fonction pour rechercher un employé et retourner des informations-->
             
                <form class="search_bar" role="search" method="get" action="">
                    <input class="search-field" type="search" placeholder="Recherche.." name="recherche" id="recherche" /><br /><br />
                    <input class="search-submit" value="Rechercher" type="submit" name="submit"/>
                </form>
                <fieldset class="conges">
                    <p>
                        <?php
                            if(isset($_GET["submit"])){
                                $recherche=$_GET["recherche"] ;
                                rechercher($recherche);
                            }

                            function rechercher($noEmp){
                                global $connexion;
                                $existant= false;
                                $req = $connexion->prepare("SELECT e.noEmp, e.nom, e.prenom, a.dateAbsD, a.dateAbsF, a.motif FROM nortech.employe e, nortech.absence a where e.noEmp=a.noEmp");
                                $reponse=$req->execute(array());
                                if (isset($reponse)){
                                    while($resultat=$req->fetch()){
                                        if ($resultat['noEmp'] == $noEmp){
                                            echo '<tr>';
                                            echo '<td>'.$resultat['noEmp'].'</td> - 
                                            <td>'.$resultat['nom'].'</td>
                                            <td>'.$resultat['prenom'].'</td> : du 
                                            <td>'.$resultat['dateAbsD'].'</td> au 
                                            <td>'.$resultat['dateAbsF'].'</td>.
                                            <td>'.$resultat['motif'].'</td>';
                                            echo '<tr><br />';
                                            $existant=true;
                                        }
                                    }
                                } 
                                if ($existant==false){
                                    echo "Employé non existant".'<br /><br />';
                                }
                            }
                            echo '<br />';
                        ?>

                        <?php 
                        //Requête pour afficher les congés dans le fieldset
                        $sql="SELECT e.noEmp, e.nom, e.prenom, a.dateAbsD, a.dateAbsF, a.motif FROM nortech.absence a, nortech.employe e WHERE a.noEmp=e.noEmp AND e.noEmp=1000";
                        //WHERE à modifier en fonction du log
                        $req1=$connexion->prepare($sql);
                        $reponse1=$req1->execute(array());
                        while($resultat1=$req1->fetch()){
                            echo '<tr>';
                            echo '
                            <td>'.$resultat1['noEmp'].'</td> - 
                            <td>'.$resultat1['nom'].'</td>
                            <td>'.$resultat1['prenom'].'</td> : du
                            <td>'.$resultat1['dateAbsD'].'</td> au 
                            <td>'.$resultat1['dateAbsF'].'</td>. 
                            <td>'.$resultat1['motif'].'</td><br />';
                            echo '</tr>';
                        };
                        ?>
                    </p>
                </fieldset>
                <p>Jours de congés pris :
                    <?php   
                    
                        //Calculer le nombre de jours pris par rapport au formulaire
                            $noEmp=1000;
                            $dateAbsD='2018-05-10';
                            $dateAbsF='2018-05-20';
                        $tabDateD=explode("-", $dateAbsD);
                        $tabDateF=explode("-", $dateAbsF);
                        $nbrPris=(mktime(12,0,0, $tabDateF[1], $tabDateF[2], $tabDateF[0]) - mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0]))/60/60/24;
                    
                        //récupérer la colonne nbJPris dans la bdd et les additionner
                        $sql="SELECT SUM(nbJPris) as nombre FROM nortech.absence WHERE noEmp=1000";
                        $req2=$connexion->prepare($sql);
                        $reponse2=$req2->execute(array());
                        $test=0;
                        while($resultat2=$req2->fetch()){
                            echo '<tr>';
                            echo '
                            <td>'.$resultat2['nombre'].'</td><br />';
                            echo '</tr>';
                            $test+=$resultat2['nombre'];
                        };
                    ?>
                </p>
                <p>Jours de congés restants :
                    <?php 
                        $nbrRestant=30-$test;
                        echo $nbrRestant;
                    ?>
                </p>
            </fieldset>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

</body>
</html>