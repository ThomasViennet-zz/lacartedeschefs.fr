<?php
session_start();

  $action = $_GET['action'];

  switch ($action)
  {
      case 'feed':
        require 'models/recipe.php';
        require 'class/recipe.php';
        require 'class/cook.php';

        include 'views/feed.php';
      break;

      case 'addVote':
        require 'models/addVote.php';
        require 'class/recipe.php';
        require 'class/cook.php';

        $reponse = addVote();
        $recipe = new Recipe($_GET['id_recipe']);
        $cook = new Cook($recipe->idCook());

        include 'views/recipe.php';
      break;

      case 'recipe':
        require 'class/recipe.php';
        require 'class/cook.php';

        $recipe = new Recipe($_GET['id_recipe']);
        $cook = new Cook($recipe->idCook());

        include 'views/recipe.php';
      break;

      case 'recipeEdit':
        if (!empty($_SESSION['id'])) {
            require 'class/recipe.php';
            $recipe = new Recipe($_GET['id_recipe']);

            if ($recipe->idCook() == $_SESSION['id']) {
              $_SESSION['post_recipe_title'] = $recipe->title();
              $_SESSION['post_recipe_ingredients'] = $recipe->ingredients();
              $_SESSION['post_recipe_steps'] = $recipe->ingredients();
              $_SESSION['post_recipe_serve'] = $recipe->ingredients();
            }
            include 'views/recipeAdd.php';
          }else {
          include 'views/connexion.php';
        }
      break;

      case 'recipeAdd':
        if (!empty($_SESSION['id'])) {
          if (isset($_GET['sent'])) {
            require 'models/recipe.php';
            $reponse = recipeAdd();
            include 'views/recipeAdd.php';

          }else {
            unset($_SESSION['post_recipe_title']);
            unset($_SESSION['post_recipe_ingredients']);
            unset($_SESSION['post_recipe_steps']);
            unset($_SESSION['post_recipe_serve']);
            include 'views/recipeAdd.php';
          }
        }else {
          include 'views/connexion.php';
        }
      break;

      case 'recipeSent':
        if (!empty($_SESSION['id'])) {
          require 'models/recipe.php';
          $reponse = recipeAdd();
        }else {
          include 'views/connexion.php';
        }
      break;

      case 'cookRegister':
          include 'models/cook.php';
          $reponse = cookRegister();
          include 'views/connexion.php';
      break;

      case 'cookUpdate':
        require 'class/cook.php';
        require 'models/cook.php';
        $reponse = cookUpdate();
        $cook = new Cook($_SESSION['id']);

        include 'views/accountEdit.php';
      break;

      case 'connexion':
          include 'models/connexion.php';
          $reponse = connexion();
          include 'views/connexion.php';
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
          if ($_SESSION['id'] == $_GET['cook_id']) {
            require 'class/cook.php';
            $cook = new Cook($_SESSION['id']);
            include 'views/account.php';
          }else {
            require 'class/cook.php';
            $cook = new Cook($_GET['cook_id']);
            include 'views/cook.php';
          }
        }
      break;

      case 'cookList':
          require 'class/cook.php';
          require 'models/cook.php';
          include 'views/cooksList.php';
      break;

      case 'forgetPwd':
        if (isset($_GET['sent'])) {
          require 'models/cook.php';
          $reponse = forgetPwd();
        }elseif (isset($_GET['update'])) {
          require 'models/password.php';
          $reponse = pwdConfirm();
          include 'views/forgetPwdConfirm.php';
        }
      break;

      default:
          include 'views/landingPage.php';
  }
?>
