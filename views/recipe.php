<?php
require 'class/recipe.php';
require 'class/cook.php';
$recipe = new Recipe($_GET['id_recipe']);
$cook = new Cook($recipe->idCook());
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/Logo_la_carte_des_chefs_30px.png">
  <title>La carte des chefs - <?php echo $recipe->title();?></title>
</head>

<body id="Abonner">
  <?php include 'includes/nav.php';?>

  <header id="recipe_header">
    <div id="recipe_picture">
      <img src="/uploads/recipes/400x400_<?php echo $recipe->picture();?>" alt="<?php echo $recipe->title();?>"/>
    </div>
    <div id="recipe_infos">
      <h1><?php echo $recipe->title();?></h1>
      <h2>Noter</h2>
      <?php include 'includes/addVote.php';?>
    </div>
  </header>

  <div id="recipe_cook">
    <a href="?action=cook"><img src="/uploads/avatars/80x80_<?php echo $cook->picture();?>" class="profilPicture" /></a><br>
    <h2><?php echo $cook->identifiant();?></h2>
    <?php echo $cook->moyenne();?><br>
  </div>

  <section id="recipe_ingredients">
    <h2>Ingrédients</h2>
    <?php echo $recipe->ingredients();?>
  </section>

  <section id="recipe_steps">
    <h2>Préparation</h2>
    <?php echo $recipe->steps();?>
  </section>

  <section id="recipe_serve">
    <h2>Servir</h2>
    <?php echo $recipe->serve();?>
  </section>

  <?php include 'includes/footer.php';?>
</body>
</html>
