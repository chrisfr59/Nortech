<?php $nav_en_cours = 'user'; ?>
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
<?php 
include('header.php');
?>
<div class="container">

<?php
include('db_connect.php');
function rechercher1($name){
    global $connexion;
    $existant= false;
    $req1 = $connexion->prepare("SELECT i.*,e.nom,e.prenom FROM utilisateur i,employe e where i.identifiant=e.identifiant AND e.nom='$name' ");
    $reponse1=$req1->execute(array());
    if (isset($reponse1)){
        while($result=$req1->fetch()){
            if ($result['nom'] == $name)
            {
                echo '<div class="container">';
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo'<tr>';
                echo '<th scope="col">Identifiant</th>';
                echo '<th scope="col">Droits</th>';
                echo '<th scope="col">Nom</th>';
                echo '<th scope="col">Prenom</th>';
                echo '<th scope="col">Historique</th>';
                echo '<th scope="col">Modifier droit</th>';
                echo '<th scope="col">Supprimer</th>';
                echo '</tr>';
                echo '</thead>';
                echo' <tbody>';
                echo '<tr>';
                echo '<td>'.$result['identifiant'].'</td>';
                echo '<td>'.$result['droits'].'</td>';
                echo '<td>'.$result['nom'].'</td>';
                echo '<td>'.$result['prenom'].'</td>';
                echo '<td><button class="btn btn-success  my-1" ><a href="historique.php?section=user&id='.$result['identifiant'].'">Historique</a></button></td>';
                echo '<td><button class="btn btn-warning  my-1" ><a href="updateUser.php?section=user&id='.$result['identifiant'].'">Modifier</a></button></td>';
                echo '<td><button class="btn btn-danger  my-1" ><a href="suppUser.php?section=user&id='.$result['identifiant'].'">Supprimer</a></button></td>';
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
         
?>
<form class="border border-light p-5" method="POST">
	<p class="h4 mb-4 text-center">Recherche</p>
	<input type="text" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Rechercher un utilisateur pour le modifier, le supprimer ou consulter son historique" name="recherche" required>
	<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Valider" />
    <button type="button" class="btn btn-secondary btn-lg btn-block my-4"><a href="espace_perso.php">Retour</a></button>
	<!-- -->
	</form>
<?php
//convertir le resultat de la recherche qq soit en maj mins ou les 2
@$_POST["recherche"]=strtoupper($_POST["recherche"]);
   if(isset($_POST["submit"])){
        $recherche=$_POST["recherche"];
        rechercher1($recherche);
       }
    ?>
<section id="section1">
    <h1>Liste des utilisateurs </h1>

    <button type="button" class="btn btn-outline-success my-4"><a href="#section2">Ajouter un nouveau utilisateur</a></button>

    
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Identifiant</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Droits</th>
      <th scope="col">Num employe</th>
    </tr>
  </thead>
  <tbody>
  <?php
  include('db_connect.php');
 $sql="SELECT i.*,e.nom,e.prenom,e.noEmp FROM utilisateur i,employe e  where i.identifiant=e.identifiant";
 //preparation de la rqt sql on utilisant la variable $connexion
 $req=$connexion->prepare($sql);
 //execution de la rqt avec eregistrement de resulat de la variable $reponse
 $reponse=$req->execute(array());
 while($result=$req->fetch()){
 echo '<tr>';

 echo '<td>'.$result['identifiant'].'</td>';
 echo '<td>'.$result['nom'].'</td>';
 echo '<td>'.$result['prenom'].'</td>';
 echo '<td>'.$result['droits'].'</td>';
 echo '<td>'.$result['noEmp'].'</td>';
 
 echo '</tr>';
};
?>
    
</tbody>
</table>
</section>
<section id="section2">
<button type="button" class="btn btn-outline-success my-4"><a href="#section1">Liste utilisateurs</a></button>
    <div class="row justify-content-center">
        <fieldset class="col-md-12 align-self-center f1">
                <legend>Ajouter un  Utilisateur</legend>
                
                <form class="border border-success p-5" method="POST" name="add_user" action="traitement.php?action=ajouter&section=user" required>
                    <div class="row">
                        <div class="col-md-6">
                <label for="id_user">id Utilisateur:</label>
                <input type="email" id="textInput" class="form-control mb-1" placeholder="Email" name="id_user" required>

                <label for="droits">Droit:</label>
                <input type="number" id="tentacles" name="dr" min="1" max="4" class="form-control mb-1" placeholder="Droits" required>
            
                <label for="mp_user" >Mot de passe:</label>
                <input type="password" id="textInput" class="form-control mb-1" placeholder="Mot de Passe" name="mp_user" required>

                <label for="mpc_user" >Confirmation Mot de passe:</label>
                <input type="password" id="textInput" class="form-control mb-1" placeholder="Confirmer Mot de Passe" name="mpc_user" required>
            </div>
                <input class="btn btn-success btn-block my-4" type="submit" value="Creer">
                <input class="btn btn-danger btn-block my-4" type="reset" value="Annuler">
            </form>
        
        </fieldset>	
    </div>
    </section>
</div>


<!--Bootstrap-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>