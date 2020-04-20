<?php
session_start();

  $action = $_GET['action'];

  switch ($action)
  {
      case 'lacartedeschefs':
        require 'class/cook.php';
        include 'views/landingPage.php';
      break;

      case 'follow':
        require 'models/cook.php';
        require 'class/cook.php';
        $reponse = follow($_GET['id_cook']);
        $cook = new Cook($_GET['id_cook']);
        include 'views/cook.php';
      break;

      //Utiliser jquery
      case 'followFeed':
        require 'models/recipe.php';
        require 'models/cook.php';
        require 'class/recipe.php';
        require 'class/cook.php';
        $cookSession = new Cook($_SESSION['id']);
        $reponse = follow($_GET['id_cook']);
        $cook = new Cook($_GET['id_cook']);
        include 'views/feed.php';
      break;

      case 'unfollow':
        require 'models/cook.php';
        require 'class/cook.php';
        $reponse = unfollow($_GET['id_cook']);
        $cook = new Cook($_GET['id_cook']);
        include 'views/cook.php';
      break;

      case 'feed':
        require 'models/recipe.php';
        require 'models/cook.php';
        require 'class/recipe.php';
        require 'class/cook.php';
        $cookSession = new Cook($_SESSION['id']);
        include 'views/feed.php';
      break;

      case 'recipeList':
        require 'models/recipe.php';
        require 'class/recipe.php';
        require 'class/cook.php';
        include 'views/recipeList.php';
      break;

      case 'addVote':
        require 'models/addVote.php';
        require 'class/recipe.php';
        require 'class/cook.php';

        $reponse = addVoteWeighted($_GET['id_recipe']);
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

          if ($cook->auth() > 0) {
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
            include 'views/account.php';
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
          require 'class/cook.php';
          $reponse = recipeUpdateImage($recipe->id());
          $recipe = new Recipe($_GET['id_recipe']);//màj de l'image
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
        if (!empty($_SESSION['id'])) {
          require 'class/cook.php';
          require 'models/cook.php';

          $cook = new Cook($_SESSION['id']);
          $reponse = cookUpdate($cook->id());
          $cook = new Cook($_SESSION['id']);

          include 'views/accountEdit.php';
        }
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

      case 'candidature':
          if (!empty($_SESSION['id'])) {
            require 'models/cook.php';
            $reponse = candidature();

            require 'class/cook.php';
            $cook = new Cook($_SESSION['id']);

            include 'views/account.php';
          }else {
            include 'views/connexion.php';
          }
      break;

      case 'cook':
        if ($_GET['cook_id']) {
          require 'class/cook.php';
          if ($_SESSION['id'] == $_GET['cook_id']) {
            $cook = new Cook($_SESSION['id']);
            include 'views/account.php';
          }else {
            require 'models/cook.php';
            $cook = new Cook($_GET['cook_id']);
            $reponse = following($cook->id());
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
        require 'class/cook.php';
        include 'views/landingPage.php';

  }
?>
