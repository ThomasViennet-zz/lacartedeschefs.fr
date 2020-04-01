<form method="post" action="?action=<?php echo $_GET['action']?>&proposer_recette#recette" enctype="multipart/form-data">
  <input type="text" value="<?php echo $_SESSION['identifiant'];?>" disabled/> <a href="models/deconnexion.php"><br>
  Ce n'est pas vous ?</a><br>
  <input type="text" name="title" placeholder="Titre de votre recette *"/>
  <input type="text" name="ingredients" placeholder="Ingrédients de votre recette *"/>
  <input type="text" name="description" placeholder="Description courte de votre recette *"/>
  <textarea name="steps" rows="5">
    Décrivez votre recette ...
  </textarea><br>
  Photo du plat * (800 pixels par 800pixels) <input type="file" name="recipe_picture" /><br>
  <input type="submit" name="submit" value="Envoyer" class="button">
</form>

<?php
if(isset($_GET['proposer_recette']))
{
  if(!empty($_POST['title']))
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

    if (isset($_FILES['recipe_picture']) AND $_FILES['recipe_picture']['error'] == 0)
    {
      if ($_FILES['recipe_picture']['size'] <= 5000000)
      {
        $infosfichier = pathinfo($_FILES['recipe_picture']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'png');
        if (in_array($extension_upload, $extensions_autorisees))
        {
          $name_recipe_picture = time().''.$_SESSION['id'].'.jpeg';

          $req = $bdd->prepare('INSERT INTO recipes (title, description, id_cook, recipe_picture, ingredients, steps) VALUES(:title, :description, :id_cook, :recipe_picture, :ingredients, :steps)');
          $req->execute(array(
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'id_cook' => $_SESSION['id'],
            'recipe_picture' => $name_recipe_picture,
            'ingredients' => $_POST['ingredients'],
            'steps'=> $_POST['steps']
          ));

          echo '<p class="colorMain">La recette a bien été ajouté !</p>';

          move_uploaded_file($_FILES['recipe_picture']['tmp_name'], 'uploads/recipes/'.$name_recipe_picture);

          if($extension_upload == 'png')
          $source = imagecreatefrompng("uploads/recipes/".$name_recipe_picture."");
          else {
            $source = imagecreatefromjpeg("uploads/recipes/".$name_recipe_picture."");
          }
          $destination = imagecreatetruecolor(300, 300);

          $largeur_source = imagesx($source);
          $hauteur_source = imagesy($source);
          $largeur_destination = imagesx($destination);
          $hauteur_destination = imagesy($destination);

          imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

          imagejpeg($destination, "uploads/recipes/300x300_".$name_recipe_picture."");
        }else {
          echo '<p class="colorMain">Format de photo non autorisé.</p>';
        }
      }else {
        echo '<p class="colorMain">La photo est trop lourde.</p>';
      }
    }else {
      echo '<p class="colorMain">Ajoutez une photo.</p>';
    }
  }else {
    echo '<p class="colorMain">Renseignez toutes les informations.</p>';
  }
}
?>
