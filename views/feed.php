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
      <img src="images/plateaux_de_legumes_1920px.jpg" alt="Plateaux de légumes"/ height="100%" width="100%" class="headerBackground">
      <div id="headerDescription">
        <h1>La carte des chefs</h1>
        <p><i>Nous révélons les passionnés de la gastronomie.</i></p>
      </div>
  </header>
  <?php include 'models/listRecipes.php';?>
  <?php include 'includes/footer.php';?>
</body>
</html>
