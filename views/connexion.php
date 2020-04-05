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
      <h1>Mon compte</h1>
        <p><i>Marquez l'histoire de la gastronomie.</i></p>
    </div>
  </header>

  <section class="conteneur">
    <div class="element">
      <h2>Créer un compte</h2>
      <form method="post" action="models/registerCook.php" enctype="multipart/form-data">
        <label for="email">Email</label><input type="email" id="email" name="email" placeholder="Votre adresse email *"><br>
        <label for="identifiant">Identifiant</label><input type="text" id="identifiant" name="identifiant" placeholder="Choisissez un identifiant *"><br>
        <label for="password">Mot de passe</label><input type="password" id="password" name="password" placeholder="Votre mot de passe *"><br>
        <label for="passwordConfirm">Confirmer mot de passe</label><input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmer le mot de passe *"><br>
        <input type="submit" name="submit" value="Valider" class="button">
      </form>
    </div>
    <div class="element">
      <h2>Se connecter</h2>
      <form method="post" action="models/connexion.php">
        <label for="email">Email</label><input type="email" id="email" name="email" placeholder="Email *"><br>
        <label for="password">Mot de passe</label><input type="password" id="password" name="password" placeholder="Mot de passe *"><br>
        <input type="submit" name="submit" value="Valider" class="button">
      </form>
    </div>
  </section>
</body>
</html>
