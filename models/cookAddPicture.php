<form action="models/cookAddPicture.php" method="post" enctype="multipart/form-data">
<input type="file" name="profile_picture" /><br />
<input type="submit" value="Sauvegarder"/>
</form>
<?php
session_start();

$name_profile_picture = time().''.rand().'.jpeg';

if (isset($_FILES['profile_picture']) AND $_FILES['profile_picture']['error'] == 0)
{
  if ($_FILES['profile_picture']['size'] <= 5000000)
  {
    $infosfichier = pathinfo($_FILES['profile_picture']['name']);
    $extension_upload = $infosfichier['extension'];
    $extensions_autorisees = array('jpg', 'jpeg', 'png');
    if (in_array($extension_upload, $extensions_autorisees))
    {
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

      require '../base.php';

      $req = $bdd->prepare('UPDATE cooks SET profile_picture = :profile_picture WHERE id = :id');
      $req->execute(array(
        'profile_picture' => $name_profile_picture,
        'id' => $_SESSION['id']
      )) or die('Une erreur s\'est produite');

      header('Location: ../?action=cook');
    }
  }
}
?>
