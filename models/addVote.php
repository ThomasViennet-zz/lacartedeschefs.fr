<?php
session_start();

if(!empty($_POST['vote'])) {

  require '../base.php';

  //Est-ce que l'utilisateur a déjà voté pour cette recette ?
  $req = $bdd->query('SELECT id_cook FROM votes WHERE id_recipe = '.$_GET['id_recipe']);
  $resultat = $req->fetch();

  if (!empty($resultat['id_cook'])) {

    echo '
		Vous avez déjà voté ! <br>
		Si vous n\'êtes pas redirigé, <a href="../?action=cook"">cliquez ici</a>.';
		header('refresh:3;url=../?action=recipe&id_recipe='.$_GET['id_recipe']);

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

    echo '
		La vote a bien été ajouté ! <br>
		Si vous n\'êtes pas redirigé, <a href="../?action=cook"">cliquez ici</a>.';
		header('refresh:3;url=../?action=recipe&id_recipe='.$_GET['id_recipe']);
  }
}else {
  echo '
  Choississez une note.<br>
  Si vous n\'êtes pas redirigé, <a href="../?action=cook"">cliquez ici</a>.';
  header('refresh:3;url=../?action=recipe&id_recipe='.$_GET['id_recipe']);
}
?>
