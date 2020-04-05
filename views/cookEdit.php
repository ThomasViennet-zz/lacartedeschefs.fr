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
    <img src="images/plateaux_de_legumes_1920px.jpg" alt="Plateaux de légumes"/ height="100%" width="100%" class="headerBackground">
    <div id="headerDescription">
      <h1>Modifier mon Compte</h1>
    </div>

  </header>

  <section>
    <h2>Modifier mes informations</h2>

    <form method="post" action="models/updateCook.php" enctype="multipart/form-data">
      <label for="email">Email</label><input type="email" id="email" name="email" placeholder="<?php echo $cook->email();?> *"><br>
      <label for="identifiant">Identifiant</label><input type="text" id="identifiant" name="identifiant" placeholder="<?php echo $cook->identifiant();?>  *"><br>
      <label for="profile_picture">Photo</label><br>
      <img src="uploads/avatars/<?php echo $cook->picture();?>" width="80px" class="profilPicture"/>
      <input type="file" id="profile_picture" name="profile_picture" />
    <h2>Confirmation</h2>

      <label for="password">Mot de passe</label><input type="password" id="password" name="password" placeholder="Saisissez votre mot de passe *"><br>
      <input type="submit" name="submit" value="Valider" class="button">
    </form>
  </section>
</body>
</html>
