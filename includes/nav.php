<img src="images/Logo_la_carte_des_chefs_80x80.png" alt="Logo La carte des chefs" id="logo"/>
<nav>
  <ul>
    <a href="?action=accueil"><li><?php include 'images/home.svg';?></li></a>
    <a href="?action=recipeAdd"><li><?php include 'images/add.svg'; ?></li></a>
    <?php
    if (isset($_SESSION['id']) AND $_GET['action'] == 'cook') {
      if ($_SESSION['id'] == $cook->id()) {
    ?>
        <a href="?action=cookEdit"><li><?php include 'images/accountEdit.svg'; ?></li></a>
    <?php
      }
    }else {
    ?>
      <a href="?action=cook"><li><?php include 'images/account.svg'; ?></li></a>
    <?php
    }
    ?>
  </ul>
</nav>
