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
    <p class="colorMain"><i>Révélons les talents de la gastronomie.</i></p>
  </header>

  <section>
    <h2>Le classement des chefs</h2>

    <div class="conteneur">
      <!-- <p><u>Début de la compétition le dimanche 26 avril 2020</u></p> -->
      <?php cookList(); ?>
    </div>
  </section>

  <section style="text-align:center;">
    <h2>Comment fonctionne le classement ?</h2>
    <!-- <p>
      Ceux qui cuisinent les recettes, peuvent attribuer entre une et trois étoiles aux recettes.
    </p> -->
    <!-- <p>
      <strong>L'ordre des chefs dans le classement est basé sur leur moyenne pondérée.</strong>
    </p> -->
    <p>
      Ceux qui cuisinent les recettes peuvent noter les recettes.
    </p>

    <p>
      <strong>Vous êtes un chef "étoilé" ?</strong><br>
      Vos notes donnent plus de points et vous pouvez uniquement noter des chefs qui ont moins d'étoiles que vous.
    </p>


    </section>

    <?php include 'includes/footer.php';?>

  </body>
  </html>
