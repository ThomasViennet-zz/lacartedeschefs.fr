<?php
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
      $destination = imagecreatetruecolor(300, 300);

      $largeur_source = imagesx($source);
      $hauteur_source = imagesy($source);
      $largeur_destination = imagesx($destination);
      $hauteur_destination = imagesy($destination);

      imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

      imagejpeg($destination, "../uploads/avatars/300x300_".$name_profile_picture."");
      ?>
