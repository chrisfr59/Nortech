<?php $nav_en_cours = 'espace_perso'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="perso.css" />
    <title>Document</title>
    <!--Fonction qui permet de modifier la visibilité-->
    <script>
        function afficher(){
        var formulaire = document.getElementById(modifCV);
        if(modifCV.style.display =='block'){
            modifCV.style.display = 'none';
        }
        else{
            modifCV.style.display = 'block';
        }
    }
    </script>
</head>

<body>
    <?php
include('header.php');
?>

    <section>

        <?php
    //Insertion de la bannière et de la navigation
    include('db_connect.php');
    $sql='select e.noEmp, e.nom, e.prenom from nortech.employe e, nortech.utilisateur u where e.identifiant=u.identifiant and u.identifiant like "'.$_SESSION['pseudo'].'"';
    //Préparation de la requête SQL en utilisant la variable $connexion
    $req=$connexion->prepare($sql);
    //execuction de la requête avec enregistrement des résultats dans la variable $reponse
    //(boolean qui prend deux valeurs : 1 pour execute=ok et 0 pour execute=ko)
    $reponse=$req->execute(array());

    $resultat=$req->fetch();

    $nomF= $resultat['noEmp'].'_'.$resultat['nom'].'_'.$resultat['prenom'].'.pdf?'.time();
    $fichier="CV/$nomF";

    $sql2='select e.noEmp, e.nom, e.prenom, e.fonction, e.sup, e.tel, e.mail, e.embauche, e.noServ, s.service
    from nortech.employe e, nortech.utilisateur u, nortech.service s
    where e.identifiant=u.identifiant and e.noServ=s.noServ and u.identifiant like "'.$_SESSION['pseudo'].'"';
    //Préparation de la requête SQL en utilisant la variable $connexion
    $req2=$connexion->prepare($sql2);
    //execuction de la requête avec enregistrement des résultats dans la variable $reponse
    //(boolean qui prend deux valeurs : 1 pour execute=ok et 0 pour execute=ko)
    $reponse2=$req2->execute(array());

    $resultat2=$req2->fetch();

    $noEmp=$resultat2['noEmp'];
    $nom=$resultat2['nom'];
    $prenom=$resultat2['prenom'];
    $fonction=$resultat2['fonction'];
    $sup=$resultat2['sup'];
    $tel=$resultat2['tel'];
    $mail=$resultat2['mail'];
    $embauche=$resultat2['embauche'];
    $noServ=$resultat2['noServ'];
    $service=$resultat2['service'];

    $sql3='select sup.nom, sup.prenom, sup.tel, sup.mail
    from nortech.employe e, nortech.utilisateur u, nortech.employe sup
    where e.identifiant=u.identifiant and e.sup=sup.noEmp and u.identifiant like "'.$_SESSION['pseudo'].'"';
    //Préparation de la requête SQL en utilisant la variable $connexion
    $req3=$connexion->prepare($sql3);
    //execuction de la requête avec enregistrement des résultats dans la variable $reponse
    //(boolean qui prend deux valeurs : 1 pour execute=ok et 0 pour execute=ko)
    $reponse3=$req3->execute(array());

    $resultat3=$req3->fetch();

    $nomSup=$resultat3['nom'];
    $prenomSup=$resultat3['prenom'];
    $telSup=$resultat3['tel'];
    $mailSup=$resultat3['mail'];

    ?>
        <section>
            <div class="espace_perso">

                <div class="col-md-6">
                    <?php
                    echo "$noEmp - $nom $prenom<br> - $fonction<br> - Téléphone : $tel<br> - Mail : $mail<br> - Date d'embauche : $embauche<br> - Numéro de Service : $noServ<br> - $service <br>";                  
                ?>
                </div>
                <div class="col-md-6">
                    <?php
                echo "$sup<br> - $nomSup<br> $prenomSup<br> - $telSup<br> - $mailSup <br>";
                ?>
                </div>

            </div>
            <div class="consultation">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h5>CV</h5>

                            <button><a class="btn btn-outline-light" href="<?php echo $fichier?>" target="_blank" role="button">Consulter</a></button>
                            <button type="button" value="Modifier" onclick="afficher();">Modifier</button>
                            <form style=display:none; id="modifCV" name="modifCV" method="post" action="traitement_modif_CV.php"
                                enctype="multipart/form-data">
                                <fieldset class="CV">
                                    <input class="input choisir" type="file" name="joinCV" id="joinCV" required><br><br>
                                    <input name="envoyer_CV" class="submit" type="submit" value="envoyer">
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h5>Fiche de paie</h5>
                            <button><a class="btn btn-outline-light" href="" role="button">Fiche de paie</a></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="declaration">
                <div class="row">
                    <div class="col-md-12 ">

                        <div class="col-md-6"">
                        <h5>Dépenses</h5>

                        <button><a class="
                            btn btn-outline-light" href="Formulaire-depenses.php" role="button">Déclarer</a></button>
                            <button><a class="btn btn-outline-light" href="consulter_frais.php" role="button">Consulter</a></button>

                        </div>
                        <div class="col-md-6">
                            <h5>Absences</h5>

                            <button><a class="btn btn-outline-light" href="absence.php" role="button">Absences</a></button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="twitter">
                <div class="row">
                    <div class="col-md-12">
                        Fil d'actualité twitter
                    </div>
                </div>

            </div>

        </section>




</body>

</html>