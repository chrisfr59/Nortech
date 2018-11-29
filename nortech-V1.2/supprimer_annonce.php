<?php
$nav_en_cours = 'espace_perso';
include('db_connect.php');

include('header.php');

$id=$_GET['noffre'];
    
        $sql='select * from nortech.annonce where noAnnonce= :id';
        // préparation de la requête SQL en utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
        $reponse=$req->execute(array('id'=>$id));
        //enregistrement des valeurs retournés par la requête dans la variable $resultat
        $resultat=$req->fetch();


?>

<div class='supprimer'>
            <h1>
                Supprimer une annonce
            </h1>
            <form name="offre" method="post" action="traitement.php?section=offre&action=supprimer">
                
            <div class=''>
                    <label for="noannonce">N°Annonce</label><br>
                    <input type="int" name="noannonce" id="noannonce" value="<?php echo $resultat['noAnnonce'];?>" readonly/>
                </div><br><br>

                <input type="submit" value="OK" />
                <input type="reset" value="annuler" />




            </form>
        </div>