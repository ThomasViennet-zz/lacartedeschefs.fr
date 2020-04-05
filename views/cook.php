<?php
require 'class/cook.php';
$cook = new Cook($_SESSION['id']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/Logo_la_carte_des_chefs_30px.png">
  <title>Mon compte</title>
</head>

<body id="Abonner">
  <?php include 'includes/nav.php';?>
  <header>
    <div id="cookPicture">
    <?php
    if (empty($cook->picture())) {
      include 'images/account.svg';
    }else {
      echo '
      <img src="uploads/avatars/80x80_'.$cook->picture().'" width="80px" height="80px" class="profilPicture"/>';
    }
    ?>
  </div>
  <div id="cookInfo">
      <h1><?php echo $cook->identifiant();?></h1>
      <?php echo $cook->moyenne();?>
        <p><a href="models/deconnexion.php">Ce n'est pas vous ?</a></p>
  </header>

  <section>
    <h2 style="text-align:center;">Vos recettes</h2>
    <div class="conteneur">
      <?php echo $cook->getRecipes($_SESSION['id']);?>
    </div>
  </section>

  <?php include 'includes/footer.php';?>

</body>
</html>
