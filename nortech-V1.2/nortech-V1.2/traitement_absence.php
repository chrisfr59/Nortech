<?php

include('db_connect.php');
session_start();

//stock le nom, prenom, date début, date fin, motif
if(isset($_POST['dateAbsD'])){
    $utilisateur=$_SESSION['pseudo'];
    //$noEmp=$_POST['noEmp'];
    $dateAbsD=$_POST['dateAbsD'];
    $dateAbsF=$_POST['dateAbsF'];
    $motif=$_POST['motif'];
    $bouton=$_POST['envoyer'];
    $types=$_POST['types'];
    $dateJour = date("d");
    $dateMois = date("m");
    $dateAnnee = date("Y");
    $noEmp='(SELECT e.noEmp FROM nortech.employe e, nortech.utilisateur u WHERE e.identifiant=u.identifiant AND u.identifiant like "'.$_SESSION['pseudo'].'")';
    
    /*//Requête pour définir le quantième (jour de l'année) de la date de début et la date de fin
    $quantiemeD='(SELECT DAYOFYEAR($dateAbsD) as "Quantième Début" FROM nortech.employe e, nortech.absence a, nortech.utilisateur u WHERE e.identifiant=u.identifiant AND a.noEmp=e.noEmp AND u.identifiant like "'.$_SESSION['pseudo'].'")';
    $req1=$connexion->prepare($quantieme);
    $reponse1=$req1->execute(array());
    $tempo1=$req1->fetch();

    //Requête pour définir le quantième (jour de l'année) de la date de début et la date de fin
    $quantiemeF='(SELECT DAYOFYEAR($dateAbsF) as "Quantième Fin" FROM nortech.employe e, nortech.absence a, nortech.utilisateur u WHERE e.identifiant=u.identifiant AND a.noEmp=e.noEmp AND u.identifiant like "'.$_SESSION['pseudo'].'")';
    $req1=$connexion->prepare($quantieme);
    $reponse1=$req1->execute(array());
    $tempo1=$req1->fetch();*/

    //La requête pour calculer les jours avant de comparer le nombre de jours pris avec 30
    $sql2='SELECT SUM(a.nbJPris) as nombre FROM nortech.employe e, nortech.absence a, nortech.utilisateur u WHERE a.noEmp=e.noEmp AND e.identifiant=u.identifiant AND u.identifiant like "'.$_SESSION['pseudo'].'"';
    $req2=$connexion->prepare($sql2);
    $reponse2=$req2->execute(array());
    $tempo2=$req2->fetch();    
    
//$_FILES['justificatif']['name'] sert à prendre en paramètre une des valeurs du tableau associatif renvoyé par le $_FILES 
if(!empty($_FILES['justificatif']['name'])){
    
    //recupère le justificatif 
    $file=$_FILES['justificatif']['name'];
    //recupère l'extension du fichier
    $fileextension=strrchr($file,".");

    //stockage dans un dossier temp 
    $filetmp=$_FILES['justificatif']['tmp_name'];

    //donne le répertoire de stockage 
    $filedest='Justificatif/'.$file;

    //le déplace dans le dossier fichier 
    move_uploaded_file($filetmp,$filedest);

    //renomme le justificatif  
    rename("$filedest", "Justificatif/ $utilisateur - $motif du $dateAbsD au $dateAbsF $fileextension");
    //}
}

    if($bouton==true){
    
        $tabDateD=explode("-", $dateAbsD);
        $tabDateF=explode("-", $dateAbsF);
        $nbrPris=(mktime(12,0,0, $tabDateF[1], $tabDateF[2], $tabDateF[0]) - mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0]))/60/60/24;

        //La requête pour récupérer les dates déjà prises et pour pouvoir les comparer aux dates que l'on veut poser
        $sql3='SELECT a.dateAbsD, a.dateAbsF FROM nortech.employe e, nortech.absence a, nortech.utilisateur u WHERE a.noEmp=e.noEmp AND e.identifiant=u.identifiant AND u.identifiant like "'.$_SESSION['pseudo'].'"';
        $req3=$connexion->prepare($sql3);
        $reponse3=$req3->execute(array());
        $superposition=false;

        //Boucle pour faire la vérification à chaque ligne de la BDD
        while($resultat3=$req3->fetch()){
            if($superposition==false){
                $Tab0=explode("-",$resultat3['dateAbsD']);
                $Tab1=explode("-",$resultat3['dateAbsF']);
                //Comparaison entre les dates de début déjà rentrées et la date de début saisie (si les dates de début enregistrées sont supérieures à la date de début saisie)
                if (mktime(12,0,0,$Tab0[1],$Tab0[2],$Tab0[0])>=mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0])){
                    //Comparaison entre les dates de début déjà rentrées et la date de fin saisie (si les dates de début enregistrées sont supérieures à la date de fin)
                    if(mktime(12,0,0,$Tab0[1],$Tab0[2],$Tab0[0])>mktime(12,0,0, $tabDateF[1], $tabDateF[2], $tabDateF[0])){
                        $superposition=false;
                    }
                    else{
                        $superposition=true;
                    }
                }
                else{
                    //Comparaion entre les dates de début déjà rentrées et la date de début saisie (si les dates de début enregistrées sont inférieures à la date de début saisie)
                    if(mktime(12,0,0,$Tab0[1],$Tab0[2],$Tab0[0])<=mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0])){
                        //Comparaison entre les dates de fin déjà rentrées et la date de fin saisie (si les dates de début enregistrées sont inférieures à la date de fin)
                        if(mktime(12,0,0,$Tab1[1],$Tab1[2],$Tab1[0])<mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0])){
                            $superpostion=false;
                        }
                        else{
                            $superposition=true;
                        }
                    }
                }
            }
        }

