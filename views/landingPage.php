<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>La carte des chefs</title>
</head>

<body>

  <?php include 'includes/navTop.php';?>
  <?php include 'includes/navFooter.php';?>

  <header>
    <img src="images/logo_la_carte_des_chefs.svg" alt="Logo La carte des chefs" width="80px;"/><br>
    <h1>La carte des chefs</h1>
    <p class="colorMain"><i>Révélons les talents de la gastronomie.</i></p>
  </header>

  <section style="text-align:center;">
    <h2>Le concept</h2>

    <p>
      Le monde regorge de talents de la gastronomie encore méconnus !
    </p>

    <p>
      <strong><i>La carte des chefs</i> c'est une invitation à tous ces talents de marquer l'histoire de la gastronomie.</strong>
    </p>

    <p>
      Tous ceux qui le souhaitent peuvent participer à la compétition en proposant leur recette.
    </p>

    <p>
      Les recettes seront ensuite notées par ceux qui les cuisinent.
    </p>

    <p>
      Ces notes permettent de faire monter ou descendre les participants dans <a href="?action=cookList">le classement des chefs.</a>
    </p>
  </section>

  <section style="text-align:center;">
    <h2>Comment partiper ?</h2>

    <ol>
      <li><a href="?action=account">Créez un compte</a></li>
      <li>Publiez votre recette</li>
    </ol>

    <h2>Comment noter ?</h2>

    <ol>
      <li><a href="?action=feed">Cusiniez une des recettes</a></li>
      <li><a href="?action=account">Créez un compte</a></li>
      <li>Notez la recette</li>
    </ol>

  </section>

  <?php include 'includes/footer.php';?>

</body>
</html>
