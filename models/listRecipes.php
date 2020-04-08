<?php
require 'base.php';
require 'class/recipe.php';
require 'class/cook.php';

$req = $bdd->query('SELECT id FROM recipes');

while ($resultat = $req->fetch()) {
  $recipe = new Recipe($resultat['id']);
  $cook = new Cook($recipe->idCook());

  echo '<div class="element" style="background-color:rgb(245,245,245);margin: 5px;">

    <div style="padding:5px;">
      <a href="?action=cook&cook_id='.$cook->id().'">
      <img src="uploads/avatars/80x80_'.$cook->picture().'" width="30px" class="profilPicture">
      '.$cook->identifiant().'
      </a>
    </div>

    <a href="?action=recipe&id_recipe='.$recipe->id().'">
    <img src="uploads/recipes/400x400_'.$recipe->picture().'"/></a>

    <div style="padding: 5px">
      '.$recipe->moyenne().'<br>
      '.$recipe->title().'
    </div>

  </div>';
}
?>
