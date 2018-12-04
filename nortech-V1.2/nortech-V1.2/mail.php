<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/botstrap-grid.css">
    <title>Site Nortech</title>
</head>

<?php
session_start();
$_SESSION=array_merge($_SESSION,$_POST);
include('db_connect.php');

if(isset($_SESSION['Envoi'])){
    if(empty($_SESSION['mail'])){
        echo "<script type='text/javascript'>document.location.replace('employe.php');
        alert('Veuillez cochez une case.');
        </script>";
    }
    else{
        $liste='';
        $destinataire='';
        $i=0;
        while($i<count($_SESSION['mail'])){
            $temp=substr($_SESSION['mail'][$i],0,(count($_SESSION['mail'][$i])-17));
            $temp=ucwords(strtr($temp,'.',' '));
            $liste=$liste.', '.$temp;
            $destinataire=$destinataire.', '.$_SESSION['mail'][$i];
            $i++;
        }
        $liste=substr($liste,1);
        $destinataire=substr($destinataire,1);

        if(isset($_SESSION['sujet'])){
            $sujet=$_SESSION['sujet'];
            $message=wordwrap($_SESSION['message'],70,"\n", false);
            mail($destinataire, $sujet, $message);
        }
        ?>

        <body>
            <form name="mail" method="post" action="">
                <fieldset id="section">
                    <p>Destinataire : <?php echo $liste;?></p>
                    <legend>Mail</legend>
                    <label for="sujet">Sujet : </label>
                    <input class="input" type="text" name="sujet" id="sujet" required><br><br>

                    <label for="message">Message : </label>
                    <textarea name="message" id="message" required></textarea><br><br>

                    <input type="submit" value="Envoyer">
                </fieldset>
            </form>
            <br><a href="employe.php">Retour à la liste des employés</a>
        </body>

        <?php
    }
}
else if(isset($_SESSION['CV'])){
    if(empty($_SESSION['mail'])){
        echo "<script type='text/javascript'>document.location.replace('employe.php');
        alert('Veuillez cochez une case.');
        </script>";
    }
    else{
       $i=0;
        while($i<count($_SESSION['mail'])){

            $sql='select noEmp, nom, prenom from nortech.employe where mail like "'.$_SESSION['mail'][$i].'"';
            //Préparation de la requête SQL en utilisant la variable $connexion
            $req=$connexion->prepare($sql);
            //execuction de la requête avec enregistrement des résultats dans la variable $reponse
            //(boolean qui prend deux valeurs : 1 pour execute=ok et 0 pour execute=ko)
            $reponse=$req->execute(array());

            $resultat=$req->fetch();

            $fichier= 'CV/'.$resultat['noEmp'].'_'.$resultat['nom'].'_'.$resultat['prenom'].'.pdf';

            echo '<iframe src="'.$fichier.'" width="600" height="800" align="middle"></iframe>';
            
            $i++;
        }
        echo '<br><a href="employe.php">Retour à la liste des employés</a>'; 
    }
}

?>

</html>