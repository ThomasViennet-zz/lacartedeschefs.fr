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
          $name_recipe_picture = $_SESSION['id'].''.time().'.jpeg';

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
          $req->closeCursor();

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

          unlink('uploads/recipes/'.$name_recipe_picture.'');

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

function recipeList()
{
  require 'base.php';

  $req = $bdd->query('SELECT id FROM recipes ORDER BY date DESC');

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
    '.$recipe->moyenne().'('.$recipe->nbrNote().')<br>
    '.$recipe->title().'
    </div>

    </div>';
  }
}

function recipeFeed()
{
  require 'base.php';

  //Les recettes des cooks que je suis
  $req = $bdd->prepare(
    'SELECT r.id id_recipe
    FROM recipes r
    INNER JOIN followers f
    ON r.id_cook = f.id_following
    WHERE f.id_follower = :id_follower
    ORDER BY r.date DESC');
    $req->execute(array('id_follower' => $_SESSION['id'])) or die ('erreur');

  while ($resultat = $req->fetch()) {
    $recipe = new Recipe($resultat['id_recipe']);
    $cook = new Cook($recipe->idCook());
    echo '
    <div class="element" style="background-color:rgb(245,245,245);">

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

function recipeUpdate($id_recipe) {
  require 'base.php';

  $req = $bdd->prepare(
    'UPDATE recipes
    SET title = :title,
    ingredients = :ingredients,
    steps = :steps,
    serve = :serve
    WHERE id = :id_recipe');
  $req->execute(array(
    'title' => $_POST['title'],
    'ingredients' => $_POST['ingredients'],
    'steps' => $_POST['steps'],
    'serve' => $_POST['serve'],
    'id_recipe' => $id_recipe))
    or die('erreur');

  $_SESSION['post_recipe_title'] = $_POST['title'];
  $_SESSION['post_recipe_ingredients'] = $_POST['ingredients'];
  $_SESSION['post_recipe_steps'] = $_POST['steps'];
  $_SESSION['post_recipe_serve'] = $_POST['serve'];

  return 'La recette a été mise à jour';
}

function recipeUpdateImage($id_recipe) {
  if (isset($_FILES['recipe_picture']) AND $_FILES['recipe_picture']['error'] == 0) {

    if ($_FILES['recipe_picture']['size'] <= 5000000) {

      $infosfichier = pathinfo($_FILES['recipe_picture']['name']);
      $extension_upload = $infosfichier['extension'];
      $extensions_autorisees = array('jpg', 'jpeg', 'png');

      if (in_array($extension_upload, $extensions_autorisees)) {
        require 'base.php';

        $req = $bdd->prepare(
        'SELECT recipe_picture
        FROM recipes
        WHERE id = :id_recipe');
        $req->execute(array('id_recipe' => $id_recipe));
        $resultat = $req->fetch();

        $name_recipe_picture_old = $resultat['recipe_picture'];
        $name_recipe_picture = $_SESSION['id'].''.time().'.jpeg';



        move_uploaded_file($_FILES['recipe_picture']['tmp_name'], 'uploads/recipes/'.$name_recipe_picture);

        if($extension_upload == 'png') {
          $image = imagecreatefrompng("uploads/recipes/".$name_recipe_picture."");
        }
        else {
          $image = imagecreatefromjpeg("uploads/recipes/".$name_recipe_picture."");
        }
        //400x400
        $filename = 'uploads/recipes/400x400_'.$name_recipe_picture;
        $thumb_width = 400;
        $thumb_height = 400;

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ( $original_aspect >= $thumb_aspect ) {
          // If image is wider than thumbnail (in aspect ratio sense)
          $new_height = $thumb_height;
          $new_width = $width / ($height / $thumb_height);
        }
          else {
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

        $req = $bdd->prepare(
          'UPDATE recipes
          SET recipe_picture = :recipe_picture
          WHERE id = :id_recipe');
        $req->execute(array(
          'recipe_picture' => $name_recipe_picture,
          'id_recipe' => $id_recipe))or die('erreur');

        unlink('uploads/recipes/400x400_'.$name_recipe_picture_old.'');
        unlink('uploads/recipes/'.$name_recipe_picture.'');

        return 'Photo enregistrée.';

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
}
