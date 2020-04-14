<!DOCTYPE html>
<html>
<head>
  <?php include 'includes/gtmHead.php';?>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>Mon compte</title>
</head>

<body>
  <?php include 'includes/gtmBody.php';?>
  <?php include 'includes/navTop.php';?>
  <?php include 'includes/navFooter.php';?>

  <header>
    <div id="cookPicture">
    <?php echo '<img src="uploads/avatars/80x80_'.$cook->picture().'" width="80px" height="80px" class="profilPicture"/>';?>
  </div>
  <div id="cookInfo">
      <h1><?php echo $cook->identifiant();?></h1>
      <?php echo $cook->etoile();?><br>
      <?php echo $cook->nbrFollower();?>

        <p><a href="?action=accountEdit">Modifier</a></p>
        <p><a href="models/deconnexion.php">Ce n'est pas vous ?</a></p>
  </header>

  <h2 style="text-align:center;">Vos recettes</h2>
  <p style="text-align:center;"><a href="?action=recipeAdd">Ajouter une recette</a></p>

  <section class="conteneur">
    <?php echo $cook->getRecipes($_SESSION['id']);?>
  </section>

  <?php include 'includes/footer.php';?>

</body>
</html>
