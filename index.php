<?php
session_start();

if(isset($_GET['action']))
{
  if($_GET['action'] == 'account')
  include 'views/account.php';

  if($_GET['action'] == 'recipe')
  include 'views/recipe.php';

  if($_GET['action'] == 'accueil')
  include 'views/landingPage.php';
}else{
  include 'views/landingPage.php';
}

?>
