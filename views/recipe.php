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
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>La carte des chefs - <?php echo $recipe->title();?></title>
</head>

<body id="Abonner">
  <?php include 'includes/nav.php';?>

  <header id="recipe_header">
    <img src="uploads/recipes/400x400_<?php echo $recipe->picture();?>" alt="<?php echo $recipe->title();?>"/>
  </header>
  <div id="recipe_cook">
    <a href="?action=cook&cook_id=<?php echo $cook->id();?>"><img src="/uploads/avatars/80x80_<?php echo $cook->picture();?>"  width="80px" height="80px" class="profilPicture" /></a><br>
    <h2><?php echo $cook->identifiant();?></h2>
    <?php echo $cook->moyenne();?><br>
  </div>

  <section>
    <h1 style="text-align:center;color:black;"><u><?php echo $recipe->title();?></u></h1>
  </section>

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

  <section>
    <h2>Noter</h2>
    <?php include 'includes/addVote.php'; ?>
  </section>

  <?php include 'includes/footer.php';?>
</body>
</html>