/*Condition permettant de limiter le choix des dates : 
- Impossible de prendre des congés pour une date inférieure ou égale à la date du jour
- La date de fin ne peut être inférieure à la date de début (pour absences et congés)*/

//Conditions pour les congés
if($types=='Congés'){
    //Première condition : Si l'année est égale
    if($tabDateD[0] == $tabDateF[0]){
        // Comparaison de la date de début et de la date du jour
        if ((mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0]) - mktime(12,0,0, $dateMois, $dateJour, $dateAnnee)) <= 0){
            echo "<script type='text/javascript'>document.location.replace('absence.php');
            alert('La date choisie doit être supérieure à la date du jour.');
            </script>";
        }else{
            //Comparaison de la date de fin avec la date de début
            if ((mktime(12,0,0, $tabDateF[1], $tabDateF[2], $tabDateF[0]) - mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0])) < 0){
                echo "<script type='text/javascript'>document.location.replace('absence.php');
                    alert('La date de fin ne peut pas être inférieure à la date de début.');
                    </script>";
            }else{
                //Condition permettant de calculer le nombre de jours pris avant d'effectuer la requête pour bloquer la demande si le nombre calculé dépasse 30 jours
                if(($tempo2[0]+$nbrPris)>30){
                    echo "<script type='text/javascript'>document.location.replace('absence.php');
                    alert('Vous n\'avez pas suffisamment de jours de congés restants pour effectuer cette opération.');
                    </script>";                   
                }else{
                    //Appelle le résultat de la boucle
                    if($superposition==false){
                    //Requête d'insertion en base de données
                    $req='INSERT INTO nortech.absence(dateAbsD, dateAbsF, motif, nbJPris, noEmp, types) VALUES("'.$dateAbsD.'","'.$dateAbsF.'","'.$motif.'","'.$nbrPris.'",'.$noEmp.',"'.$types.'")';
                    try{
                        $connexion= new PDO('mysql:host=localhost;dbname=nortech','root','');
                        $test=$connexion->query($req);
                        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso');
                        alert('Votre demande de congés a bien été prise en compte.');
                            </script>";
                    }
                    catch (PDOException $e){
                        print "Erreur!:".$e->getMessage().'<br>';
                        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso');
                        alert('Erreur de connection à la base de données!');
                            </script>";
                    }
                    }else{
                        echo "<script type='text/javascript'>document.location.replace('absence.php');
                                alert('Vos dates se superposent avec des dates déjà enregistrées');
                                </script>";
                    }
                }
            }     
        }
    }else{
        //Deuxième condition : Si l'année n'est pas égale. Comparaison de la date de début avec la date du jour
        if ((mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0]) - mktime(12,0,0, $dateMois, $dateJour, $dateAnnee)) <= 0){
            echo "<script type='text/javascript'>document.location.replace('absence.php');
            alert('La date choisie doit être supérieure à la date du jour.');
            </script>";
        }else{
            if ((mktime(12,0,0, $tabDateF[1], $tabDateF[2], $tabDateF[0]) - mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0])) > 0){
                //Condition permettant de calculer le nombre de jours pris avant d'effectuer la requête pour bloquer la demande si le nombre calculé dépasse 30 jours
                if(($tempo2[0]+$nbrPris)>30){
                    echo "<script type='text/javascript'>document.location.replace('absence.php');
                    alert('Vous n\'avez pas assez de jours de congés restants pour effectuer cette opération.');
                    </script>";
                }else{
                    //Appelle le résultat de la boucle
                    if($superposition==false){
                    //Requête d'insertion en base de données
                   $req='INSERT INTO nortech.absence(dateAbsD, dateAbsF, motif, nbJPris, noEmp, types) VALUES("'.$dateAbsD.'","'.$dateAbsF.'","'.$motif.'","'.$nbrPris.'",'.$noEmp.',"'.$types.'")';
                    try{
                        $connexion= new PDO('mysql:host=localhost;dbname=nortech','root','');
                        $test=$connexion->query($req);
                        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso');
                        alert('Votre demande de congés a bien été prise en compte.');
                            </script>";
                    }
                    catch (PDOException $e){
                        print "Erreur!:".$e->getMessage().'<br>';
                        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso');
                        alert('Erreur de connection à la base de données!');
                            </script>";
                    }
                    }else{
                        echo "<script type='text/javascript'>document.location.replace('absence.php');
                                alert('Vos dates se superposent avec des dates déjà enregistrées');
                                </script>";
                    }
                }
            }else{
                echo "<script type='text/javascript'>document.location.replace('absence.php');
                    alert('La date choisie doit être supérieure à la date du jour.');
                    </script>";
            }
        }
    }
