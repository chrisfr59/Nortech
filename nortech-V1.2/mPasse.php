<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--css Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/perso.css" />
    <script src="main.js"></script>
</head>

<body>
<div class="container">
<?php
session_start();
//connexion à la bdd
include('db_connect.php');
function modifmP($iden){
    global $connexion;
    $existant= false;
    $req = $connexion->prepare("SELECT identifiant FROM utilisateur  where  identifiant='$iden' ");
    $reponse=$req->execute(array());
    if (isset($reponse)){
        while($result=$req->fetch()){
            if ($result['identifiant'] == $iden)
            {
                echo '<div class="container">';
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo'<tr>';
                echo '<th scope="col">Identifiant</th>';
                echo '<th scope="col">ModifierMP</th>';
                echo '</tr>';
                echo '</thead>';
                echo' <tbody>';
                echo '<tr>';
                echo '<td>'.$result['identifiant'].'</td>';
                echo '<td><button class="btn btn-warning  my-1" ><a href="updateMP.php?section=user&id='.$result['identifiant'].'">Modifier</a></button></td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo'</div>';
                $existant=true;
            }        
        }
    } 
            
    if ($existant==false){
        echo"<script type='text/javascript'>document.location.replace('user.php');
            alert('Utilisateur inexistant!!');</script>";
    }
}
               // action="lienUrl.php"
?>
<form class="border border-light p-5" method="GET" action="lienUrl.php">
	<p class="h4 mb-4 text-center">Saisissez votre adresse email dans le champ ci-dessous</p>
	<input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="email" name="modifmp" required>
	<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Valider" />
    <button type="button" class="btn btn-secondary btn-lg btn-block my-4"><a href="login.php">Retour</a></button>
	<!-- -->
	</form>
<?php
//convertir le resultat de la recherche qq soit en maj mins ou les 2

   if(isset($_GET["submit"])){
        $modifmp=$_GET["modifmp"];
        modifmP($modifmp);
       }
       session_destroy();
    ?>


<!--Bootstrap-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>