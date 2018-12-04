<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--css Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/main.css" />
    <script src="main.js"></script>
</head>

<?php
include('../../db_connect.php');
$sql="select noServ, service from service";
$req=$connexion->query($sql);

$sql2="select distinct fonction from employe";
$req2=$connexion->query($sql2);
?>

<body>
<div class="container">
   <div class="row justify-content-center">
        <fieldset class="col-md-12 align-self-center f1">
                <legend>Ajouter un  Employe </legend>
                <form class="border border-success p-5" method="POST" name="add_user" action="../controller/createEmploye.action.php" required>
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <label for="EmailType">Statut : </label>
                        <select name="EmailType" id="EmailType">
                            <option value="0">Interne</option>
                            <option value="1">Externe</option>
                        </select><br>

                <label for="droits ">Nom:</label>
                <input type="text" id="tentacles" name="nom"  class="form-control mb-1" placeholder="" required>
            
                <label for="mp_user" >prenom:</label>
                <input type="text" id="textInput" class="form-control mb-1" placeholder="" name="prenom" required>

                <label for="id_user">naissance:</label>
                <input type="date" id="textInput" class="form-control mb-1" placeholder="" name="nais" required>

                 <label for="droits">tel:</label>
                <input type="text" id="tentacles" name="tel"  class="form-control mb-1" placeholder="" required>
            
                <label for="mp_user" >Adresse:</label>
                <input type="text" id="textInput" class="form-control mb-1" placeholder="" name="adresse" required>

                <label for="droits">embauche:</label>
                <input type="date" id="tentacles" name="emb" min="1" max="4" class="form-control mb-1" placeholder="" required>

                <label for="fonction">Fonction : </label>
                        <select name="fonction" id="fonction" required>
                            <option value="">--Selectionnez une fonction--</option>
                                <?php
                                    while($reponse2=$req2->fetch()){
                                        echo '<option value="'.$reponse2['fonction'].'">'.ucwords(strtolower($reponse2['fonction'])).'</option>';
                                    }
                                ?>
                        </select>
                        <br>

                <label for="Noserv">Service : </label>
                        <select name="service" id="service">
                            <option value="">--Selectionnez un service--</option>
                                <?php 
                                    while($reponse=$req->fetch()){
                                        echo '<option value="'.$reponse['noServ'].'">'.ucwords(strtolower($reponse['service'])).'</option>';
                                    }
                                ?>
                        </select>
                        <br>

                </div>
                <input class="btn btn-success btn-block my-4" type="submit" value="Creer">
                <input class="btn btn-danger btn-block my-4" type="reset" value="Annuler">
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