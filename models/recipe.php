<?php
function recipeAdd()
{
  if(!empty($_POST['title']) AND !empty($_POST['ingredients']) AND !empty($_POST['steps']) AND !empty($_POST['serve']))
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

          require 'base.php';

          $req = $bdd->prepare('INSERT INTO recipes (title, id_cook, recipe_picture, ingredients, steps, serve, date) VALUES(:title, :id_cook, :recipe_picture, :ingredients, :steps, :serve, NOW())');
          $req->execute(array(
            'title' => $_POST['title'],
            'id_cook' => $_SESSION['id'],
            'recipe_picture' => $name_recipe_picture,
            'ingredients' => $_POST['ingredients'],
            'steps' => $_POST['steps'],
            'serve' => $_POST['serve']
          )) or die('Une erreur s\'est produite');

          move_uploaded_file($_FILES['recipe_picture']['tmp_name'], 'uploads/recipes/'.$name_recipe_picture);

          if($extension_upload == 'png')
          $image = imagecreatefrompng("uploads/recipes/".$name_recipe_picture."");
          else {
            $image = imagecreatefromjpeg("uploads/recipes/".$name_recipe_picture."");
          }
          //1024x300

          //400x400
          $filename = 'uploads/recipes/400x400_'.$name_recipe_picture;

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

          unset($_SESSION['post_recipe_title']);
          unset($_SESSION['post_recipe_ingredients']);
          unset($_SESSION['post_recipe_steps']);
          unset($_SESSION['post_recipe_serve']);

          header('Location: ../?action=recipe&id_recipe='.$resultat['lastID']);

        }else {
          $_SESSION['post_recipe_title'] = $_POST['title'];
          $_SESSION['post_recipe_ingredients'] = $_POST['ingredients'];
          $_SESSION['post_recipe_steps'] = $_POST['steps'];
          $_SESSION['post_recipe_serve'] = $_POST['serve'];

          return 'Format de photo non autorisé.';
        }
      }else {
        $_SESSION['post_recipe_title'] = $_POST['title'];
        $_SESSION['post_recipe_ingredients'] = $_POST['ingredients'];
        $_SESSION['post_recipe_steps'] = $_POST['steps'];
        $_SESSION['post_recipe_serve'] = $_POST['serve'];

        return 'La photo est trop lourde.';
      }
    }else {
      $_SESSION['post_recipe_title'] = $_POST['title'];
      $_SESSION['post_recipe_ingredients'] = $_POST['ingredients'];
      $_SESSION['post_recipe_steps'] = $_POST['steps'];
      $_SESSION['post_recipe_serve'] = $_POST['serve'];

      return 'Ajoutez une photo.';
    }
  }else {
    $_SESSION['post_recipe_title'] = $_POST['title'];
    $_SESSION['post_recipe_ingredients'] = $_POST['ingredients'];
    $_SESSION['post_recipe_steps'] = $_POST['steps'];
    $_SESSION['post_recipe_serve'] = $_POST['serve'];

    return 'Renseignez toutes les informations.';
  }
}

function recipeEdit()
{
  require 'base.php';

  $req = $bdd->prepare(
    'UPDATE recipes
    SET title = :title,
    ingredients = :ingredients,
    steps = :steps,
    serve = :serve
    WHERE id = :id_recipe') or die('erreur');

  $req->execute(array(
    'title' => $_POST['title'],
    'ingredients' => $_POST['ingredients'],
    'steps' => $_POST['steps'],
    'serve' => $_POST['serve'],
    'id_recipe' => $_GET['id_recipe'])) or die('erreur');

    //photo
}

function recipeList()
{
  require 'base.php';

  $req = $bdd->query('SELECT id FROM recipes');

  while ($resultat = $req->fetch()) {
    $recipe = new Recipe($resultat['id']);
    $cook = new Cook($recipe->idCook());

    echo '<div class="element" style="background-color:rgb(245,245,245);">

    <div style="padding:5px;">
    <a href="?action=cook&cook_id='.$cook->id().'">
    <img src="uploads/avatars/80x80_'.$cook->picture().'" width="30px" class="profilPicture">
    '.$cook->identifiant().'
    </a>
    </div>

    <a href="?action=recipe&id_recipe='.$recipe->id().'">
    <img src="uploads/recipes/400x400_'.$recipe->picture().'"/></a>

    <div style="padding: 5px">
    '.$recipe->moyenne().'<br>
    '.$recipe->title().'
    </div>

    </div>';
  }
}
