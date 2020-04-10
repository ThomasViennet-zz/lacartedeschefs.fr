<?php
function pwdConfirm()
{
  require 'base.php';

  $req = $bdd->query('SELECT cle FROM password WHERE email = '.$_GET['email']);
  $resultat = $req->fetch();

  if(!$resultat)
  {
    if ($_GET['cle'] == $resultat['cle']) {
      return 'change de mdp';
    }else {
      return 'Le lien n\'est pas valide';
    }
  }else {
    return 'Vous n\'avez pas fait de demande de changement de mot de passe.';
  }
}
?>
