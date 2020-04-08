<nav>
  <ul>
    <a href="?action=accueil"><li><img src="images/home.svg" alt="Accueil" class="navItem"></li></a>
    <a href="?action=recipeAdd"><li><img src="images/add.svg" alt="Ajouter une recette" class="navItem"></li></a>
    <?php
    if (isset($_SESSION['id']) AND $_GET['action'] == 'account') {
      if ($_SESSION['id'] == $cook->id()) {
        echo '<a href="?action=accountEdit"><li><img src="images/accountEdit.svg" alt="Éditer mon compte" class="navItem"></li></a>';
      }
    }else {
      echo '<a href="?action=account"><li><img src="images/account.svg" alt="Mon compte" class="navItem"></li></a>';
    }
    ?>
  </ul>
</nav>
