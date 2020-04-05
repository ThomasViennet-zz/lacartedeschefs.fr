<?php
session_start();

require '../base.php';

$req = $bdd->prepare('SELECT password FROM cooks WHERE id = :id');
$req->execute(array('id' => $_SESSION['id']));
$resultat = $req->fetch();
$req->closeCursor();

$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

if ($isPasswordCorrect) {

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

    }else {
      echo 'email déjà utilisé';
    }
  }else {
    echo 'pas d\'email';
  }

  if (!empty($_POST['identifiant'])) {
    $req = $bdd->prepare('SELECT identifiant FROM cooks WHERE identifiant = :identifiant');
    $req->execute(array('identifiant' => $_POST['identifiant']));
    $resultat = $req->fetch();

    if(!empty($resultat))
    {
      echo '<p class="colorMain">Cet identifiant est déjà utilisé.<p>';
    }else {
      $req = $bdd->prepare('UPDATE cooks SET identifiant = :identifiant WHERE id = :id');
      $req->execute(array(
        'identifiant' => $_POST['identifiant'],
        'id' => $_SESSION['id']
      )) or die('Une erreur s\'est produite');
    }
  }else {
    echo 'pas d\'identifiant';
  }

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
        $source = imagecreatefrompng("../uploads/avatars/".$name_profile_picture."");
        else {
          $source = imagecreatefromjpeg("../uploads/avatars/".$name_profile_picture."");
        }
        //
        $largeur_source = imagesx($source);
        $longueur_source = imagesy($source);
        $ratio = $largeur_source / $longueur_source;
        $largeur_finale = 200;
        $longueur_finale = $largeur_finale / $ratio;

        $image_finale = imagecreatetruecolor($largeur_finale, $longueur_finale);

        imagecopyresampled($image_finale, $image_initiale, 0, 0, 0, 0, $largeur_finale, $longueur_finale, $largeur_source, $longueur_source);
        imagejpeg($image_finale, "../uploads/avatars/300x300_".$name_profile_picture."");
        //
        // $destination = imagecreatetruecolor(300, 300);
        //
        // $largeur_source = imagesx($source);
        // $hauteur_source = imagesy($source);
        // $largeur_destination = imagesx($destination);
        // $hauteur_destination = imagesy($destination);
        //
        // imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
        //
        // imagejpeg($destination, "../uploads/avatars/300x300_".$name_profile_picture."");

        $req = $bdd->prepare('UPDATE cooks SET profile_picture = :profile_picture WHERE id = :id');
        $req->execute(array(
          'profile_picture' => $name_profile_picture,
          'id' => $_SESSION['id']
        )) or die('Une erreur s\'est produite');
      }
    }
  }else {
    echo 'pas d\'image';
  }
}else {
  echo 'mauvais mdp';
}

// header('Location: ../?action=cook');
?>
