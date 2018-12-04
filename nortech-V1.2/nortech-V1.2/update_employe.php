<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style1.css">
    <title>update</title>
</head>
<?php
$nav_en_cours ='employe';
include('header.php');
if( !isset ($_GET['id'])){//info en cas d'échec
    echo "<script type='text/javascript'>document.location.replace('employe.php');
       alert('id non trouvé!');
        </script>";
}

//requete sql
$req="select nom,prenom,fonction,sup,embauche,sal,comm,noServ,naissance,tel,mail,prime from nortech.employe where noemp='{$_GET['id']}'";
//connection bdd
try{
    $connexion= new PDO('mysql:host=localhost;dbname=nortech','root','');
    $test=$connexion->query($req);  
}
catch (PDOException $e){
    print "Erreur!:".$e->getMessage().'<br>';
    echo "<script type='text/javascript'>document.location.replace('update.php');
       alert('Erreur de connection à la base de données!');
        </script>";
}

$sql="select noEmp from nortech.employe";
$req2=$connexion->query($sql);
$tabNoEmp=array();
while($reponse=$req2->fetch()){
    array_push($tabNoEmp, $reponse['noEmp']);
}

$key=array_search($_GET['id'], $tabNoEmp);

if(gettype($key)=='boolean'){
    echo "<script type='text/javascript'>document.location.replace('employe.php');
       alert('L\'employé sélectionné n\'existe pas!');
        </script>";
}

$resultat=$test->fetch();//résultat et affichage du nom
$_SESSION['nomUp']=$resultat['nom'];
$_SESSION['prenomUp']=$resultat['prenom'];
?>
<!-- tableau de présentation update-->
<body>
<form name="update" method="POST" action="traitement_update.php">
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <form name="update_employe" method="post" action="">
                <fieldset id="section">
                    <legend>Modifier Employé</legend>
                    
                    <label for="nom">Nom : </label>
                    <input class="input" type="text" value="<?php  echo $resultat['nom'];?>" name="nom" id="nom" disabled="disabled" required><br><br>

                    <label for="prenom">Prénom : </label>
                    <input class="input" type="text" value="<?php  echo $resultat['prenom'];?>"  name="prenom" id="prenom" disabled="disabled" required><br><br>

                     <label for="fonction">Fonction : </label>
                    <select name="fonction" id="fonction">
                    <option value="<?php echo $resultat['fonction']?>"><?php echo ucwords(strtolower($resultat['fonction']))?></option>
                        <option value="PRESIDENT">Président</option>
                        <option value="DIRECTEUR">Directeur</option>
                        <option value="DRH">DRH</option>
                        <option value="EMPLOYE_RH">Employé RH</option>
                        <option value="COMPTABLE">Comptable</option>
                        <option value="VENDEUR">Vendeur</option>
                        <option value="SUPERVISEUR">Supérviseur</option>
                        <option value="ANALYSTE">Analyste</option>
                        <option value="PROGRAMMEUR">Programmeur</option>
                        <option value="SECRETAIRE">Secrétaire</option>
                        <option value="PUPITREUR">Pupitreur</option>
                        <option value="TECHNICIEN">Technicien</option>
                        <option value="BALAYEUR">Balayeur</option>
                    </select>
                    <br><br>

                    <label for="sup">Supérieur : </label>
                    <input class="input" type="number" value="<?php  echo $resultat['sup'];?>"  name="sup" id="sup"><br><br>

                    <label for="embauche">Date Embauche : </label>
                    <input class="input" type="date" value="<?php  echo $resultat['embauche'];?>" name="embauche" id="embauche" disabled="disabled"><br><br>

                    <label for="sal">Salaire : </label>
                    <input class="input" type="number" step="0.01" value="<?php  echo $resultat['sal'];?>"  name="sal" id="sal"><br><br>

                    <label for="comm">Commission : </label>
                    <input class="input" type="number" step="0.01" value="<?php  echo $resultat['comm'];?>"  name="comm" id="comm"><br><br>

                    <label for="prime">Prime : </label>
                    <input class="input" type="number" step="0.01" value="<?php  echo $resultat['prime'];?>"  name="prime" id="prime"><br><br>

                    <label for="dtn">Date de naissance : </label>
                    <input class="input" type="date" value="<?php  echo $resultat['naissance'];?>" name="dtn" id="dtn" disabled="disabled"><br><br>

                    <label for="mail">Adresse e-mail : </label>
                    <input class="input" type="mail" value="<?php  echo $resultat['mail'];?>"  name="mail" id="mail" required><br><br>

                    <label for="Noserv">Service : </label>
                    <select name="Noserv" id="Noserv">
                        <option value="<?php echo $resultat['noServ']?>"><?php echo $resultat['noServ']?></option>
                        <option value="1">Direction</option>
                        <option value="2">Logistique</option>
                        <option value="3">Ventes</option>
                        <option value="4">Formation</option>
                        <option value="5">Informatique</option>
                        <option value="6">Comptabilité</option>
                        <option value="7">Technique</option>
                        <option value="8">Ressources humaines</option>
                    </select>
                    <br><br>

                    <label for="tel">Téléphone : </label>
                    <input class="input" type="tel" value="<?php  echo $resultat['tel'];?>"  name="tel" id="tel"><br><br>

                    
                </fieldset>
                <!--boutton-->
                    <br>
                    <input class="submit" type="submit" value="update"> 
                    <br>
                    <br>
                    <form>
                    <a class="button" type="button" value="Retour" href="redirection.php?section=employe">Retour</a>
                    </form>
            </form>
        
    </div>
</div>
</body>
</html>