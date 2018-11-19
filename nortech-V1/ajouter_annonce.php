<div class='ajouter'>
    <h1>
        Ajouter une annonce
    </h1>
    <form name="offre" method="post" action="traitement.php?section=offre&action=ajouter">



        <div class=''>
            <label for="titre">Titre</label><br>
            <input type="text" name="titre" id="titre" required />
        </div><br>

        <div class=''>
            <label for="service">Service</label><br>
            <input type="text" name="service" id="service"  />
        </div><br>

        <div class=''>
            <label for="date">Date</label><br>
            <input type="date" name="dat" id="date" required />
        </div><br>

        <div class=''>
            <label for="ville">Ville</label><br>
            <input type="text" name="ville" id="ville" />

        <div class=''>
            <label for="description">Description</label><br>
            <textarea type="text" name="descrip" id="description" cols=45 rows=20 required></textarea>
        </div><br><br>

        
        </div><br>

        <input type="submit" value="OK" />
        <input type="reset" value="annuler" />




    </form>
</div>