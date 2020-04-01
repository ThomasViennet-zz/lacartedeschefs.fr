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
      <h1><?php if(isset($_SESSION['identifiant'])) echo $_SESSION['identifiant']; else echo 'Mon compte'; ?></h1>
      <p class="colorWhite">
        <?php
        if(isset($_SESSION['identifiant']))
        {
          include 'models/moyenneCook.php';
        }
        else
        {
          echo 'Marquez l\'histoire de la gastronomie avec vos délicieuses recettes !';
        }
        ?>
    </div>
  </div>
  <?php
  if(isset($_SESSION['id']))
  {
  ?>
    <section>
      <?php include 'models/listeRecipes.php';?>
      <h2 id="recette">Proposer une recette</h2>
      <p>Marquez l'histoire de la gastronomie avec vos délicieuses recettes !</p>
      <?php include 'models/addRecipe.php';?>
    </section>
  <?php
  }else{
  ?>
  <section>
  <?php include 'includes/addRecipe.php'; ?>
  </section>
  <?php include 'includes/footer.php';
  }
  ?>
</body>
</html>
