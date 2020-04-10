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
  <section>
      <h2>Modifier votre mot de passe</h2>
      <form method="post" action="?action=forgetPwd&sent">
        <label for="email">Votre email</label><input type="email" id="email" name="email" placeholder="Email *"><br>
        <input type="submit" name="submit" value="Valider" class="button">
      </form>
  </section>
  <?php include 'includes/footer.php';?>
</body>
</html>
