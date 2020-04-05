<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/Logo_la_carte_des_chefs_30px.png">
  <title>La carte des chefs</title>
  <script language="javascript" type="text/javascript">
  function calculeLongueur(){
    var iLongueur, iLongueurRestante;
    iLongueur = document.getElementById('steps').value.length;
    if (iLongueur>1000) {
      document.getElementById('steps').value = document.getElementById('steps').value.substring(0,1000);
      iLongueurRestante = 0;
    }
    else {
      iLongueurRestante = 1000 - iLongueur;
    }
    if (iLongueurRestante <= 1)
    document.getElementById('indic').innerHTML = iLongueurRestante + "&nbsp;caract&egrave;re&nbsp;disponible";
    else
    document.getElementById('indic').innerHTML = iLongueurRestante + "&nbsp;caract&egrave;res&nbsp;disponibles";
  }
</script>
</head>

<body id="Abonner">

  <?php include 'includes/nav.php';?>

  <header>
    <h1>Ajouter une recette</h1>
  </header>

  <section id="abonnement">
    <?php include 'includes/addRecipe.php';?>
  </section>

  <?php include 'includes/footer.php';?>

</body>
</html>
