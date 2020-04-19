<!DOCTYPE html>
<html>
<head> <meta charset="utf-8" />
    <title>Un formulaire de connexion en AJAX</title></head>

<body>
    <div id="resultat">
        <!-- Nous allons afficher un retour en jQuery au visiteur -->
    </div>

        <h1>Un formulaire de connexion en AJAX</h1>

    <form>
        <p>
        idCook : <input type="text" id="idCook" />
        <input type="submit" id="submit" value="Se connecter !" />
        </p>
    </form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>

<script>

$(document).ready(function(){

    $("#submit").click(function(e){
        e.preventDefault();

        $.post(
            'connexion.php', // Un script PHP que l'on va créer juste après
            {
                idCook : $("#idCook").val(),  // Nous récupérons la valeur de nos input que l'on fait passer à connexion.php
            },

            function(data){

                if(data == 'Success'){
                     // Le membre est connecté. Ajoutons lui un message dans la page HTML.

                     $("#resultat").html("Vous êtes abonné !<br> Retrouvez les recettes de ce chef dans <a href="?action=feed">votre sélection</a>.<br>");
                }
                else{
                     // Le membre n'a pas été connecté. (data vaut ici "failed")

                     $("#resultat").html("Vous êtes déjà abonné.<br>
                     <a href="?action=unfollow&id_cook='.$idCook.'">Se désabonner</a><br>");
                }

            },
            'text'
         );
    });
});

</script>
