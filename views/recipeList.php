<!DOCTYPE html>
<html>
<head>
  <?php include 'includes/gtmHead.php';?>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>La carte des chefs</title>
</head>

<body>
  <?php include 'includes/gtmBody.php';?>
  <?php include 'includes/navTop.php';?>
  <?php include 'includes/navFooter.php';?>

  <header>
    <h1>La carte des chefs</h1>
    <p class="colorMain"><i>Révélons les talents de la gastronomie.</i></p>
  </header>
  <section class="conteneur">
    <!-- <p><u>Début de la compétition le dimanche 26 avril 2020</u></p> -->
    <!-- afficher nbr de points des recipes -->
      <?php echo recipeList();?>
  </section>
  <?php include 'includes/footer.php';?>
</body>
</html>
