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

    //bio
    var iLongeur_bio, iLongeur_bioRestante;
    iLongeur_bio = document.getElementById('bio').value.length;

    if (iLongeur_bio>200) {
      document.getElementById('bio').value = document.getElementById('bio').value.substring(0,200);
      iLongeur_bioRestante = 0;
    }
    else {
      iLongeur_bioRestante = 200 - iLongeur_bio;
    }
    if (iLongeur_bioRestante <= 1)
    document.getElementById('indicBio').innerHTML = iLongeur_bioRestante + "&nbsp;caract&egrave;re&nbsp;disponible";
    else
    document.getElementById('indicBio').innerHTML = iLongeur_bioRestante + "&nbsp;caract&egrave;res&nbsp;disponibles";
  }
  </script>
</head>

<body>
  <?php include 'includes/gtmBody.php';?>
  <?php include 'includes/navTop.php';?>
  <?php include 'includes/navFooter.php';?>

  <header>
      <h1>Modifier mon Compte</h1>
  </header>

  <section>
    <h2>Modifier mes informations</h2>

    <p class="colorMain"><?php echo $reponse;?></p>

    <form method="post" action="?action=cookUpdate" enctype="multipart/form-data">
      <label for="profile_picture">Photo</label><br>
      <img src="uploads/avatars/80x80_<?php echo $cook->picture();?>" width="80px" class="profilPicture"/>
      <input type="file" id="profile_picture" name="profile_picture" />
      <label for="url">Site</label><input type="text" id="url" name="url" placeholder="Votre site" value="<?php echo $cook->url();?>"><br>

      <label for="bio">Biographie</label>
      <div id="indicBio">200 caractères disponibles</div>

      <textarea onblur="calculeLongueur();" onfocus="calculeLongueur();" onkeydown="calculeLongueur();" onkeyup="calculeLongueur();" name="bio" id="bio" placeholder="Présentez-vous ..." rows="5"><?php echo $cook->bio();?></textarea><br>
      <label for="email">Email</label><input type="email" id="email" name="email" placeholder="Votre adresse email *" value="<?php echo $cook->email();?>"><br>
      <label for="identifiant">Identifiant</label><input type="text" id="identifiant" name="identifiant" placeholder="Votre identifiant  *" value="<?php echo $cook->identifiant();?>"><br>


    <h2>Sécurité</h2>

      <label for="password">Votre mot de passe</label><input type="password" id="password" name="password" placeholder="Saisissez votre mot de passe *"><br>
      <input type="submit" name="submit" value="Valider" class="button">
    </form>
  </section>

  <?php include 'includes/footer.php';?>
</body>
</html>
