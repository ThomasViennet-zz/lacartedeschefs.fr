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
    <h1>Mon compte</h1>
    <p class="colorMain"><i>Marquez l'histoire de la gastronomie.</i></p>
  </header>

  <p class="colorMain" style="text-align:center;"><?php echo $reponse;?></p>
  <?php echo $reponse;?>
  <section>
      <h2>Modifier votre mot de passe</h2>
      <form method="post" action="?action=forgetPwd&update">
        <label for="email">Mot de passe</label><input type="password" id="password" name="password" placeholder="Choisissez un mot de passe *"><br>
        <input type="submit" name="submit" value="Valider" class="button">
      </form>
  </section>
  <?php include 'includes/footer.php';?>
</body>
</html>
