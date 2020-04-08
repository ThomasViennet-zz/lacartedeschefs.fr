<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>La carte des chefs</title>
  <script language="javascript" type="text/javascript">
  function calculeLongueur(){

    //steps
    var iLongeur_steps, iLongeur_stepsRestante;
    iLongeur_steps = document.getElementById('steps').value.length;

    if (iLongeur_steps>1000) {
      document.getElementById('steps').value = document.getElementById('steps').value.substring(0,1000);
      iLongeur_stepsRestante = 0;
    }
    else {
      iLongeur_stepsRestante = 1000 - iLongeur_steps;
    }
    if (iLongeur_stepsRestante <= 1)
    document.getElementById('indicSteps').innerHTML = iLongeur_stepsRestante + "&nbsp;caract&egrave;re&nbsp;disponible";
    else
    document.getElementById('indicSteps').innerHTML = iLongeur_stepsRestante + "&nbsp;caract&egrave;res&nbsp;disponibles";

    //serve
    var iLongeur_serve, iLongeur_serveRestante;
    iLongeur_serve = document.getElementById('serve').value.length;

    if (iLongeur_serve>500) {
      document.getElementById('serve').value = document.getElementById('serve').value.substring(0,500);
      iLongeur_serveRestante = 0;
    }
    else {
      iLongeur_serveRestante = 500 - iLongeur_serve;
    }
    if (iLongeur_serveRestante <= 1)
    document.getElementById('indicServe').innerHTML = iLongeur_serveRestante + "&nbsp;caract&egrave;re&nbsp;disponible";
    else
    document.getElementById('indicServe').innerHTML = iLongeur_serveRestante + "&nbsp;caract&egrave;res&nbsp;disponibles";

    //ingrdients
    var iLongeur_ingredients, iLongeur_ingredientsRestante;
    iLongeur_ingredients = document.getElementById('ingredients').value.length;

    if (iLongeur_ingredients>500) {
      document.getElementById('ingredients').value = document.getElementById('ingredients').value.substring(0,500);
      iLongeur_ingredientsRestante = 0;
    }
    else {
      iLongeur_ingredientsRestante = 500 - iLongeur_ingredients;
    }
    if (iLongeur_ingredientsRestante <= 1)
    document.getElementById('indicIngredients').innerHTML = iLongeur_ingredientsRestante + "&nbsp;caract&egrave;re&nbsp;disponible";
    else
    document.getElementById('indicIngredients').innerHTML = iLongeur_ingredientsRestante + "&nbsp;caract&egrave;res&nbsp;disponibles";
  }
  </script>
</head>

<body id="Abonner">

  <?php include 'includes/nav.php';?>

  <header>
    <h1>Modifier votre recette</h1>
  </header>

  <section id="abonnement">
    <?php include 'includes/recipeEdit.php';?>
  </section>

  <?php include 'includes/footer.php';?>

</body>
</html>
