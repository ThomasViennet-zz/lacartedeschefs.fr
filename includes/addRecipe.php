<?php
if(isset($_SESSION['id']))
{
  echo'
  <form method="post" action="models/addRecipe.php" enctype="multipart/form-data">
    <input type="text" value="'.$_SESSION['identifiant'].'" disabled/><br>
    <a href="models/deconnexion.php">Ce n\'est pas vous ?</a><br>
    <input type="text" name="title" placeholder="Titre de votre recette *"/>
    <input type="text" name="ingredients" placeholder="Ingrédients de votre recette *"/>
    <input type="text" name="description" placeholder="Description courte de votre recette *"/>
    <textarea name="steps" placeholder="Décrivez votre recette ..." rows="5">

    </textarea><br>
    Photo du plat * (800 pixels par 800pixels) <input type="file" name="recipe_picture" /><br>
    <input type="submit" name="submit" value="Envoyer" class="button">
  </form>
  ';
}else {
  echo '<a href="?action=cook">Créez un compte pour proposer une recette.</a>';
}
