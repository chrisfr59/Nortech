<!DOCTYPE html> 
<html lang="fr">
	<head>
		<title>NorTech - Bienvenue</title>
		<meta charset="utf-8">
		<meta name="description" content="Produit, fournisseur, commande">
		<meta name="author" content="SACI_MH"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="offre.css">
		<link rel="icon" type="image/png" href="icons/icon_formation.png">
		
	</head>
	<body>
		<header>
			<div style="text-align: center;width: 100%;background-color:white;color: #0da54a; ">
				<p style="font-size: 22px;">Bienvenue sur le site de maFormation</p>
			</div>
			<nav>
				<ul>	

					<li><a href="redirection.php?section=espace_perso"> <li id="recherche"> Espace Personnel</a> </li> 		
					<li><a href="redirection.php?section=service"> <li id="recherche"> Service</a> </li> 
					<li><a href="redirection.php?section=employe"> <li id="recherche"> Employé </a></li> 	
					<li><a href="redirection.php?section=user"> <li id="recherche"> Utilisateur </a></li> 
					<li><a href="redirection.php?section=Offreemploi"> <li id="recherche"> Offres d'emploi </a></li> 					
				</ul>	
			</nav>
			<?php session_start();?>
			<h3>Bonjour <?php echo $_SESSION['nom'].' '.$_SESSION['prenom'];?></h3>
			<p>dernière connexion <?php echo $_SESSION['dateConnection'];?></p>
    		<button id="button1"><a href="deconnexion.php">Déconnexion</a></button>	
		</header>
<?php
include('db_connect.php');
?>

	