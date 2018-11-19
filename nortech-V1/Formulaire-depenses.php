<?php
//appeler la connexion à la BDD
include('db_connect.php');

//récupération de la section
/*if(isset($_GET['section'])){
	$section=$_GET['section'];
}else{
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Cette action est interdite 333!');
                </script>";
}
*/
//echo 'section:'.$section.'<BR>';

//appeler le bon fichier
/*if($section=='noemp'){*/
   
	

	/*$sql='select * from nortech.frais where identifiant= :id';
	// préparation de la requête SQL en utilisant la variable $connexion
	$req=$connexion->prepare($sql);
	//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
	$reponse=$req->execute(array('id'=>$id));
	//enregistrement des valeurs retournés par la requête dans la variable $resultat
	$resultat=$req->fetch();*/



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
                            <input type="number" name="noemp" class="form-control" placeholder="Numéro employé" value="" required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="decimals" name="montant" class="form-control" placeholder="Montant en €" value="" required/>
                        </div>
                        <br>
                        
                        <div class="form-date">
                       
                            <input type="date" name="date" class="form-date" placeholder="Date" value="" required/>
                        </div>
                        <br>
                        <div class="form-deroul">
                       
                        <select type="text" name="motif" class="form-deroul" required onChange="afficher()">
                        <option value="none" selected disabled>-- Choisissez un motif --</option> 
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
                        <textarea id="mots" name="autreMotif" class="form-controle" placeholder="Pour tout autre motif, merci d'expliquer en quelques mots ..." 
                        style="display: none ; width: 50%; height: 10%; margin-left: 25%; padding: 3%; padding: left 10%; border-radius :25%;"></textarea>
                        
                        <br>
                        <br>
                        <div class="form-btn">
                            <input type="submit" name="btnSubmit" class="btnContact" value="Envoyer" />
                        </div>
                        
                        <div class="form-btn">
                            <input type="reset" name="annuler" class="btnContact" value="Annuler" />
                        </div>
                </div>
            </form>
</div>
</body>
</html>
<?php
/*}else if($section=='employe'){
	echo 'form employé';
}else if($section=='service'){
	echo 'form service';
}else{//en cas de manipulation douteuse je redirige l'utilisateur vers redirection.php
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Cette action est interdite !');
                </script>";
}*/
?>