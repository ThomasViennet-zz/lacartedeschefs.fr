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

      case 'recipeAdd':
        if (!empty($_SESSION['id'])) {
          require 'class/cook.php';
          $cook = new Cook($_SESSION['id']);

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

      case 'recipeEdit':
        require 'class/recipe.php';
        $recipe = new Recipe($_GET['id_recipe']);

        if ($recipe->idCook() == $_SESSION['id']) {
          require 'class/cook.php';
          $cook = new Cook($recipe->idCook());

          $_SESSION['post_recipe_title'] = $recipe->title();
          $_SESSION['post_recipe_ingredients'] = $recipe->ingredients();
          $_SESSION['post_recipe_steps'] = $recipe->steps();
          $_SESSION['post_recipe_serve'] = $recipe->serve();

          include 'views/recipeEdit.php';
        }else {
          include 'views/connexion.php';
        }
      break;

      case 'recipeUpdate':
        require 'class/recipe.php';
        $recipe = new Recipe($_GET['id_recipe']);

        if ($recipe->idCook() == $_SESSION['id']) {
          require 'models/recipe.php';
          $reponse = recipeUpdate($recipe->id());

          require 'class/cook.php';
          $cook = new Cook($recipe->idCook());
          include 'views/recipeEdit.php';

        }else {
          include 'views/connexion.php';
        }
      break;

      case 'recipeEditImage':
        require 'class/recipe.php';
        $recipe = new Recipe($_GET['id_recipe']);

        if ($recipe->idCook() == $_SESSION['id']) {
          require 'models/recipe.php';
          $reponse = recipeUpdateImage($recipe->id());

          require 'class/cook.php';
          $cook = new Cook($recipe->idCook());

          include 'views/recipeEdit.php';

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

        require 'models/cook.php';
        $reponse = cookUpdate();

        require 'class/cook.php';
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

        if (isset($_GET['ask'])) { //Demande de réinitialisation

          require 'models/cook.php';
          $reponse = forgetPwd($_POST['email']);
          include 'views/forgetPwd.php';


        }elseif (isset($_GET['update']) AND !isset($_GET['sent'])) { //form de nv pwd

          require 'models/cook.php';
          $reponse = pwdConfirm($_GET['email'], $_GET['cle']);
          include 'views/forgetPwdConfirm.php';

        }elseif (isset($_GET['sent'])) { //confirmation nv pwd

          require 'models/cook.php';
          $reponse = pwdUpdate($_GET['email'], $_POST['password'], $_GET['cle']);
          include 'views/forgetPwdConfirm.php';

        }else {
          include 'views/forgetPwd.php';
        }
      break;

      default:
          include 'views/landingPage.php';
  }
?>
