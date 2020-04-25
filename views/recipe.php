<!DOCTYPE html>
<html>
<head>
  <?php include 'includes/gtmHead.php';?>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>La carte des chefs - <?php echo $recipe->title();?></title>
</head>

<body>
  <?php include 'includes/gtmBody.php';?>
  <?php include 'includes/navTop.php';?>
  <?php include 'includes/navFooter.php';?>

  <header id="recipe_header">
    <img src="uploads/recipes/400x400_<?php echo $recipe->picture();?>" alt="<?php echo $recipe->title();?>"/>
  </header>
  <div id="recipe_cook">
    <a href="?action=cook&cook_id=<?php echo $cook->id();?>"><img src="/uploads/avatars/80x80_<?php echo $cook->picture();?>"  width="80px" height="80px" class="profilPicture" /></a>
  </div>

  <section style="text-align:center;">
    <h1 style="color:black;"><u><?php echo $recipe->title();?></u></h1>
    <p>par <a href="?action=cook&cook_id=<?php echo $cook->id();?>"><?php echo $cook->identifiant();?></a><br>
    <?php echo $recipe->moyenne();?><br>
    <?php echo $recipe->nbrNote();?></p>
    <?php
    if ($_SESSION['id'] == $cook->id()) {
      echo '<p><a href="?action=recipeEdit&id_recipe='.$recipe->id().'">Modifier la recette</a></p>';
    }
    ?>

  </section>

  <section id="recipe_ingredients">
    <h2>Ingrédients</h2>
    <?php echo Nl2br($recipe->ingredients());?>
  </section>

  <section id="recipe_steps">
    <h2>Préparation</h2>
    <?php echo Nl2br($recipe->steps());?>
  </section>

  <section id="recipe_serve">
    <h2>Dressage</h2>
    <?php echo Nl2br($recipe->serve());?>
  </section>

  <section id="vote">
    <h2>Noter</h2>
    <p class="colorMain"><?php
    if ($_GET['action'] == 'addVote') {
      echo $reponse;
    }
    ?></p>
<?php
if ($recipe->auth() < 1) {
  echo '<p style="text-align:center;"><strong>Cette recette n\'est pas encore qualifiée pour la compétition.</strong></p>';
}else {
  include 'includes/addVote.php';
}
?>
  </section>

  <?php include 'includes/footer.php';?>
</body>
</html>
