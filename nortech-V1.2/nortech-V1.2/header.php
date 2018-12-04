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
  <link rel="icon" type="image/png" href="icons/icon_formation.png">
		<link rel="stylesheet" type="text/css" href="css/perso.css">

		
	</head>
	<body>
		<header>
			<div class="titre">
			<h1>
        Bienvenue sur le site de <span class="letter" >Nor</span><span class="letter1">tech</span> 
	  </h1>
	  </div>
	  <div class="info">
	  			<?php session_start();?>
			<h5>Bonjour <?php echo $_SESSION['nom'].' '.$_SESSION['prenom'];?></h5>
			<p>dernière connexion <?php echo $_SESSION['dateConnection'];?></p>
			<button id="button1"><a href="deconnexion.php">Déconnexion</a></button>
			</div>
			<nav>
				<ul>	
					<li <?php if ($nav_en_cours == 'espace_perso') {echo ' id="en-cours"';} ?>><a href="redirection.php?section=espace_perso" id="recherche"> Espace Personnel</a></li> 		
					<li <?php if ($nav_en_cours == 'service') {echo ' id="en-cours"';} ?>><a href="redirection.php?section=service" id="recherche"> Service</a> </li> 
					<li <?php if ($nav_en_cours == 'employe') {echo ' id="en-cours"';} ?>><a href="redirection.php?section=employe" id="recherche"> Employé </a></li> 	
					<li <?php if ($nav_en_cours == 'user') {echo ' id="en-cours"';} ?>><a href="redirection.php?section=user" id="recherche"> Utilisateur </a></li> 
					<li <?php if ($nav_en_cours == 'offre_emploi') {echo ' id="en-cours"';} ?>><a href="redirection.php?section=offreemploi" id="recherche"> Offres d'emploi </a></li> 					
				</ul>	
			</nav>
	
		</header>
<?php
include('db_connect.php');
?>

	