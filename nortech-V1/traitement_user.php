<?php



if ($action=='ajouter'){
// récupération des valeurs des champs dans le formulaire add_user
$user=$_POST['id_user'];
$mp=$_POST['mp_user'];
$mpc=$_POST['mpc_user'];

//affichage des valeurs des variables déclarées
echo 'user:'.$user.'<br>mp:'.$mp.'<br>mpc :'.$mpc.'<br>';

//inspecter les valeurs de la variable $_POST
//var_dump($_POST);

//vérification du mp communiqué par l'utilisateur
if($mp!=$mpc){
	echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('Veuillez saisir deux mots de passe identiques !');
                </script>";
}else{
 echo 'Vous avez communiqué :<br>-Identifiant: '.$user.'<br>-Mot de passe: '.$mp.' <br>';
 //déclaration de la requête SQL avec paramètre (:param)
$sql='select * from nortech.utilisateur where identifiant= :id';
// préparation de la requête SQL en utilisant la variable $connexion
$req=$connexion->prepare($sql);
//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
$reponse=$req->execute(array('id'=>$user));

/* Tester l'exécution de la requête
if(!$reponse){
	echo 'req a échoué';
}else{
	echo 'req ok';
}
*/


//enregistrement des valeurs retournés par la requête dans la variable $resultat
$resultat=$req->fetch();// fetch() permet de pointer sur la première ligne des résultats.
if($resultat){
	echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('Identifiant déja utilisé par un autre utilisateur !');
                </script>";
}else{
	
	//requête d'insetion des données
	$sql='INSERT INTO `utilisateur`(`identifiant`, `motdePasse`) VALUES (:id,:mp)';
	$req=$connexion->prepare($sql);
	$reponse=$req->execute(array('id'=>$user,'mp'=>$mp));

	if(!$reponse){
	echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('l\'enregistrement de l\'utilisateur a échoué !');
                </script>";
	}else{
	echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('Utilisateur enregistré avec succès !');
                </script>";
}
}
}
}else if ($action=='supprimer'){
	
	//récupération de la valeur du champ id_user
	$id=$_POST['id_user'];
	 //déclaration de la requête SQL avec paramètre (:param)
	$sql='select * from nortech.utilisateur where identifiant= :id';
	// préparation de la requête SQL en utilisant la variable $connexion
	$req=$connexion->prepare($sql);
	//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
	$reponse=$req->execute(array('id'=>$id));

	$resultat=$req->fetch();// fetch() permet de pointer sur la première ligne des résultats.
	if(!$resultat){
	echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('Cet utilisateur n\'est pas enregistré dans la BDD!');
                </script>";
	}else{

		$sql='DELETE FROM nortech.utilisateur WHERE identifiant=:id';
	// préparation de la requête SQL en utilisant la variable $connexion
	$req=$connexion->prepare($sql);
	//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
	$reponse=$req->execute(array('id'=>$id));

	//$resultat=$req->fetch();// fetch() permet de pointer sur la première ligne des résultats.
	if(!$reponse){
	echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('La suppression de cet utilisateur a échoué!');
                </script>";
	}else{

		echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('Utilisateur supprimé avec succè!');
                </script>";
	}
	}


}else if ($action=='update'){
$id=$_GET['id'];	
$user=$_POST['id_user'];
$mp=$_POST['mp_user'];
$mpc=$_POST['mpc_user'];

//affichage des valeurs des variables déclarées
echo 'user:'.$user.'<br>mp:'.$mp.'<br>mpc :'.$mpc.'<br>';

if($mp!=$mpc){
	echo "<script type='text/javascript'>document.location.replace('update.php?section=".$section."&id=".$id."');
                alert('Veuillez saisir deux mots de passe identiques !');
                </script>";
}else{
 	$sql='select * from nortech.utilisateur where identifiant= :id';
	// préparation de la requête SQL en utilisant la variable $connexion
	$req=$connexion->prepare($sql);
	//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
	$reponse=$req->execute(array('id'=>$id));
	//enregistrement des valeurs retournés par la requête dans la variable $resultat
	$resultat=$req->fetch();

	if(!$resultat){
		echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('Impossible de mettre à jour un utilisateur inconnu !');
                </script>";
	}else{
		$sql='select * from nortech.utilisateur where identifiant= :id';
	// préparation de la requête SQL en utilisant la variable $connexion
	$req=$connexion->prepare($sql);
	//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
	$reponse=$req->execute(array('id'=>$user));
	//enregistrement des valeurs retournés par la requête dans la variable $resultat
	$resultat=$req->fetch();

	if($resultat){
		echo "<script type='text/javascript'>document.location.replace('update.php?section=".$section."&id=".$id."');
                alert('Vous ne pouvez prendre cet identifiant !');
                </script>";
	}else{
			$sql='UPDATE utilisateur SET identifiant=:user,motdePasse=:mp WHERE identifiant=:id';
	// préparation de la requête SQL en utilisant la variable $connexion
	$req=$connexion->prepare($sql);
	//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
	$reponse=$req->execute(array('id'=>$id,'user'=>$user,'mp'=>$mp));

	//$resultat=$req->fetch();// fetch() permet de pointer sur la première ligne des résultats.
	if(!$reponse){
	echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('La mise àjour de cet utilisateur a échoué!');
                </script>";
	}else{

		echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('Mise à jour effectué avec succè!');
                </script>";
	}
	}
	}
 }





}else{
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Cette est interdite !');
                </script>";
}




/*



/*
echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Erreur de connexion à la base de données!');
                </script>";
*/
                /*
echo '---------------------------------------------<br>';
echo'<br><a href="redirection.php">Accueil</a>';
}
}
*/
?>