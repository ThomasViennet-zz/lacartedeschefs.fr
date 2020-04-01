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

$req = $bdd->prepare('SELECT AVG(note) AS cook_moyenne FROM votes WHERE id_cook = :id_cook');
$req->execute(array('id_cook' => $_SESSION['id']));
$resultat = $req->fetch();
$req->closeCursor();

echo $resultat['cook_moyenne'];

?>
