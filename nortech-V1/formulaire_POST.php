
    <div class='formulaire_post'>
    <fieldset>
        <legend align="center"> Ajouter un utilisateur </legend>
        <form name="add_user" method="POST" action="traitement_user.php?action=ajouter">
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

