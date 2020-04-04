<?php
session_start();

if(!empty($_POST['title']))
{
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

        require '../base.php';

        $req = $bdd->prepare('INSERT INTO recipes (title, description, id_cook, recipe_picture, ingredients, steps) VALUES(:title, :description, :id_cook, :recipe_picture, :ingredients, :steps)');
        $req->execute(array(
          'title' => $_POST['title'],
          'description' => $_POST['description'],
          'id_cook' => $_SESSION['id'],
          'recipe_picture' => $name_recipe_picture,
          'ingredients' => $_POST['ingredients'],
          'steps'=> $_POST['steps']
          )) or die('Une erreur s\'est produite');

        echo '<p class="colorMain">La recette a bien été ajouté !</p>';

        move_uploaded_file($_FILES['recipe_picture']['tmp_name'], '../uploads/recipes/'.$name_recipe_picture);

        if($extension_upload == 'png')
        $source = imagecreatefrompng("../uploads/recipes/".$name_recipe_picture."");
        else {
          $source = imagecreatefromjpeg("../uploads/recipes/".$name_recipe_picture."");
        }
        $destination = imagecreatetruecolor(300, 300);

        $largeur_source = imagesx($source);
        $hauteur_source = imagesy($source);
        $largeur_destination = imagesx($destination);
        $hauteur_destination = imagesy($destination);

        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

        imagejpeg($destination, "../uploads/recipes/300x300_".$name_recipe_picture."");

        $req = $bdd->query('SELECT LAST_INSERT_ID() AS lastID FROM recipes');
        $resultat = $req->fetch();

        header('Location: ../?action=recipe&id_recipe='.$resultat['lastID']);
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
?>
