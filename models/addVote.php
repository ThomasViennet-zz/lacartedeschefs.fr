<?php
function addVote()
{
  if(!empty($_POST['vote'])) {

    require 'base.php';

    //Est-ce que l'utilisateur a déjà voté pour cette recette ?
    $req = $bdd->prepare('SELECT id_cook FROM votes WHERE id_recipe = :id_recipe AND id_customer = :id_customer');
    $req->execute(array('id_recipe' => $_GET['id_recipe'], 'id_customer' => $_SESSION['id']));
    $resultat = $req->fetch();

    if (!empty($resultat)) {
      return 'Vous avez déjà voté !';

    }else {
      //Qui est le cook ?
      $req = $bdd->query('SELECT id_cook FROM recipes WHERE id = '.$_GET['id_recipe']);
      $resultat = $req->fetch();

      $req = $bdd->prepare('INSERT INTO votes (id_recipe, id_cook, id_customer, note) VALUES(:id_recipe, :id_cook, :id_customer, :note)');
      $req->execute(array(
        'id_recipe' => $_GET['id_recipe'],
        'id_cook' => $resultat['id_cook'],
        'id_customer' => $_SESSION['id'],
        'note' => $_POST['vote']
      )) or die('Une erreur s\'est produite');

      return 'La vote a bien été ajouté !';
    }
  }else {
    return 'Choississez une note.';
  }
}
