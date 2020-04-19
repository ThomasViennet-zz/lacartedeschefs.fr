<!DOCTYPE html>
<html>
<head>
  <?php include 'includes/gtmHead.php';?>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/30x30_logo_la_carte_des_chefs.png">
  <title>Mon compte</title>
  <script language="javascript" type="text/javascript">
  function calculeLongueur(){

    //ingrdients
    var iLongeur_candidature, iLongeur_candidatureRestante;
    iLongeur_candidature = document.getElementById('candidature').value.length;

    if (iLongeur_candidature>1000) {
      document.getElementById('candidature').value = document.getElementById('candidature').value.substring(0,1000);
      iLongeur_candidatureRestante = 0;
    }
    else {
      iLongeur_candidatureRestante = 1000 - iLongeur_candidature;
    }
    if (iLongeur_candidatureRestante <= 1)
    document.getElementById('indicCandidature').innerHTML = iLongeur_candidatureRestante + "&nbsp;caract&egrave;re&nbsp;disponible";
    else
    document.getElementById('indicCandidature').innerHTML = iLongeur_candidatureRestante + "&nbsp;caract&egrave;res&nbsp;disponibles";
  }
  </script>
</head>

<body>
  <?php include 'includes/gtmBody.php';?>
  <?php include 'includes/navTop.php';?>
  <?php include 'includes/navFooter.php';?>

  <div id="headerCook">
    <p><a href="?action=accountEdit">Modifier</a></p>
    <p><a href="models/deconnexion.php">Ce n'est pas vous ?</a></p>
    <div id="cookPicture">
      <?php echo '<img src="uploads/avatars/80x80_'.$cook->picture().'" width="80px" height="80px" class="profilPicture"/>';?>
    </div>
      <?php echo $cook->etoile();?>
      <h1 style="color:black;"><?php echo $cook->identifiant();?></h1>
      <?php echo $cook->nbrFollower();?><br>

      <p><?php echo $cook->bio();?></p>
      <a href="https://www.<?php echo $cook->url();?>" target="_blank" rel="ugc"><?php echo $cook->url();?></a><br>
  </div>

  <?php
  if ($cook->auth() == 1) {
    ?>
    <h2 style="text-align:center;">Vos recettes</h2>
    <p style="text-align:center;"><a href="?action=recipeAdd">Ajouter une recette</a></p>

      <section class="conteneur">
          <?php echo $cook->getRecipes($_SESSION['id']);?>
      </section>
  <?php
  }else {
    echo '
    <h2 style="text-align:center;">Candidater</h2>
    <p style="text-align:center;"><i><u>Suscitez notre appétit</u></i></p>

    <p class="colorMain" style="text-align:center;">'.$reponse.'</p>
    <section>
    <form method="post" action="?action=candidature&sent">
      <label for="instagram">Instagram</label><input type="instagram" id="instagram" name="instagram" placeholder="Votre profil instagram. Exemple @la_carte_des_chefs"><br>
      <label for="blog">Blog</label><input type="blog" id="blog" name="blog" placeholder="L\'adresse de votre blog"><br>
      <label for="candidature">Motivations</label>
      <div id="indicCandidature">1 000 caractères disponibles</div>

      <textarea onblur="calculeLongueur();" onfocus="calculeLongueur();" onkeydown="calculeLongueur();" onkeyup="calculeLongueur();" name="candidature" id="candidature" placeholder="Partagez-nous de quoi susciter notre appétit..." rows="5"></textarea><br>

      <input type="submit" name="submit" value="Envoyer" class="button">
    </form>
    </section>';
  }
  ?>


  <?php include 'includes/footer.php';?>

</body>
</html>
