<?php
include('header.php');
$sql='SELECT noserv, service, ville FROM nortech.service';
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
			<th>N° service</th><th>Service</th><th>Ville</th><th>Mise à jour</th>
			</tr>
		</thead>
		<tbody>
	<?php
	while($resultat=$req->fetch()){
	echo '<tr>';
	echo '<td>'.$resultat['noserv'].'</td><td><div id="msg" onmouseover="afficher(infos[2]);" onmouseout="masquer();">'.$resultat['service'].'</div></td><td>'.$resultat['ville'].'</td><td><a class="button" href="update.php?section=service&numServ='.$resultat['noserv'].'">Update</a></td>';
	echo '</tr>';
	}
    ?>
    </tbody>
	</table>
</div>
<div style="text-align: center;width:100%;background-color:#0da54a;color: white; ">
	<p style="font-size: 17px;">Ajouter des <?php echo $mot;?></p>
</div>
 <div class='formulaire_post'>
    <fieldset>
        <legend align="center"> Ajouter un service</legend>
        <form name="add_service" method="POST" action="traitement.php?section=service&action=ajouter" >
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="no_serv">N° Service </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="no_serv" class='input' required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="service"> Service </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="service" class='input' required>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="ville"> Ville </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="ville" class='input' required>
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
    <div style="text-align: center;width:100%;background-color:#0da54a;color: white; ">
	<p style="font-size: 17px;">Supprimer des <?php echo $mot;?></p>
	</div>
	 <div class='formulaire_post'>
    <fieldset>
        <legend align="center"> Supprimer un service</legend>
        <form name="supprimer_user" method="POST" action="traitement.php?section=service&action=supprimer">
            <div style="width: 100%;">
                <div style="width:25%;">
                    <label for="no_serv">N° Service </label>
                </div>
                <div style="width:50%;">
                    <input type="text" name="no_serv" class='input' required>
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