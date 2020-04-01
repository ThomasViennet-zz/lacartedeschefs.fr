<?php
try
{
  require 'secret.php';;
  $bdd = new PDO('mysql:host=localhost;dbname='. $dbName .';charset=utf8', '' . $dbLogin . '', '' . $dbPassword . '');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT AVG(note) AS note_moyenne FROM votes WHERE id_recipe = :id_recipe');
$req->execute(array('id_recipe' => $recipe->id()));
$donnees = $req->fetch();
$req->closeCursor();

echo $donnees['note_moyenne'];
?>
