<?php
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
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
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

/*
if(!$reponse){
	echo 'req a échoué';
}else{
	echo 'req ok';
}
*/
//enregistrement des valeurs retournés par la requête dans la variable $resultat
$resultat=$req->fetch();// fetch() permet de pointer sur la première ligne des résultats.
if($resultat){
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Identifiant déja utilisé par un autre utilisateur !');
                </script>";
}else{
	
	//requête d'insetion des données
	$sql='INSERT INTO `utilisateur`(`identifiant`, `motdePasse`) VALUES (:id,:mp)';
	$req=$connexion->prepare($sql);
	$reponse=$req->execute(array('id'=>$user,'mp'=>$mp));

	if(!$reponse){
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('l\'enregistrement de l\'utilisateur a échoué !');
                </script>";
	}else{
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Utilisateur enregistré avec succès !');
                </script>";
}

/*
echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Erreur de connexion à la base de données!');
                </script>";
*/
echo '---------------------------------------------<br>';
echo'<br><a href="redirection.php">Accueil</a>';
}
}

?>