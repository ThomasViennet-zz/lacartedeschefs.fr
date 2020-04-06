<?php
session_start();

require '../base.php';

$req = $bdd->prepare('SELECT password FROM cooks WHERE id = :id');
$req->execute(array('id' => $_SESSION['id']));
$resultat = $req->fetch();
$req->closeCursor();

$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

if ($isPasswordCorrect) {

  //changer email
  if (!empty($_POST['email'])) {

    $req = $bdd->prepare('SELECT email FROM cooks WHERE email = :email');
    $req->execute(array('email' => $_POST['email']));
    $resultat = $req->fetch();

    if(empty($resultat['email']))
    {
      $req = $bdd->prepare('UPDATE cooks SET email = :email WHERE id = :id');
      $req->execute(array(
        'email' => $_POST['email'],
        'id' => $_SESSION['id']
      )) or die('Une erreur s\'est produite');

      echo 'Adresse email sauvegardée<br>';
    }else {
      echo 'Cette adresse email est déjà utilisée<br>';
    }
  }

  // Changer identifiant
  if (!empty($_POST['identifiant'])) {
    $req = $bdd->prepare('SELECT identifiant FROM cooks WHERE identifiant = :identifiant');
    $req->execute(array('identifiant' => $_POST['identifiant']));
    $resultat = $req->fetch();

    if(!empty($resultat))
    {
      echo 'Cet identifiant est déjà utilisé.<br>';
    }else {
      $req = $bdd->prepare('UPDATE cooks SET identifiant = :identifiant WHERE id = :id');
      $req->execute(array(
        'identifiant' => $_POST['identifiant'],
        'id' => $_SESSION['id']
      )) or die('Une erreur s\'est produite');
      echo 'Identifiant sauvegardé<br>';
    }
  }

  //Changer photo
  if (isset($_FILES['profile_picture']) AND $_FILES['profile_picture']['error'] == 0)
  {
    if ($_FILES['profile_picture']['size'] <= 5000000)
    {
      $infosfichier = pathinfo($_FILES['profile_picture']['name']);
      $extension_upload = $infosfichier['extension'];
      $extensions_autorisees = array('jpg', 'jpeg', 'png');
      if (in_array($extension_upload, $extensions_autorisees))
      {
        $name_profile_picture = time().''.rand().'.jpeg';

        move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../uploads/avatars/'.$name_profile_picture);

        if($extension_upload == 'png')
          $image = imagecreatefrompng("../uploads/avatars/".$name_profile_picture."");
        else {
          $image = imagecreatefromjpeg("../uploads/avatars/".$name_profile_picture."");
        }

        $filename = '../uploads/avatars/80x80_'.$name_profile_picture;

        $thumb_width = 80;
        $thumb_height = 80;

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

        $req = $bdd->prepare('UPDATE cooks SET profile_picture = :profile_picture WHERE id = :id');
        $req->execute(array(
          'profile_picture' => $name_profile_picture,
          'id' => $_SESSION['id']
        )) or die('Une erreur s\'est produite<br>');
      }
    }
  }
  echo '
  Si vous n\'êtes pas redirigé, <a href="../?action=accountEdit">cliquez ici</a>.';
  header("refresh:3;url=../?action=accountEdit");
}else {
  echo 'Mauvais mot de passe !<br>
  Si vous n\'êtes pas redirigé, <a href="../?action=accountEdit">cliquez ici</a>.';
  header("refresh:3;url=../?action=accountEdit");
}


?>
