<?php
if(isset($_SESSION['id']))
{
  echo'
  <h2>Présentation</h2>
  <form method="post" action="models/recipeEdit.php" enctype="multipart/form-data">
    <label for="identifiant">Chef</label><input type="text" id="identifiant" value="'.$_SESSION['identifiant'].'" disabled/><br>
    <a href="models/deconnexion.php">Ce n\'est pas vous ?</a><br>
    <label for="title">Titre</label><input type="text" name="title" id="title" value="'.$_SESSION['post_recipe_title'].'" placeholder="Titre de votre recette *"/>
  <h2>Préparation</h2>

    <label for="ingredients">Ingrédients (500 caractères maximum)</label>
    <div id="indicIngredients"></div>
    <textarea onblur="calculeLongueur();" onfocus="calculeLongueur();" onkeydown="calculeLongueur();" onkeyup="calculeLongueur();" name="ingredients" id="ingredients" placeholder="Les ingrédients de votre recette" rows="5">'.$_SESSION['post_recipe_ingredients'].'</textarea><br>

    <label for="steps">Préparation (1000 caractères maximum)</label> <br>
    <div id="indicSteps"></div>
    <textarea onblur="calculeLongueur();" onfocus="calculeLongueur();" onkeydown="calculeLongueur();" onkeyup="calculeLongueur();" name="steps" id="steps" placeholder="Décrivez votre recette ..." rows="5">'.$_SESSION['post_recipe_steps'].'</textarea><br>

    <label for="serve">Servir (500 caractères maximum)</label> <br>
    <div id="indicServe"></div>
    <textarea onblur="calculeLongueur();" onfocus="calculeLongueur();" onkeydown="calculeLongueur();" onkeyup="calculeLongueur();" name="serve" id="serve" placeholder="Décrivez votre recette ..." rows="5">'.$_SESSION['post_recipe_serve'].'</textarea><br>

    Photo du plat * (400 pixels par 400 pixels) <input type="file" name="recipe_picture" /><br>
    <input type="submit" name="submit" value="Envoyer" class="button">
  </form>
  ';
}else {
  echo '<a href="?action=cook">Créez un compte pour proposer une recette.</a>';
}
