<?php
$sql='SELECT identifiant, motdePasse FROM nortech.utilisateur';
$requete=$connection->prepare($sql);

//execution de la requte avec enregistrement des resultat dans la variable $reponse (boolean qui prend 2 valeur 1 pour execute=ok et 
                                                                                                            //0 pour execute = KO)
$reponse=$requete->execute(array());
//$resultat=$requete->fetch();
?>
<section class='ban'>
    <div class='titre'>
        <p>Liste des
            <?php echo $mot; ?>
        </p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Mot de passe</th>
                <th>update</th>

            </tr>
        </thead>


        <tbody>
            <?php
    
    while($resultat=$requete->fetch()){
        echo '<tr>';
        echo '<td>'.$resultat['identifiant'].'</td><td>'.$resultat['motdePasse'].'</td><td><a href="update.php?action=update&section=user&id='.$resultat['identifiant'].'">update</a></td>';
        echo '</tr>';
    
    }

    ?>
        </tbody>
    </table>
</section>
<section class='ban'>
    <div class='titre'>
        <p>Ajouter un utilisateur</p>
    </div>
    <div class=fromulaire_POST>
        <form name='add_user' method="POST" action="traitement.php?section=user&action=ajouter" class='ajouter'>
            <h2>Ajouter un utilisateur</h2>

            <div class='label'>
                <label for="id_user">ID utilisateur :</label>
                <input type="text" name="id_user" id="id_user" required />
            </div>
            <div class='label'>
                <label for="mp_user">Password :</label>
                <input type="password" name="mp_user" id="mp_user" required />
            </div>
            <div class='label'>
                <label for="mpc_user">Confirmation password :</label>
                <input type="password" name="mpc_user" id="mpc_user" required />
            </div>

            <div class='label'>
                <input type="submit" value="OK" />
                <input type="reset" value="annuler" />
            </div>
        </form>
    </div>
</section>
<section class='ban'>
    <div >
        <p class='titre'>Supprimer les utilisateur</p>
    </div>
    <form name='supp_user' method="POST" action="traitement.php?section=user&action=supprimer" class='supprimer'>
        <h2>Supprimer employée</h2>

        <div class='label'>
            <label for="id_emp">Identifiant :</label>
            <input type="text" name="id_user" id="id_emp" required />
        </div>

        <input type="submit" value="OK" />
        <input type="reset" value="annuler" />
    </form>
</section>