<?php
if(isset($_SESSION['id']))
{
  echo '
    <div class="hiddenradio">

    <label>
      <input type="radio" name="vote" id="vote" name="vote" value="3">
      <img src="images/starFull.svg">
      <img src="images/starFull.svg">
      <img src="images/starFull.svg">
    </label>
    <br>
    
    <label>
      <input type="radio" name="vote" id="vote" name="vote" value="2">
      <img src="images/starFull.svg">
      <img src="images/starFull.svg">
    </label>
    <br>

    <label>
      <input type="radio" id="vote" name="vote" value="1">
      <img src="images/starFull.svg">
    </label>
    <br>

    </div>
    <input type="submit" name="submit" value="Envoyer" class="button">
  </form>
  ';
}else {
  echo '<a href="/#abonnement">Abonnez-vous à <i>La carte des chefs</i> pour voter.</a>';
}

?>
