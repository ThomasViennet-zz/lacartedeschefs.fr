  <?php
  if(isset($_SESSION['id']))
  {
  include 'models/addRecipe.php';
  }else {
  ?>
  <div id="conteneur">
    <div class="element">
      <h3>Devenir chef</h3>
      <form method="post" action="?inscription#recette" enctype="multipart/form-data">
        <input type="email" name="email" placeholder="Votre adresse email *"><br>
        <input type="text" name="identifiant" placeholder="Choisissez un identifiant *"><br>
        <input type="password" name="password" placeholder="Votre mot de passe *"><br>
        <input type="password" name="passwordConfirm" placeholder="Confirmer le mot de passe *"><br>
        <input type="file" name="profile_picture" /><br>
        <input type="submit" name="submit" value="Valider" class="button">
      </form>
      <?php if(isset($_GET['inscription'])) include 'models/registerCook.php';?>
    </div>
    <div class="element">
      <h3>Se connecter</h3>
      <form method="post" action="?connexion#recette">
        <input type="email" name="email" placeholder="Email *"><br>
        <input type="password" name="password" placeholder="Mot de passe *"><br>
        <input type="submit" name="submit" value="Valider" class="button">
      </form>

      <?php if(isset($_GET['connexion'])) include 'models/connexion.php'; }?>
    </div>
  </div>
