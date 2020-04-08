<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>Mon compte</title>
</head>

<body>

  <?php include 'includes/navTop.php';?>
  <?php include 'includes/navFooter.php';?>

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
    <h2>Sécurité</h2>

      <label for="password">Votre mot de passe</label><input type="password" id="password" name="password" placeholder="Saisissez votre mot de passe *"><br>
      <input type="submit" name="submit" value="Valider" class="button">
    </form>
  </section>

  <?php include 'includes/footer.php';?>
</body>
</html>
