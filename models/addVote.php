<form method="post" action="?action=<?php echo $_GET['action']?>&id=<?php echo $_GET['id']?>&addVote#recette">
  <input type="text" value="<?php echo $_SESSION['identifiant'];?>" disabled/> <a href="models/deconnexion.php"><br>
  Ce n'est pas vous ?</a><br>
  <input type="radio" name="vote" value="1">1 étoile
  <input type="radio" name="vote" value="2">2 étoiles<br>
  <input type="radio" name="vote" value="3">3 étoiles<br>
  <input type="submit" name="submit" value="Envoyer" class="button">
</form>

<?php
if(isset($_GET['addVote']))
{
  if(!empty($_POST['vote']))
  {
    try
    {
      require 'secret.php';;
      $bdd = new PDO('mysql:host=localhost;dbname='. $dbName .';charset=utf8', '' . $dbLogin . '', '' . $dbPassword . '');
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }

    $req = $bdd->prepare('INSERT INTO votes (id_recipe, id_cook, id_customer, note) VALUES(:id_recipe, :id_cook, :id_customer, :note)');
    $req->execute(array(
      'id_recipe' => $recipe->id(),
      'id_cook' => $recipe->idCook(),
      'id_customer' => $_SESSION['id'],
      'note' => $_POST['vote']
    )) or die('Une erreur s\'est produite');

    echo '<p class="colorMain">La vote a bien été ajouté !</p>';

  }else {
    echo '<p class="colorMain">Choississez une note.</p>';
  }
}

?>
