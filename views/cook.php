<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>Mon compte</title>
</head>

<body>

  <?php include 'includes/navTop.php';?>
  <?php include 'includes/navFooter.php';?>

  <header>
    <div id="cookPicture">
    <?php echo '<img src="uploads/avatars/80x80_'.$cook->picture().'" width="80px" height="80px" class="profilPicture"/>';?>
  </div>
  <div id="cookInfo">
      <h1><?php echo $cook->identifiant();?></h1>
      <?php echo $cook->moyenne();?>
      <?php
      if ($_SESSION['id'] == $cook->id()) {
        echo '<p><a href="?action=accountEdit">Modifier</a></p>';
      }
      ?>
  </header>

  <section>
    <h2 style="text-align:center;">Recettes</h2>
    <div class="conteneur">
      <?php echo $cook->getRecipes($cook->id());?>
    </div>
  </section>

  <?php include 'includes/footer.php';?>

</body>
</html>
