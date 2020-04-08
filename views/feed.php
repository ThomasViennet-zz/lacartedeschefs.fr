<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>La carte des chefs</title>
</head>

<body id="Abonner">
  <?php include 'includes/nav.php';?>
  <header>
    <h1>La carte des chefs</h1>
    <p class="colorMain"><i>Révélons les talents de la gastronomie.</i></p>
  </header>
  <section>
    <div class="conteneur">
      <?php include 'models/listRecipes.php';?>
    </div>
  </section>
  <?php include 'includes/footer.php';?>
</body>
</html>
