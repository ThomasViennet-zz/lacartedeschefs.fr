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

        $req = $bdd->prepare('INSERT INTO recipes (title, id_cook, recipe_picture, ingredients, steps, serve) VALUES(:title, :id_cook, :recipe_picture, :ingredients, :steps, :serve)');
        $req->execute(array(
          'title' => $_POST['title'],
          'id_cook' => $_SESSION['id'],
          'recipe_picture' => $name_recipe_picture,
          'ingredients' => $_POST['ingredients'],
          'steps' => $_POST['steps'],
          'serve' => $_POST['serve']
          )) or die('Une erreur s\'est produite');

        echo '<p class="colorMain">La recette a bien été ajouté !</p>';

        move_uploaded_file($_FILES['recipe_picture']['tmp_name'], '../uploads/recipes/'.$name_recipe_picture);

        if($extension_upload == 'png')
          $image = imagecreatefrompng("../uploads/recipes/".$name_recipe_picture."");
        else {
          $image = imagecreatefromjpeg("../uploads/recipes/".$name_recipe_picture."");
        }

        $filename = '../uploads/recipes/400x400_'.$name_recipe_picture;

        $thumb_width = 400;
        $thumb_height = 400;

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ( $original_aspect >= $thumb_aspect )
        {
           // If image is wider than thumbnail (in aspect ratio sense)
           $new_height = $thumb_height;
           $new_width = $width / ($height / $thumb_height);
        }
        else
        {
           // If the thumbnail is wider than the image
           $new_width = $thumb_width;
           $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

        // Resize and crop
        imagecopyresampled($thumb,
                           $image,
                           0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                           0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                           0, 0,
                           $new_width, $new_height,
                           $width, $height);
        imagejpeg($thumb, $filename, 80);

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
