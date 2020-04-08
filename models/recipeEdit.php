<?php
require '../base.php';
require '../class/recipe.php';
$recipe = new Recipe($_GET['id_recipe']);

//Si c'est bien le cook alors il a le droit de modifier
// if ($_SESSION['id'] == $recipe->idCook()) {
//   require '../base.php';
//
//   $req = $bdd->prepare(
//     'UPDATE recipes
//     SET title = :title,
//     ingredients = :ingredients,
//     steps = :steps,
//     serve = :serve
//     WHERE id = :id_recipe') or die('erreur');
//
//   $req->execute(array(
//     'title' => $_POST['title'],
//     'ingredients' => $_POST['ingredients'],
//     'steps' => $_POST['steps'],
//     'serve' => $_POST['serve'],
//     'id_recipe' => $_GET['id_recipe'])) or die('erreur');
//
// }else {
//   echo 'Vous n\'êtes pas l\'auteur de la recette.';
//
// }

//photo
?>
