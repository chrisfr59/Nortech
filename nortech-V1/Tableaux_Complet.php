<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/Main.css">
    <link rel="stylesheet" href="CSS/botstrap-grid.css">
    <title>Site Nortech</title>
</head>

<body>
<?php
include('header.php');
//session_start();
unset($_SESSION['mail']);
unset($_SESSION['sujet']);
unset($_SESSION['message']);
unset($_SESSION['CV']);
unset($_SESSION['Envoi']);
//Insertion de la bannière et de la navigation


if(!empty($_GET['recherche'])){
    if($_GET['recherche']=='Fonction'){
        $sql='select * from nortech.employe where fonction like'.$_GET['Fonction'].' and active=1';
    }
    else if($_GET['recherche']=='Service'){
        $sql='select * from nortech.employe where noServ like'.$_GET['Service'].' and active=1';
    }
    else{
        $sql='select * from nortech.employe where active=1';
    }
}
else{
    $sql='select * from nortech.employe where active=1';
}
//Préparation de la requête SQL en utilisant la variable $connexion
$req=$connexion->prepare($sql);
//execuction de la requête avec enregistrement des résultats dans la variable $reponse
//(boolean qui prend deux valeurs : 1 pour execute=ok et 0 pour execute=ko)
$reponse=$req->execute(array());
?>

<script type="text/javascript">
   function confirme(id) {
       if (confirm("Voulez-vous supprimer ?")) { 
        chemin = "delete.php?id=" + id;
        document.location.replace(chemin);
        //alert(chemin);
       }
   }
</script>

<ul class="niveau1">
    <li class="tri"><a href="#">recherche</a>
        <ul class="niveau2">
            <li class="plus"><a href="#">Fonction</a>
                <ul class="niveau3">
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='PRESIDENT'">Président</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='SECRETAIRE'">Secrétaire</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='VENDEUR'">Vendeur</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='TECHNICIEN'">Technicien</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='COMPTABLE'">Comptable</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='DIRECTEUR'">Directeur</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='ANALYSTE'">Analyste</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='PROGRAMMEUR'">Programmeur</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='PUPITREUR'">Pupitreur</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='BALAYEUR'">Balayeur</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction='SUPERVISEUR'">Superviseur</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Fonction&Fonction=DRH">DRH</a></li>
                </ul>
            </li>        
            <li class="plus"><a href="#">Service</a>
                <ul class="niveau3">
                    <li><a href="Tableaux_Complet.php?recherche=Service&Service='1'">Direction</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Service&Service='2'">Logistique</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Service&Service='3'">Ventes</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Service&Service='4'">Formation</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Service&Service='5'">Informatique</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Service&Service='6'">Comptabilite</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Service&Service='7'">Technique</a></li>
                    <li><a href="Tableaux_Complet.php?recherche=Service&Service='8'">Ressource Humaine</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
<h3>Information sur le personnelles</h3>
<form id="mail" method="post" action="mail.php">
<table>
    <thead>
        <tr>
            <th></th>
            <th>noemp</th>
            <th>nom</th>
            <th>prenom</th>
            <th>fonction</th>
            <th>supérieur</th>
            <th>salaire</th>
            <th>commission</th>
            <th>naissance</th>
            <th>téléphone</th>
            <th>Service</th>
            <th>prime</th>
            <th>embauche</th>
            <th>mail</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
while($resultat=$req->fetch()){
    echo '<tr>';
    echo '<td><input type="checkbox" name="mail[]" value="'.$resultat['mail'].'"></td>
        <td>'.$resultat['noEmp'].'</td>
        <td>'.$resultat['nom'].'</td>
        <td>'.$resultat['prenom'].'</td>
        <td>'.$resultat['fonction'].'</td>
        <td>'.$resultat['sup'].'</td>
        <td>'.$resultat['sal'].'</td>
        <td>'.$resultat['comm'].'</td>
        <td>'.$resultat['naissance'].'</td>
        <td>'.$resultat['tel'].'</td>
        <td>'.$resultat['noServ'].'</td>
        <td>'.$resultat['prime'].'</td>
        <td>'.$resultat['embauche'].'</td>
        <td>'.$resultat['mail'].'</td>
        <td><a class="button" href="update.php?section=uemploye&id='.$resultat['noEmp'].'">Update</a>
        <a class="button" onclick="confirme('.$resultat['noEmp'].')" >Delete</a></td>';
    echo'</tr>';
}
?>
    </tbody>
</table>
<input class="submit" type="submit" name="Envoi" value="Envoyer Mail">
<input class="submit" type="submit" name="CV" value="Consulter CV">
</form>

</body>

</html>