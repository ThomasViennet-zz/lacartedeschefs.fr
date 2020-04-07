<?php
session_start();

echo crypt('lcdc');

  $action = $_GET['action'];

  switch ($action)
  {
      case 'feed':
        include 'views/feed.php';
      break;

      case 'recipe':
          include 'views/recipe.php';
      break;

      case 'recipeAdd':
        if (!empty($_SESSION['id'])) {
          include 'views/addRecipe.php';
        }else {
          include 'views/connexion.php';
        }
      break;

      case 'listCooks':
          include 'views/listCooks.php';
      break;

      case 'account':
          if (!empty($_SESSION['id'])) {
            include 'views/account.php';
          }else {
            include 'views/connexion.php';
          }
      break;

      case 'accountEdit':
          if (!empty($_SESSION['id'])) {
            include 'views/accountEdit.php';
          }else {
            include 'views/connexion.php';
          }
      break;

      case 'cook':
        if ($_GET['cook_id']) {
          $cook_id = $_GET['cook_id'];
          include 'views/cook.php';
        }
      break;

      default:
          include 'views/landingPage.php';
  }
?>
