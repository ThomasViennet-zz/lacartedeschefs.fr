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

      <!-- reponse de l'abonnement -->
      <p><?php echo $reponse;?></p>

      <?php echo $cook->nbrFollower();?>
  </header>

<h2 style="text-align:center;">Recettes</h2>

  <section class="conteneur">
      <?php echo $cook->getRecipes($cook->id());?>
  </section>

  <?php include 'includes/footer.php';?>

  <!-- <script src="jquery-3.5.0.js"></script>
  <script src="scripts.js"></script> -->
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
</body>
</html>
