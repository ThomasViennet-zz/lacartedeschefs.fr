<?php
session_start();

if(!empty($_POST['vote'])) {

  require '../base.php';

  //Est-ce que l'utilisateur a déjà voté pour cette recette ?
  $req = $bdd->query('SELECT id_cook FROM votes WHERE id_cook = '.$_SESSION['id']);
  $resultat = $req->fetch();

  if (!empty($resultat['id_cook'])) {
    $message = 'Vous avez déjà voté.';
    header('Location: ../?action=recipe&id_recipe='.$_GET['id_recipe'].'&message='.$message);
  }else {
    $req = $bdd->prepare('INSERT INTO votes (id_recipe, id_cook, id_customer, note) VALUES(:id_recipe, :id_cook, :id_customer, :note)');
    $req->execute(array(
      'id_recipe' => $_GET['id_recipe'],
      'id_cook' => $_GET['id_cook'],
      'id_customer' => $_SESSION['id'],
      'note' => $_POST['vote']
    )) or die('Une erreur s\'est produite');

    $message = 'La vote a bien été ajouté !';
    header('Location: ../?action=recipe&id_recipe='.$_GET['id_recipe'].'&message='.$message);
  }
}else {
  $message = 'Choississez une note.';
  header('Location: ../?action=recipe&id_recipe='.$_GET['id_recipe'].'&message='.$message);
}
?>
