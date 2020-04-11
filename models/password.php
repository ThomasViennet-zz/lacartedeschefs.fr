<?php
function pwdConfirm($email)
{
  require 'base.php';

  $req = $bdd->prepare('SELECT cle FROM password WHERE email = :email');
  $req->execute(array('email' => $email)) or die('Une erreur s\'est produite');
  $resultat = $req->fetch();

  return $resultat['cle'];
}

function pwdUpdate($email, $pwd)
{
  if ($_POST['passwordConfirm'] == $_POST['password']) {
    require 'base.php';
    $password_hash = password_hash($pwd, PASSWORD_DEFAULT);



    $req = $bdd->prepare('UPDATE cooks SET password = :pwd WHERE email = :email');
    $req->execute(array('email' => $email, 'pwd' => $password_hash)) or die('Une erreur s\'est produite');

    return 'Votre mot de passe a été mis à jour.';
  }else {
    return 'Les mots de passe ne correspondent pas.';
  }

}
