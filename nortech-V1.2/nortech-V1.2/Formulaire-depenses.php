<?php
$nav_en_cours = 'espace_perso';
//appeler la connexion à la BDD
include('db_connect.php');
include ('header.php');


?>
<?php
$nom=$_SESSION['nom'];
$sql="SELECT e.noEmp FROM historique h,employe e where h.identifiant=e.identifiant AND e.nom=:nom group by e.nom";
$req=$connexion->prepare($sql);
$reponse=$req->execute(array('nom'=>$nom));
//$resultat=$reponse->fetch();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="offre.css">
    <script language="JavaScript">
    function afficher(){
        var a = document.getElementById("autre");
        var m = document.getElementById("mots");
    
        if (document.frais.motif.value == "Autre"){
            if (a.style.display == "none")
            a.style.display = "block";
           if (m.style.display == "none")
            m.style.display = "block";
        }
        else{
            a.style.display = "none"; 
            m.style.display = "none"; 
        }
    }
    
    </script>
</head>
<body>
<div class="container contact-form">
            <div class="contact-image">
                <img src="img/depenses.png" alt="dépenses"/>
            </div>
            <form name="frais" method="POST" action="traitement_frais.php?section=frais&action=ajouter">
                <h1>Note de Frais</h1>
               <div class="row">
              
                        <div class="form-group">
                            <input type="text" name="noemp" class="form-control" placeholder="Numéro employé" value="<?php while($resultat=$req->fetch()){
                                echo $resultat['noEmp'];}  ?>" readonly/>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="number" step='0.01' min="0" max="100000" name="montant" class="form-control" placeholder="Montant en €" value="" required/>
                        </div>
                        <br>
                        
                        <div class="form-date">
                       
                            <input type="date" name="date" min="2018-09-01" class="form-date" placeholder="Date" value="" required/>
                        </div>
                        
                        <br>
                        <div class="form-deroul">
                       
                        <select required type="text" name="motif" class="form-deroul" onChange="afficher()" >
                        <option value="" selected disabled>-- Choisissez un motif --</option> 
                                <option value="Carburant">Carburant</option>
                                <option value="Fournitures">Fournitures</option>
                                <option value="Hebergement">Hébergement</option>
                                <option value="Restauration">Restauration</option>
                                <option value="Autre">Autre</option>
                        </select>
                        <br>
                        </div>
                        <span id=autre style="display: none"></span>
                        <br>
                        <textarea value="" id="mots" name="autreMotif" class="form-controle" placeholder="Pour tout autre motif, merci d'expliquer en quelques mots ..." 
                        style="  display: none ; width: 50%; height: 10%; margin-left: 25%; padding: 3%; padding: left 10%; border-radius :25%;"></textarea>
                        
                        <br>
                        <br>
                        <div class="form-btn">
                            <input type="submit" name="btnSubmit" class="btnContact" value="Envoyer" />
                        </div>
                        <br>
                        <div class="form-btn">
                            <input type="reset" name="effacer" class="btnContact" value="Effacer" />
                        </div>
                        <br>
                        <div class="form-btn">
                        <a href="espace_perso.php"><input  type="button" value="Retour à l'espace personnel" ></a>
                        </div>
                </div>
            </form>
</div>
</body>
</html>
<?php
?>