<?php
$nav_en_cours ='service';
include('db_connect.php');
include('header.php');
$numServ=$_GET['numServ'];
        $sql='select * from nortech.service where noServ= :numServ';
        // préparation de la requête SQL en utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
        $reponse=$req->execute(array('numServ'=>$numServ));
        //enregistrement des valeurs retournés par la requête dans la variable $resultat
        $resultat=$req->fetch();
      
        
       /* $sql='select * from nortech.service where noserv= :par';
        // préparation de la requête SQL en utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
        $reponse=$req->execute(array('par'=>$par));
        //enregistrement des valeurs retournés par la requête dans la variable $resultat
        $resultat=$req->fetch();
    //en cas de manipulation douteuse je redirige l'utilisateur vers index.php
        echo "<script type='text/javascript'>document.location.replace('index.php');
                    alert('Cette action est interdite !');
                    </script>";*/
    
?>

<article>
<div class='formulaire_post' style="margin : 0 auto; width : 50%; display:block; " >
    <fieldset>
    
        <legend align="center"> Mise à jour un service</legend>
      
        <form name="update_service" method="POST" action="traitement.php?section=service&action=update&numServ=<?php echo $numServ;?>" >
        <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="no_serv">N° Service </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="no_serv" class='input' value="<?php echo $resultat['noServ'];?>" disabled="disabled" required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="service"> Service </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="service" class='input' value="<?php echo $resultat['service'];?>" required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="ville"> Ville </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="ville" class='input' value="<?php echo $resultat['ville'];?>" required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:20%;">
                    <input type="submit" class="button" value="Envoyer">
                </div>
                <div style="width:20%;">
                    <input type="reset" class="button" value="Effacer">
                </div>
            </div>
        </form>
    </fieldset>
    </div>
    </article>