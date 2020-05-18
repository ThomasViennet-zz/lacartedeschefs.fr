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

  <header id="headerLanding">
    <img src="images/logo_la_carte_des_chefs.svg" alt="Logo La carte des chefs" width="80px;"/><br>
    <h1>La carte des chefs</h1>
    <p class="boldItalic">Révélons les talents de la gastronomie.</p>
  </header>

  <section style="text-align:center;">
    <h2>Le concept</h2>

    <p>
      Le monde regorge de talents de la gastronomie encore méconnus !
    </p>

    <p>
      <span class="boldItalic">La carte des chefs</span><strong> c'est une invitation à tous ces talents de marquer l'histoire de la gastronomie.</strong>
    </p>

    <p>
      Les participants s'affrontent en publiant leurs plus délicieuses recettes.
    </p>

    <p>
      Les recettes sont ensuite notées par ceux qui les cuisinent.
    </p>

    <p>
      Ces notes font évoluer les participants dans <a href="?action=cookList">le classement</a>.
    </p>
  </section>

  <section style="text-align:center;">
    <h2>Comment partiper ?</h2>

    <ol>
      <li><a href="?action=account">Créez un compte</a></li>
      <li>Candidatez depuis votre compte</li>
    </ol>

    <h2>Comment noter ?</h2>

    <ol>
      <li><a href="?action=recipeList ">Cusiniez une des recettes</a></li>
      <li>Notez la recette</li>
    </ol>

  </section>

  <?php include 'includes/footer.php';?>

</body>
</html>
