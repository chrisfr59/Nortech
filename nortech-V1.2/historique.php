<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/perso.css" />
    <script src="main.js"></script>
</head>
<body>
<div class="container">
<section id="section1">
    <h1>Liste des derniéres connexions</h1>
    <button type="button" class="btn btn-secondary btn-lg btn-block my-4"><a href="user.php">Retour</a></button>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Identifiant</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Date connexion</th>
      <th scope="col">Adresse IP</th>
      <th scope="col">Poste</th>
    </tr>
  </thead>
  <tbody>
  <?php
  //demarrage de la session
session_start();
//connexion à la bdd
include('db_connect.php');
@$id=$_GET['id'];

 $sql="SELECT h.*,e.nom,e.prenom FROM historique h,employe e where h.identifiant=e.identifiant AND h.identifiant='$id'";
 //preparation de la rqt sql on utilisant la variable $connexion
 $req=$connexion->prepare($sql);
 //execution de la rqt avec eregistrement de resulat de la variable $reponse
 $reponse=$req->execute(array());
 while($result=$req->fetch()){
 echo '<tr>';
 echo '<td>'.$result['identifiant'].'</td>';
 echo '<td>'.$result['nom'].'</td>';
 echo '<td>'.$result['prenom'].'</td>';
 echo '<td>'.$result['dateConnection'].'</td>';
 echo '<td>'.$result['adresseIP'].'</td>';
 echo '<td>'.$result['poste'].'</td>';
 echo '</tr>';
};
?>
    
</tbody>
</table>
</section>

</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>