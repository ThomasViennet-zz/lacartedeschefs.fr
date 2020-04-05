<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/Logo_la_carte_des_chefs_30px.png">
  <title>La carte des chefs</title>
</head>

<body id="Abonner">
  <?php include 'includes/nav.php';?>

  <header>
      <img src="images/plateaux_de_legumes_1920px.jpg" alt="Plateaux de légumes"/ height="100%" width="100%" class="headerBackground">
      <div id="headerDescription">
        <h1>La carte des chefs</h1>
        <p><i>Nous révélons les passionnés de la gastronomie.</i></p>
      </div>
  </header>

  <section>
    <h2>Qu'est-ce que c'est ?</h2>

    <p>
      Le monde regorge de talents de la gastronomie méconnus.<br>
      Recevez par email le top 10 leurs plus délicieuses recettes.
    </p>

    <p>
      Régulièrement nous proposons une thématique culinaire.<br>
      Tous ceux qui le souhaitent peuvent participer à la compétition en proposant leur recette.
    </p>

    <p>
      Les 10 recettes ayant reçu le plus de votes sont retenues pour <i>La carte des chefs</i>,
      que nous envoyons par email aux abonnés.
    </p>

    <p>
      Cerise sur le gâteau, ceux qui cuisinent les recettes des chefs ont la possibilité de donner des notes aux plats.
    </p>

    <p>
      Ces notes permettent de faire monter ou descendre les participants dans <a href="?action=cooks">le classement des chefs.</a>
    </p>

    <p>
      <i>La carte des chefs</i>, c'est une invitation ouverte à tous, de marquer l'histoire de la gastronomie.
    </p>
  </section>
  <section>
    <h2>Comment se déroule la compétition ?</h2>

    <h3>Phase de sélection</h3>

    <ol>
      <li>Une thématique culinaire est proposée sur <a href="https://www.instagram.com/la_carte_des_chefs/" target="_blank" alt="Profil instagram la carte des chefs/">notre profil Instagram</a></li>
      <li>Ceux qui le souhaitent proposent une seule recette sur leur profil Instagram en notifiant @la_carte_des_chefs</li>
      <li>Nous publions les recettes sur <a href="https://www.instagram.com/la_carte_des_chefs/" target="_blank" alt="Profil instagram la carte des chefs/">notre profil Instagram</a> pour que tout le monde puisse voter en "likant".</li>
      <li>Les 10 participants qui reçoivent le plus de votes sont sélectionnées pour <i>La carte des chefs</i> de la thématique</li>
    </ol>

    <h3>Phase de notation</h3>
    <ol>
      <li>Les abonnées recoivent par email <i>La carte des chefs</i></li>
      <li>Ceux qui cuisinent une recette peuvent la noter</li>
      <li>Les notes font évoluer les chefs dans <a href="?action=cooks">le classement des chefs</a></li>
    </ol>
  </section>
<section id="abonnement">
  <h2>Recevoir <i>La carte des chefs</i></h2>
  <p class="colorMain"><?php echo $_GET['message'];?></p>
  <form method="post" action="models/registerCook.php">
    <label for="email">Votre adresse email</label><input type="email" id="email" name="email" placeholder="Votre adresse email"><br>
    <label for="identifiant">Choisissez un identifiant</label><input type="identifiant" id="identifiant" name="identifiant" placeholder="Choisissez un identifiant"><br>
    <label for="password">Choisissez un mot de passe</label><input type="password" id="password" name="password" placeholder="Choisissez un mot de passe"><br>
    <label for="passwordConfirm">Confirmer le mot de passe</label><input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmer le mot de passe"><br>
    <input type="submit" name="submit" value="Recevoir la carte des chefs !"class="buttonSlider">
  </form>
</section>
  <?php include 'includes/footer.php';?>
</body>
</html>
