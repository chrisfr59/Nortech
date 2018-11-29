<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/Main.css">
    <link rel="stylesheet" href="CSS/botstrap-grid.css">
    <title>Site Nortech</title>
    <script type="text/javascript">
        function confirmation(nom,prenom,id){
            if (confirm("Voulez-vous supprimer "+nom+" "+prenom+"?")) {
                chemin = "delete.php?id="+id;
                document.location.replace(chemin);
            }
            else{
                chemin = "redirection.php?section=employe";
                document.location.replace(chemin);
            }
        }
    </script>
</head>

<?php

    //Insertion de la bannière et de la navigation
    include('db_connect.php');
    $sql='select noEmp, nom, prenom from nortech.employe where noEmp = "'.$_GET['id'].'"';
    //Préparation de la requête SQL en utilisant la variable $connexion
    $req=$connexion->prepare($sql);
    //execuction de la requête avec enregistrement des résultats dans la variable $reponse
    //(boolean qui prend deux valeurs : 1 pour execute=ok et 0 pour execute=ko)
    $reponse=$req->execute(array());

    $resultat=$req->fetch();

    $nom = $resultat['nom'];
    $prenom = $resultat['prenom'];
    $id = $resultat['noEmp'];

    echo '<body onload="confirmation(\''.$nom.'\',\''.$prenom.'\','.$id.')">

    </body>';
?>
</html>