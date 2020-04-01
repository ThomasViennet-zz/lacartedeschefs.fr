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

  <?php include 'includes/header.php'; ?>

  <div id="slider">
    <img src="images/plateaux_de_legumes_1920px.jpg" alt="Plateaux de légumes"/>
    <div id="description_slider">
      <h1><?php echo $cook->identifiant();?></h1>
      <p class="colorWhite">
      <?php include 'models/moyenneCook.php';?>
    </div>
  </div>
    <section>
      <h2>Vos recettes</h2>
      <?php include 'models/listeRecipes.php';?>
      <h2 id="recette">Proposer une recette</h2>
      <p>Marquez l'histoire de la gastronomie avec vos délicieuses recettes !</p>
      <?php include 'models/addRecipe.php';?>
    </section>
</body>
</html>
