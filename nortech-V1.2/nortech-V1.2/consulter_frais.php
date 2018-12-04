<?php
$nav_en_cours = 'espace_perso';
//appeler la connexion à la BDD
include('db_connect.php');
include('header.php');




// ----------------------affichage du N° employé---------------------------
$nom=$_SESSION['nom'];
$sql="SELECT e.noEmp FROM historique h,employe e where h.identifiant=e.identifiant AND e.nom=:nom group by e.nom";
$req=$connexion->prepare($sql);
$reponse=$req->execute(array('nom'=>$nom));
while($resultat=$req->fetch()){
    echo 'Votre numéro employé est '.$ref=$resultat['noEmp'].'.';} ;
    echo '<br>';
    
?>
<?php

 echo '<br>';
// -------------------- affichage du tableau des dépenses ------------------------
$sql="select * from nortech.frais where noEmp='{$ref}'";
$req=$connexion->prepare($sql);
$reponse=$req->execute(array());
?>

<table>
    <thead>
        <tr>
            <th>N° Frais</th><th>N° employé</th><th>Date de Frais</th><th>Montant</th><th>Motif</th><th>Autre motif</th>
</tr>
</thead>
<tbody>
<?php
while ($resultat=$req->fetch()){
    echo '<tr>';
    echo '<td>'.$resultat['noFrais'].'</td><td>'.$resultat['noEmp'].'</td><td>'.$resultat['dateFrais'].'</td><td>'.$resultat['montant'].'</td><td>'.$resultat['motif'].'</td><td>'.$resultat['autreMotif'].'</td>';
    echo'</tr>';

}
?>
</tbody>
</table>


<?php
//-------------------------Affichage du total des frais --------------------------
$sql="SELECT sum(montant) from nortech.frais where noEmp='{$ref}'";
$req=$connexion->prepare($sql);
$reponse=$req->execute(array());
$resultat=$req->fetch();
echo '<br>';
echo 'La somme de vos dépenses est de '.$resultat['sum(montant)'].' €.';

echo '<br>';
?>
<br>
<div class="form-btn">
    <a href="espace_perso.php"><input  type="button" value="Retour à l'espace personnel" ></a>
</div><br>
</html>

<?php include('footer.php');?>
