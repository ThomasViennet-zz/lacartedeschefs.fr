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

$reponse = $bdd->query('SELECT * FROM recipes WHERE id_cook = '.$_SESSION['id']);

while ($donnees = $reponse->fetch())
{
  echo '<a href="?action=recipe&id='.$donnees['id'].'"><img src="uploads/recipes/300x300_'.$donnees['recipe_picture'].'"/></a>';
}

$reponse->closeCursor();
?>
