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

<img src="/uploads/recipes/<?php echo $recipe->picture();?>" alt="<?php echo $recipe->title();?>" width="100%" height="100%" class="headerBackground"/>

  <header>
    <div id="headerDescription">
      <h1><?php echo $recipe->title();?></h1>
      <div id="cook">
        <a href="?action=cook"><img src="/uploads/avatars/80x80_<?php echo $cook->picture();?>" class="profilPicture" /></a><br>
        <?php echo $cook->moyenne();?><br>
        <span class="colorMain"><?php echo $cook->identifiant();?></span>
      </div>
    </div>
  </header>

  <section id="steps">
    <?php echo $recipe->steps();?>
  </section>

  <section>
    <h2>Noter</h2>
    <?php include 'includes/addVote.php';?>
  </section>

  <?php include 'includes/footer.php';?>
</body>
</html>
