<?php
session_start();

  $action = $_GET['action'];

  switch ($action)
  {
      case 'feed':
        include 'views/feed.php';
      break;

      case 'recipe':
        require 'class/recipe.php';
        require 'class/cook.php';
        $recipe = new Recipe($_GET['id_recipe']);
        $cook = new Cook($recipe->idCook());
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
            require 'class/cook.php';
            $cook = new Cook($_SESSION['id']);
            include 'views/account.php';
          }else {
            include 'views/connexion.php';
          }
      break;

      case 'accountEdit':
          if (!empty($_SESSION['id'])) {
            require 'class/cook.php';
            $cook = new Cook($_SESSION['id']);
            include 'views/accountEdit.php';
          }else {
            include 'views/connexion.php';
          }
      break;

      case 'cook':
        if ($_GET['cook_id']) {
          require 'class/cook.php';
          $cook = new Cook($_GET['cook_id']);
          include 'views/cook.php';
        }
      break;

      default:
          include 'views/landingPage.php';
  }
?>