//Conditions pour les absences
}else if($types=='Absences'){
    //Comparaison de la date de fin avec la date de début
    if ((mktime($tabDateF[1], $tabDateF[2], $tabDateF[0]) - mktime($tabDateD[1], $tabDateD[2], $tabDateD[0])) < 0){
        echo "<script type='text/javascript'>document.location.replace('absence.php');
            alert('La date de fin ne peut pas être inférieure à la date de début.');
            </script>";
    }else{
        //Appelle le résultat de la boucle
        if($superposition==false){
            //Requête d'insertion en base de données
            $req='INSERT INTO nortech.absence(dateAbsD, dateAbsF, motif, nbJPris, noEmp, types) VALUES("'.$dateAbsD.'","'.$dateAbsF.'","'.$motif.'","0",'.$noEmp.',"'.$types.'")';
            try{
                $connexion= new PDO('mysql:host=localhost;dbname=nortech','root','');
                $test=$connexion->query($req);

                echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso');
                alert('Votre déclaration d\'absence a bien été pris en compte.');
                    </script>";
            }
            catch (PDOException $e){
                print "Erreur!:".$e->getMessage().'<br>';
                echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso.php');
                alert('Erreur de connection à la base de données!');
                    </script>";
            }  
        }else{
            echo "<script type='text/javascript'>document.location.replace('absence.php');
                alert('Vos dates se superposent avec des dates déjà enregistrées');
                </script>";
        }
    }
}
}
}
?>