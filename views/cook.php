<?php
require 'class/cook.php';
$cook = new Cook($_SESSION['id']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/Logo_la_carte_des_chefs_30px.png">
  <title>Mon compte</title>
</head>

<body id="Abonner">
  <?php include 'includes/nav.php';?>
  <header>
    <img src="images/plateaux_de_legumes_1920px.jpg" alt="Plateaux de légumes"/ height="100%" width="100%" class="headerBackground">
    <div id="headerDescription">
      <h1><?php echo $cook->identifiant();?></h1>
      <img src="uploads/avatars/300x300_<?php echo $cook->picture();?>" width="80px" class="profilPicture"/><br>
      <?php echo $cook->moyenne();?>
    </div>
  </header>

  <section>
    <h2>Vos recettes</h2>
    <div class="conteneur">
      <?php echo $cook->getRecipes($_SESSION['id']);?>
    </div>
  </section>

  <section>
    <h2 id="recette">Proposer une recette</h2>
    <p>Marquez l'histoire de la gastronomie avec vos délicieuses recettes !</p>
    <?php include 'includes/addRecipe.php';?>
  </section>
</body>
</html>
