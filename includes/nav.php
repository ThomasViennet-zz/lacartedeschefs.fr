<img src="images/Logo_la_carte_des_chefs_80x80.png" alt="Logo La carte des chefs" id="logo"/>
<nav>
  <ul>
    <a href="?action=accueil"><li><img src="images/home.svg" alt="Accueil"></li></a>
    <a href="?action=recipeAdd"><li><img src="images/add.svg"></li></a>
    <?php
    if (isset($_SESSION['id']) AND $_GET['action'] == 'account') {
      if ($_SESSION['id'] == $cook->id()) {
        echo '<a href="?action=accountEdit"><li><img src="images/accountEdit.svg" alt="Éditer mon compte"></li></a>';
      }
    }else {
    echo '
      <a href="?action=account"><li><img src="images/account.svg" alt="Mon compte"></li></a>';
    }
    ?>
  </ul>
</nav>
