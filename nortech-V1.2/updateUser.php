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
include('db_connect.php');
$nav_en_cours ='user';

//recupération de la section serv-employ-user
if(isset($_GET['section'])){
    $section=$_GET['section'];
}else{
    echo"<script type='text/javascript'>document.location.replace('index.html');
         alert('cette action est interdite!!!');</script>";
}



//appeler le ficher du traitement 
if($section=='user'){
    $id=$_GET['id'];
    $sql="SELECT * FROM utilisateur WHERE  identifiant=:id";
        //preparation de la rqt sql on utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la rqt avec eregistrement de resulat de la variable $reponse
        $reponse=$req->execute(array('id'=>$id));
       //enregistrement des valeur retourner par la req ds  $result
        $result=$req->fetch();

 }else if($section=='employe'){
    echo'form employe';
 
 }else if($section=='service'){
    echo'form service';
  }else{//en cas d'une manipulation douteuese je redérige l'utilisateur vers index.php
     echo"<script type='text/javascript'>document.location.replace('index.html');
     alert('cette action est interdite!!!');</script>";
  }


?>
        <div class="row justify-content-center">
        <fieldset class="col-md-6 align-self-center f1">
                <legend>Modifier un  Utilisateur</legend>
                
                <form class="border border-success p-5" method="POST" name="apdate_user" action="traitement.php?action=update&section=user&id=<?php echo $id;?>" required>
                    <div class="row">
                        <div class="col-md-6">
                <label for="id_user">id Utilisateur:</label>
                <input type="text" id="textInput" class="form-control mb-1" placeholder="" name="id_user" required value="<?php echo $result['identifiant'];?>" disabled>
            
                <label for="mp_user" >Droits:</label>
                <input type="text" id="text"  class="form-control mb-1" placeholder="" name="droits" required value="<?php echo $result['droits'];?>" disabled>

                <label for="mpc_user" >Nouveau Droits:</label>
                <input type="number" id="number" min="1" max="4" class="form-control mb-1" placeholder="" name="droitsM" required >
            </div>
                <input class="btn btn-success btn-block my-4" type="submit" value="modifier">
                
            </form>
        
        </fieldset>	
        </div>
        </div>

        
<!--Bootstrap-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
