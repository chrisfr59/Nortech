<?php

include('db_connect.php');

//stock le nom, prenom, date début, date fin, motif
if(isset($_POST['noEmp'])){
    $noEmp=$_POST['noEmp'];
    $dateAbsD=$_POST['dateAbsD'];
    $dateAbsF=$_POST['dateAbsF'];
    $motif=$_POST['motif'];
    $bouton=$_POST['envoyer'];
    $type=$_POST['abs'];
    $dateJour = date("d");
    $dateMois = date("m");
    $dateAnnee = date("Y");

    if(isset($_POST['justificatif'])){
    //recupère le justificatif 
    $file=$_FILES['justificatif']['name'];

    //recupère l'extension du fichier
    $fileextension=strrchr($file,".");

    //stockage dans un dossier temp 
    $filetmp=$_FILES['justificatif']['tmp_name'];

    //donne le répertoire de stockage 
    $filedest='fichier/'.$file;

    //le déplace dans le dossier fichier 
    move_uploaded_file($filetmp,$filedest);

    //renomme le justificatif  
    rename("$filedest", "fichier/ $noEmp - $motif - du $dateAbsD au $dateAbsF $fileextension");
    }

    if($bouton==true){
        
        $tabDateD=explode("-", $dateAbsD);
        $tabDateF=explode("-", $dateAbsF);
        $nbrPris=(mktime(12,0,0, $tabDateF[1], $tabDateF[2], $tabDateF[0]) - mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0]))/60/60/24;
        
        //cacher/afficher les informations en fonction de la valeur du radio 
        //cacher le justificatif, rendre le motif facultatif, enlever le justificatif

/*Condition permettant de limiter le choix des dates : 
- Impossible de prendre des congés pour une date inférieure ou égale à la date du jour
- La date de fin ne peut être inférieure à la date de début (pour absences et congés)*/
if($type=='conge'){
    if($tabDateD[0] == $tabDateF[0]){
        echo mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0])."<br>";
        echo mktime(12,0,0, $dateMois, $dateJour, $dateAnnee)."<br>";
        if ((mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0]) - mktime(12,0,0, $dateMois, $dateJour, $dateAnnee)) <= 0){
            echo "<script type='text/javascript'>document.location.replace('absence.php');
            alert('La date choisie doit être supérieure à la date du jour.');
            </script>";
        }else{
            if ((mktime(12,0,0, $tabDateF[1], $tabDateF[2], $tabDateF[0]) - mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0])) < 0){
                echo "<script type='text/javascript'>document.location.replace('absence.php');
                    alert('La date de fin ne peut pas être inférieure à la date de début.');
                    </script>";
            }else{
    
                $req='INSERT INTO nortech.absence(dateAbsD, dateAbsF, motif, nbJPris, noEmp) VALUES("'.$dateAbsD.'","'.$dateAbsF.'","'.$motif.'","'.$nbrPris.'","'.$noEmp.'")';
            try{
                $connexion= new PDO('mysql:host=localhost;dbname=nortech','root','');
                $test=$connexion->query($req);
                echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso.php');
                   alert('Votre demande de congés a bien été prise en compte.');
                    </script>";
            }
            catch (PDOException $e){
                print "Erreur!:".$e->getMessage().'<br>';
                echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso.php');
                   alert('Erreur de connection à la base de données!');
                    </script>";
            }
            
            $resultat=$test->fetch();
            }
        }
    }else{
        echo mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0])."<br>";
        echo mktime(12,0,0, $dateMois, $dateJour, $dateAnnee)."<br>";
        if ((mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0]) - mktime(12,0,0, $dateMois, $dateJour, $dateAnnee)) <= 0){
            echo "<script type='text/javascript'>//document.location.replace('absence.php');
            alert('La date choisie doit être supérieure à la date du jour.');
            </script>";
        }else{
            if ((mktime(12,0,0, $tabDateF[1], $tabDateF[2], $tabDateF[0]) - mktime(12,0,0, $tabDateD[1], $tabDateD[2], $tabDateD[0])) > 0){
                $req='INSERT INTO nortech.absence(dateAbsD, dateAbsF, motif, nbJPris, noEmp) VALUES("'.$dateAbsD.'","'.$dateAbsF.'","'.$motif.'","'.$nbrPris.'","'.$noEmp.'")';
            try{
                $connexion= new PDO('mysql:host=localhost;dbname=nortech','root','');
                $test=$connexion->query($req);
                echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso.php');
                   alert('Votre demande de congés a bien été prise en compte.');
                    </script>";
            }
            catch (PDOException $e){
                print "Erreur!:".$e->getMessage().'<br>';
                echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso.php');
                   alert('Erreur de connection à la base de données!');
                    </script>";
            }
            
            $resultat=$test->fetch();

            }else{
    
                echo "<script type='text/javascript'>document.location.replace('absence.php');
                    alert('La date choisie doit être supérieure à la date du jour.');
                    </script>";
            }
        }
    }
}else if($type=='absence'){
    if ((mktime($tabDateF[1], $tabDateF[2], $tabDateF[0]) - mktime($tabDateD[1], $tabDateD[2], $tabDateD[0])) < 0){
        echo "<script type='text/javascript'>document.location.replace('absence.php');
            alert('La date de fin ne peut pas être inférieure à la date de début.');
            </script>";
    }else{
        $req='INSERT INTO nortech.absence(dateAbsD, dateAbsF, motif, nbJPris, noEmp) VALUES("'.$dateAbsD.'","'.$dateAbsF.'","'.$motif.'","0","'.$noEmp.'")';
        echo $req;
        try{
            $connexion= new PDO('mysql:host=localhost;dbname=nortech','root','');
            $test=$connexion->query($req);
            echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso.php');
               alert('Votre déclaration d\'absence a bien été pris en compte.');
                </script>";
        }
        catch (PDOException $e){
            print "Erreur!:".$e->getMessage().'<br>';
            echo "<script type='text/javascript'>document.location.replace('redirection.php?section=espace_perso.php');
               alert('Erreur de connection à la base de données!');
                </script>";
        }
        
        $resultat=$test->fetch();
    }
}
}
}

?>