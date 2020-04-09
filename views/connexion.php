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

  <section style="display:flex;justify-content:center;">
    <div style="width:400px;padding:0 10px;">
      <h2>Connectez-vous</h2>
      <form method="post" action="?action=connexion">
        <label for="email">Email</label><input type="email" id="email" name="email" placeholder="Email *"><br>
        <label for="password">Mot de passe</label><input type="password" id="password" name="password" placeholder="Mot de passe *"><br>
        <input type="submit" name="submit" value="Valider" class="button">
      </form>
    </div>
<p class="colorMain"><?php echo $reponse;?></p>
    <div style="width:400px;padding:0 10px;">
      <h2>Créez un compte</h2>
      <form method="post" action="?action=cookRegister">
        <label for="email">Email</label><input type="email" id="email" name="email" placeholder="Votre adresse email *"><br>
        <label for="identifiant">Identifiant</label><input type="text" id="identifiant" name="identifiant" placeholder="Choisissez un identifiant *"><br>
        <label for="password">Mot de passe</label><input type="password" id="password" name="password" placeholder="Votre mot de passe *"><br>
        <label for="passwordConfirm">Confirmer mot de passe</label><input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmer le mot de passe *"><br>
        <input type="submit" name="submit" value="Valider" class="button">
      </form>
    </div>
  </section>
  <?php include 'includes/footer.php';?>
</body>
</html>
