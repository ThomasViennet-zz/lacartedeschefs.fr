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
    <h1>Les chefs</h1>
    <p class="boldItalic">Révélons les talents de la gastronomie.</p>
  </header>

  <section style="text-align:center;">
    <h2>Comment fonctionne le classement ?</h2>

    <p>
      Ceux qui cuisinent les recettes peuvent noter les recettes.
    </p>

    <p>
      Ces notes font évoluer les chefs dans le classment.
    </p>

    <p>
      Les meilleurs chefs obtiennent des étoiles.
    </p>
    <p>
      <strong>Vous êtes un chef "étoilé" ?</strong><br>
      Vos notes donnent ont plus de de points et vous pouvez uniquement noter des chefs qui ont moins d'étoiles que vous.
    </p>

  </section>

  <section>
    <h2>Le classement des chefs</h2>

    <!-- <section style="text-align:center;">
      <p>[ Phase de qualification ]</p>
      <p>Pour participer, <a href="?action=account">créez un compte</a> et candidatez depuis votre compte.</p>
    </section> -->
    <div class="conteneur">
      <?php cookList(100); ?>
    </div>
  </section>

    <?php include 'includes/footer.php';?>

  </body>
  </html>
