<?php
if(isset($_SESSION['id']))
{
  echo '
  <p class="colorMain">'.$_GET['message'].'</p>
  <form method="post" action="models/addVote.php?id_recipe='.$recipe->id().'&id_cook='.$recipe->idCook().'">
    <input type="text" value="'.$_SESSION['identifiant'].'" disabled/> <a href="models/deconnexion.php"><br>
    Ce n\'est pas vous ?</a><br>
    <input type="radio" name="vote" value="1">1 étoile
    <input type="radio" name="vote" value="2">2 étoiles<br>
    <input type="radio" name="vote" value="3">3 étoiles<br>
    <input type="submit" name="submit" value="Envoyer" class="button">
  </form>
  ';
}else {
  echo '<a href="/#abonnement">Abonnez-vous à <i>La carte des chefs</i> pour voter.</a>';
}
