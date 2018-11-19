<?php
//demarrage de la session
session_start();
//connexion à la bdd
include('db_connect.php');
function rechercher($name){
    global $connexion;
    $existant= false;
    $req1 = $connexion->prepare("SELECT h.*,e.nom FROM historique h,employe e where h.identifiant=e.identifiant AND e.nom='$name' ");
    $reponse1=$req1->execute(array());
    if (isset($reponse1)){
        while($result=$req1->fetch()){
            if ($result['nom'] == $name)
            {
                echo '<div class="container">';
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo'<tr>';
                echo '<th scope="col">Date Connexion</th>';
                echo '<th scope="col">L\'adresse IP</th>';
                echo '<th scope="col">Poste</th>';
                echo '<th scope="col">Nom</th>';
                echo '</tr>';
                echo '</thead>';
                echo' <tbody>';
                echo '<tr>';
                echo '<td>'.$result['dateConnection'].'</td>';
                echo '<td>'.$result['adresseIP'].'</td>';
                echo '<td>'.$result['poste'].'</td>';
                echo '<td>'.$result['nom'].'</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo'</div>';
                $existant=true;
            }        
        }
    } 
            
    if ($existant==false){
        echo "Utilisateur non existant";
    }
}
                
?>
    
    <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
	<script src="main.js"></script>
</head>
<body>
<div class="container">
	<form class="border border-light p-5" method="POST">
	<p class="h4 mb-4 text-center">Recherche</p>
	<input type="text" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Nom" name="recherche">
	<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Valider" />
	<!-- -->
	</form>
</div>
<?php
//convertir le resultat de la recherche qq soit en maj mins ou les 2
@$_POST["recherche"]=strtoupper($_POST["recherche"]);
   if(isset($_POST["submit"])){
        $recherche=$_POST["recherche"];
        rechercher($recherche);
       }
    

       session_destroy();
    ?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>