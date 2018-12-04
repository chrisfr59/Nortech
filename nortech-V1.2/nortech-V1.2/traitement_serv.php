<?php


if ($action=='ajouter'){
	// récupération des valeurs des champs dans le formulaire SERVICE
	$noServ=$_POST['no_serv'];
	$service=$_POST['service'];
	$ville=$_POST['ville'];
	
	//affichage des valeurs des variables déclarées
	//echo 'noServ:'.$noServ.'<br>service:'.$service.'<br>ville :'.$ville.'<br>';
			 
	 //déclaration de la requête SQL avec paramètre (:param)
	$sql='select * from nortech.service where noserv= :numServ';
	// préparation de la requête SQL en utilisant la variable $connexion
	$req=$connexion->prepare($sql);
	//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
	$reponse=$req->execute(array('numServ'=>$noServ));
			
	//enregistrement des valeurs retournés par la requête dans la variable $resultat
	$resultat=$req->fetch();  // fetch() permet de pointer sur la première ligne des résultats.
	if($resultat){
		echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
					alert('le Numéro déja utilisé par un autre service !');
					</script>";
	}else{
		
		//requête d'insetion des données
		$sql='INSERT INTO `service`(`noServ`, `service`, `ville`) VALUES (:numServ,:serv,:ville)';
		$req=$connexion->prepare($sql);
		$reponse=$req->execute(array('numServ'=>$noServ,'serv'=>$service,'ville'=>$ville));
	
		if(!$reponse){
		echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
					alert('l\'enregistrement de Service a échoué !');
					</script>";
		}else{
		echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
					alert('Service enregistré avec succès !');
					</script>";
	}
	}
	}else if ($action=='supprimer'){
	
		//récupération de la valeur du champ id_user
		$numServ=$_POST['no_serv'];
		 //déclaration de la requête SQL avec paramètre (:param)
		$sql='select * from nortech.service where noserv= :numServ';
		// préparation de la requête SQL en utilisant la variable $connexion
		$req=$connexion->prepare($sql);
		//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
		$reponse=$req->execute(array('numServ'=>$numServ));
	
		$resultat=$req->fetch();// fetch() permet de pointer sur la première ligne des résultats.
		if(!$resultat){
		echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
					alert('Ce service n\'est pas enregistré dans la BDD!');
					</script>";
		}else{
			$sql='select * from nortech.employe where noserv=:numServ';
			$req=$connexion->prepare($sql);
			//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
			$reponse=$req->execute(array('numServ'=>$numServ));	
			$resultat=$req->fetch();// fetch() permet de pointer sur la première ligne des résultats.
			if($resultat){
				echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
							alert('impossible de supprimer un service contenant des employés!');
							</script>";
			}else{	
			$sql='DELETE FROM nortech.service WHERE  noserv=:numServ';
		// préparation de la requête SQL en utilisant la variable $connexion
		$req=$connexion->prepare($sql);
		//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
		$reponse=$req->execute(array('numServ'=>$numServ));
	
		//$resultat=$req->fetch();// fetch() permet de pointer sur la première ligne des résultats.
		if(!$reponse){
		echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
					alert('La suppression de ce service a échoué!');
					</script>";
		}else{
	
			echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
					alert('Service supprimé avec succès!');
					</script>";
		}
		}
	}
	}else if ($action=='update'){
		
		$numServ=$_GET['numServ'];			
		$noServ=$_POST['no_serv'];
		$service=$_POST['service'];
		$ville=$_POST['ville'];
		//$depenses=$_POST['depenses'];
		//affichage des valeurs des variables déclarées
		//echo 'N° service:'.$noServ.'<br>service:'.$service.'<br>ville :'.$ville.'<br>';
		
			 $sql='select * from nortech.service where noserv= :numServ';
			// préparation de la requête SQL en utilisant la variable $connexion
			$req=$connexion->prepare($sql);
			//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
			$reponse=$req->execute(array('numServ'=>$numServ));
			//enregistrement des valeurs retournés par la requête dans la variable $resultat
			$resultat=$req->fetch();
		
			if(!$resultat){
				echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
						alert('Impossible de mettre à jour un service inconnu !');
						</script>";
			}else{
				
				$sql='select * from nortech.service where noserv= :numServ';
				// préparation de la requête SQL en utilisant la variable $connexion
				$req=$connexion->prepare($sql);
				
				//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
				$reponse=$req->execute(array('numServ'=>$noServ));
				//enregistrement des valeurs retournés par la requête dans la variable $resultat
				$resultat=$req->fetch();
		
			if($resultat){
				echo "<script type='text/javascript'>document.location.replace('update.php?section=service&numServ=".$numServ."');
						alert('Vous ne pouvez pas prendre ce  service !');
						</script>";
			}else{
				$sql="UPDATE service SET service=:service,ville=:ville WHERE noserv=:numServ";
				// préparation de la requête SQL en utilisant la variable $connexion
				$req=$connexion->prepare($sql);
				//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
				$reponse=$req->execute(array('numServ'=>$numServ,'service'=>$service,'ville'=>$ville));
				
					//$resultat=$req->fetch();// fetch() permet de pointer sur la première ligne des résultats.
			if(!$reponse){
				echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
						alert('La mise à jour de ce service a échoué!');
						</script>";
			}else{
		
				
				echo "<script type='text/javascript'>document.location.replace('redirection.php?section=service');
						alert('Mise à jour effectué avec succè!');
						</script>";
			}
			}
			}
}else{
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Cette est interdite !');
                </script>";
}
?>