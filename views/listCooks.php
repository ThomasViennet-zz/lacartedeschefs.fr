<section id="chef">
  <h2>Les chefs</h2>

  <?php include 'models/listCooks.php'; ?>

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
  </section>
