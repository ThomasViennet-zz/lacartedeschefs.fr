<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/Logo_la_carte_des_chefs_30px.png">
  <title>La carte des chefs</title>
</head>

<body id="Abonner">
  <?php include 'includes/header.php';?>
  <div id="slider">
    <img src="images/plateaux_de_legumes_1920px.jpg" alt="Plateaux de légumes"/>
    <div id="description_slider">
      <h1>La carte des chefs</h1>
      <p class="colorWhite">Nous révélons les talents des passionnés de la gastronomie.</p>
      <form method="post" action="landingPage.php?valider_abonnement">
        <input type="email" name="email" placeholder="Votre adresse email" style="width: 300px;"/><br>
        <input type="submit" name="submit" value="Recevoir la carte des chefs !" class="button">
      </form>
      <?php include 'models/registerLaCarteDesChefs.php';?>
    </div>
  </div>

  <section>
    <h2>Qu'est-ce que c'est ?</h2>

    <p>
      C'est un email listant 10 recettes...<br>
      Oui, mais pas n'importe quelles recettes !
    </p>

    <p>
      Le monde regorge d'une diversité de talents à découvrir.<br>
      La carte des chefs, c'est une invitation à ceux qui le souhaitent d'être révélé.
    </p>

    <p>
      Tous les mois, une thématique culinaire est proposée.<br>
      Ceux qui le souhaitent proposent leur recette.
    </p>

    <p>
      Pour sélectionner les recettes qui seront proposées dans "La carte des chefs" de la thématique,<br>
      nous organisons un vote sur <a href="https://www.instagram.com/la_carte_des_chefs/" target="_blank" alt="Profil instagram la carte des chefshttps://www.instagram.com/la_carte_des_chefs/">notre profil Instagram</a> où tout le monde peut voter.
    </p>

    <p>
      Les 10 recettes ayant reçu le plus de votes sont retenues pour "La carte des chefs",<br>
      que nous envoyons par email aux abonnés.
    </p>

    <p>
      Cerise sur le gâteau, ceux qui cuisinent les recettes des chefs ont la possibilité de donner des étoiles aux plats.<br>
      Ces étoiles permettent de donner de la réputation aux chefs et ainsi de le révéler.
    </p>

    <p>
      <a href="#reputation">En savoir plus sur la répution.</a>
    </p>
  </section>

  <section id="chef">
    <h2>Les chefs</h2>

    <?php include 'models/listeCooks.php'; ?>

    <h3 id="reputation">Comment fonctionne la réputation ?</h3>
    <p>
      Les personnes qui reçoivent "La carte des chefs" par email et qui cuisinent les recettes,<br>
      peuvent attribuer entre une et trois étoiles aux recettes.<br>
      <br>
      Les points de réputation d'un chef sont calculés grâce au nombre d'étoiles que ses recettes reçoivent:<br>
      <br>
      - 3 étoiles donne 3 points de réputation<br>
      - 2 étoiles donne 2 points de réputation<br>
      - 1 étoile donne 1 points de réputation<br>
      <br>
      <i>Scénario : "Vous avez proposé une recette et elle a reçu 3 votes "1 étoile" et 2 votes "2 étoiles".<br>
        Les 3 votes à "1 étoile" vous apporteront 15 points et les 2 votes à "2 étoiles" 20 points.</i>
    </p>

    <h3>Comment participer ?</h3>
    <ol>
      <li>Une thématique est proposée aux chefs sur <a href="https://www.instagram.com/la_carte_des_chefs/" target="_blank" alt="Profil instagram la carte des chefshttps://www.instagram.com/la_carte_des_chefs/">notre profil Instagram</a></li>
      <li>Les chefs qui le souhaitent nous <a href="#recette">proposent de délicieuses recettes</a></li>
      <li>Nous partageons leurs recettes sur notre profil instagram pour que tout le monde puisse voter</li>
      <li>Les 10 recettes qui reçoivent le plus de vote sont sélectionnées pour "La carte des chefs" de la thématique</li>
    </ol>
    </section>
    <section>
      <h2 id="recette">Proposer une recette</h2>
      <p>Marquez l'histoire de la gastronomie avec vos délicieuses recettes !</p>
      <?php include 'includes/addRecipe.php';?>
    </section>

    <?php include 'includes/footer.php';?>
  </body>
</html>
