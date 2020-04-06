<?php
require 'class/cook.php';
$cook = new Cook($_SESSION['id']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>Mon compte</title>
</head>

<body id="Abonner">
  <?php include 'includes/nav.php';?>
  <header>
      <h1>Modifier mon Compte</h1>
  </header>

  <section>
    <h2>Modifier mes informations</h2>

    <form method="post" action="models/updateCook.php" enctype="multipart/form-data">
      <label for="email">Email</label><input type="email" id="email" name="email" placeholder="<?php echo $cook->email();?> *"><br>
      <label for="identifiant">Identifiant</label><input type="text" id="identifiant" name="identifiant" placeholder="<?php echo $cook->identifiant();?>  *"><br>
      <label for="profile_picture">Photo</label><br>
      <img src="uploads/avatars/80x80_<?php echo $cook->picture();?>" width="80px" class="profilPicture"/>
      <input type="file" id="profile_picture" name="profile_picture" />
    <h2>Confirmation</h2>

      <label for="password">Mot de passe</label><input type="password" id="password" name="password" placeholder="Saisissez votre mot de passe *"><br>
      <input type="submit" name="submit" value="Valider" class="button">
    </form>
  </section>

  <?php include 'includes/footer.php';?>
</body>
</html>
