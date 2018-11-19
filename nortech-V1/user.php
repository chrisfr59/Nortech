<?php
include('header.php');
$sql='SELECT identifiant, motdePasse FROM nortech.utilisateur';
// préparation de la requête SQL en utilisant la variable $connexion
$req=$connexion->prepare($sql);
//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
$reponse=$req->execute(array());
?>
<article>
	<div style="text-align: center;width:100%;background-color:#0da54a;color: white; ">
	<p style="font-size: 17px;">Liste des <?php echo $mot;?></p>
	</div>
<div>
	<table>
		<thead>
			<tr>
				<th>Identifiant</th><th>Mot de passe</th><th>Mise à jour</th>
			</tr>
		</thead>
		<tbody>
	<?php
	while($resultat=$req->fetch()){
	echo '<tr>';
	echo '<td>'. $resultat['identifiant'].'</td><td>'.$resultat['motdePasse'].'</td><td><a class="button" href="update.php?section=user&id='.$resultat['identifiant'].'">Update</a></td>';
	echo '<tr>';
	}
	?>
		</tbody>
	</table>
</div>
<div style="text-align: center;width:100%;background-color:#0da54a;color: white; ">
	<p style="font-size: 17px;" >Ajouter des <?php echo $mot;?></p>
	</div>
 <div class='formulaire_post'>
    <fieldset>
        <legend align="center"> Ajouter un utilisateur</legend>
        <form name="add_user" method="POST" action="traitement.php?section=user&action=ajouter">
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="id_user">Id utilisateur </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="id_user" class='input' required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="mp_user"> Password </label>
                </div>
                <div style="width:50%;">
                    <input type="password" name="mp_user" class='input' required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="mpc_user"> Confirmation Password </label>
                </div>
                <div style="width:50%;">
                    <input type="password" name="mpc_user" class='input' required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <input type="submit" class="button" value="Envoyer">
                </div>
                <div style="width:25%;">
                    <input type="reset" class="button" value="Effacer">
                </div>
            </div>
        </form>
    </fieldset>
    </div>
    <div style="text-align: center;width:100%;background-color:#0da54a;color: white; ">
	<p style="font-size: 17px;">Supprimer des <?php echo $mot;?></p>
	</div>
	 <div class='formulaire_post'>
    <fieldset>
        <legend align="center"> Supprimer un utilisateur</legend>
        <form name="supprimer_user" method="POST" action="traitement.php?section=user&action=supprimer">
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="id_user">Id utilisateur </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="id_user" class='input' required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <input type="submit" class="button" value="Envoyer">
                </div>
                <div style="width:25%;">
                    <input type="reset" class="button" value="Effacer">
                </div>
            </div>
        </form>
    </fieldset>
    </div>
</article>