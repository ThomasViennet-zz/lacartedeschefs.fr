<?php
session_start();

  $action = $_GET['action'];

  switch ($action)
  {
      case 'feed':
        include 'views/feed.php';
      break;

      case 'recipe':
          include 'views/recipe.php';
      break;

      case 'listCooks':
          include 'views/listCooks.php';
      break;

      case 'cook':
          if (!empty($_SESSION['id'])) {
            include 'views/cook.php';
          }else {
            include 'views/connexion.php';
          }
      break;

      default:
          include 'views/landingPage.php';
  }
?>
