<?php
//appeler la connexion à la BDD
include('db_connect.php');

//récupération de la section : service/employé ou user
if(isset($_GET['section'])){
	$section=$_GET['section'];
}else{
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Cette est interdite !');
                </script>";
}

//echo 'section:'.$section.'<BR>';

//appeler le bon fichier
if($section=='user'){
	$id=$_GET['id'];

	$sql='select * from nortech.utilisateur where identifiant= :id';
	// préparation de la requête SQL en utilisant la variable $connexion
	$req=$connexion->prepare($sql);
	//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
	$reponse=$req->execute(array('id'=>$id));
	//enregistrement des valeurs retournés par la requête dans la variable $resultat
	$resultat=$req->fetch();

?>
<div class='formulaire_post'>
    <fieldset>
        <legend align="center"> Mettre à jour un utilisateur</legend>
        <form name="update_user" method="POST" action="traitement.php?section=user&action=update&id=<?php echo $id;?>" >
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="id_user">Id utilisateur </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="id_user" class='input' value="<?php echo $resultat['identifiant'];?>" required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="mp_user"> Password </label>
                </div>
                <div style="width:50%;">
                    <input type="password" name="mp_user" class='input' value="<?php echo $resultat['motdePasse'];?>" required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="mpc_user"> Confirmation Password </label>
                </div>
                <div style="width:50%;">
                    <input type="password" name="mpc_user" class='input' value="<?php echo $resultat['motdePasse'];?>" required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <input type="submit" class="button" value="Envoyer">
                </div>
                <div style="width:25%;">
                    <input type="reset" class="button" value="Effacer">
                </div>
            </div>
        </form>
    </fieldset>
    </div>
	
<?php










}else if($section=='employe'){
	echo 'form employé';
}else if($section=='service'){
    include('header.php');
    $numServ=$_GET['numServ'];
    include('update_service.php');
    
    include('footer.php');
}elseif($section=='offre'){
    if($section=='offre'){
        $id=$_GET['noffre'];
    
        $sql='select * from nortech.annonce where noAnnonce= :id';
        // préparation de la requête SQL en utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
        $reponse=$req->execute(array('id'=>$id));
        //enregistrement des valeurs retournés par la requête dans la variable $resultat
        $resultat=$req->fetch();
    }
    ?>
    <div class='update'>
    <h1>
        Modifier une annonce
    </h1>
    <form name="offre" method="post" action="traitement.php?section=offre&action=update&id=<?php echo $id;?>">

        <div class=''>
            <label for="noannonce">Offre N°</label><br>
            <input type="number" name="noannonce" id="noannonce" value="<?php echo $resultat['noAnnonce'];?>" required />
        </div><br>

        <div class=''>
            <label for="titre">Titre</label><br>
            <input type="text" name="titre" id="titre" value="<?php echo $resultat['titre'];?>"required/>
        </div><br>

        <div class=''>
            <label for="service">Service</label><br>
            <input type="text" name="service" id="service" value="<?php echo $resultat['service'];?>" required/>
        </div><br>

        <div class=''>
            <label for="date">Date</label><br>
            <input type="date" name="dat" id="date"value="<?php echo $resultat['dateAnnonce'];?>" required/>
        </div><br>

        <div class=''>
            <label for="ville">Ville</label><br>
            <input type="text" name="ville" id="ville" value="<?php echo $resultat['ville'];?>" required/>

        <div class=''>
            <label for="description">Description</label><br>
            <textarea type="text" name="descrip" id="description" cols=45 rows=20 required><?php echo $resultat['description'];?></textarea>
        </div><br><br>

        
        </div><br>

        <input type="submit" value="OK" />
        <input type="reset" value="annuler" />




    </form>
</div>
<?php

}elseif($section="uemploye"){
    if( !isset ($_GET['id'])){//info en cas d'échec
        echo "<script type='text/javascript'>document.location.replace('Tableaux_Complet.php');
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
    
    if($key==false){
        echo "<script type='text/javascript'>document.location.replace('Tableaux_Complet.php');
           alert('L'employé sélectionné n'existe pas!');
            </script>";
    }
    
    $resultat=$test->fetch();//résultat et affichage du nom
    
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
                        <input class="input" type="text" value="<?php  echo $resultat['nom'];?>" name="nom" id="nom" required><br><br>
    
                        <label for="prenom">Prénom : </label>
                        <input class="input" type="text" value="<?php  echo $resultat['prenom'];?>"  name="prenom" id="prenom" required><br><br>
    
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
                        <input class="input" type="date" value="<?php  echo $resultat['embauche'];?>" name="embauche" id="embauche"><br><br>
    
                        <label for="sal">Salaire : </label>
                        <input class="input" type="text" value="<?php  echo $resultat['sal'];?>"  name="sal" id="sal"><br><br>
    
                        <label for="comm">Commission : </label>
                        <input class="input" type="text" value="<?php  echo $resultat['comm'];?>"  name="comm" id="comm"><br><br>
    
                        <label for="prime">Prime : </label>
                        <input class="input" type="text" value="<?php  echo $resultat['prime'];?>"  name="prime" id="prime"><br><br>
    
                        <label for="dtn">Date de naissance : </label>
                        <input class="input" type="date" value="<?php  echo $resultat['naissance'];?>" name="dtn" id="dtn"><br><br>
    
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
                        <input class="submit" type="submit" value="update"> 
                        <br>
                        <br>
                        <form>
                        <input type="button" value="Retour" onclick="history.go(-1)">
                        </form>
                </form>
            
        </div>
    </div>
    <?php
}else{//en cas de manipulation douteuse je redirige l'utilisateur vers redirection.php
	echo "<script type='text/javascript'>document.location.replace('redirection.php?section=Offre_d_emploi');
                alert('Cette action est interdite !');
                </script>";
}









