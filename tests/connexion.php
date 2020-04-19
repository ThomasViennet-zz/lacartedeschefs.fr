<?php
session_start();
if(!empty($_SESSION['id']))
{
  require 'base.php';
  //est-ce qu'il est déjà abonné ?
  $req = $bdd->prepare('SELECT id FROM followers WHERE id_follower = :id_follower AND id_following = :id_following');
  $req->execute(array('id_follower' => $_SESSION['id'], 'id_following' => $_POST['idCook'])) or die('Une erreur s\'est produite');
  $resultat = $req->fetch();

  if (empty($resultat)) {
    $req = $bdd->prepare('INSERT INTO followers (id_follower, id_following, date) VALUES(:id_follower, :id_following, NOW())');
    $req->execute(array('id_follower' => $_SESSION['id'],'id_following' => $_POST['idCook'])) or die('Une erreur s\'est produite');

    echo "Success";
  }else {
    echo "Failed";
  }
}
// else {
//   return '<a href="?action=account">Connectez-vous</a> pour vous abonner.<br>';
// }
?>
