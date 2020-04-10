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
    <p>
      Ceux qui cuisinent les recettes, peuvent attribuer entre une et trois étoiles aux recettes.<br>
      <br>
      <strong>Ces étoiles donnent des points aux chefs, qui les font évoluer dans le classement :</strong><br>
      <br>
    </p>

    <ul>
      <li>3 étoiles donne 3 points</li>
      <li>2 étoiles donne 2 points</li>
      <li>1 étoile donne 1 point</li>
    </ul>

    <p>
      L'ordre des chefs dans le classement est pondéré.<br>
      <strong>Plus vous aurez de bonnes notes plus vous serez haut dans le classement.</strong>
    </p>
    </section>

    <?php include 'includes/footer.php';?>

  </body>
  </html>
