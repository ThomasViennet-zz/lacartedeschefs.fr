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

  <div id="headerCook">
    <div id="cookPicture">
      <?php echo '<img src="uploads/avatars/80x80_'.$cook->picture().'" width="80px" height="80px" class="profilPicture"/>';?>
    </div>
      <?php echo $cook->etoile();?>
      <h1 style="color:black;"><?php echo $cook->identifiant();?></h1>
      <?php echo $cook->nbrFollower();?><br>

      <!-- Follow -->
    <p><?php echo $reponse;?></p>

      <p><?php echo $cook->bio();?></p>
      <a href="https://www.<?php echo $cook->url();?>" target="_blank" rel="ugc"><?php echo $cook->url();?></a><br>
  </div>


<h2 style="text-align:center;">Recettes</h2>

  <section class="conteneur">
      <?php echo $cook->getRecipes($cook->id());?>
  </section>

  <?php include 'includes/footer.php';?>

</body>
</html>
