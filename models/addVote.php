<?php
function addVoteWeighted($id_recipe)
{
  /*étoile
  *** = Top 5%
  ** = Top 6% - 20%
  * = Top 21% - 50%

  valeur note
  Top 5% = count(vote total) * 0,095 * note
  Top 6% - 20% = count(vote total) * 0,08 * note
  Top 21% - 50% = count(vote total) * 0,05 * note
  */

  if(!empty($_POST['vote']) AND $_POST['vote'] <= 3) {//S'il essaie d'augmenter sa note bloquée à 3

    require 'base.php';

    //Est-ce que l'utilisateur a déjà voté pour cette recette ?
    $req = $bdd->prepare('SELECT COUNT(id) id_vote FROM votes WHERE id_recipe = :id_recipe AND id_customer = :id_customer');
    $req->execute(array('id_recipe' => $id_recipe, 'id_customer' => $_SESSION['id']));
    $vote = $req->fetch();

    if (empty($vote['id_vote'])) {

      //Est-ce qu'il vote pour lui même ?
      $recipe = new Recipe($id_recipe);

      if ($_SESSION['id'] != $recipe->idCook()) {

        $etoileCook = 0;
        $etoileSession = 0;

        //Combien de customers ont déjà voté
        $req = $bdd->query('SELECT COUNT(DISTINCT id_customer) nbr_customer FROM votes');
        $vote = $req->fetch();

        $cookSession = new Cook($_SESSION['id']);
        $cook = new Cook($recipe->idCook());

        //S'il est moins étoilé que le cook
        if ($cookSession->nbrEtoile() > $cook->nbrEtoile() OR $cookSession->nbrEtoile() == 0) {

          // if($vote['nbr_customer'] >= 10000) {//nbr_customer avant de pondérer
          //   /*
          //   Vérifier pondération
          //   */
          //   $coef = $cookSession->coef()*$vote['nbr_customer'];
          //   $note = $coef*$_POST['vote'];
          //
          //   //J'enregistre la note en base
          //   $req = $bdd->prepare('INSERT INTO votes (id_recipe, id_cook, id_customer, note, date, coef) VALUES(:id_recipe, :id_cook, :id_customer, :note, NOW(), :coef)');
          //   $req->execute(array(
          //     'id_recipe' => $id_recipe,
          //     'id_cook' => $recipe->idCook(),
          //     'id_customer' => $_SESSION['id'],
          //     'note' => $note,
          //     'coef' => $coef)) or die('Une erreur s\'est produite');
          //
          //   $cook = new Cook($recipe->idCook());//màj de la note
          //
          //   $req = $bdd->prepare('UPDATE cooks SET points = :points WHERE id = :id');
          //   $req->execute(array(
          //     'points' => $cook->total(),
          //     'id' => $cook->id())) or die('Une erreur s\'est produite');
          //
          //   return 'La vote a bien été ajouté !';
          // }else { //Sinon il n'y a pas encore suffisamment de participants de vote.

            $req = $bdd->prepare('INSERT INTO votes (id_recipe, id_cook, id_customer, note, date, coef) VALUES(:id_recipe, :id_cook, :id_customer, :note, NOW(), :coef)');
            $req->execute(array(
              'id_recipe' => $recipe->id(),
              'id_cook' => $recipe->idCook(),
              'id_customer' => $_SESSION['id'],
              'note' => $_POST['vote'],
              'coef' => $cookSession->nbrEtoile())) or die('Une erreur s\'est produite 1');

            //Bonus des étoiles boucler l'ajout de note en fonction du nbr d'étoie du chef
            for ($i=0; $i < $cookSession->nbrEtoile(); $i++) {
              $req = $bdd->prepare('INSERT INTO votes (id_recipe, id_cook, id_customer, note, date, coef) VALUES(:id_recipe, :id_cook, :id_customer, :note, NOW(), :coef)');
              $req->execute(array(
                'id_recipe' => $recipe->id(),
                'id_cook' => $recipe->idCook(),
                'id_customer' => $_SESSION['id'],
                'note' => $_POST['vote'],
                'coef' => $cookSession->nbrEtoile())) or die('Une erreur s\'est produite 2 ');
            }
            $cook = new Cook($recipe->idCook());

            $req = $bdd->prepare('UPDATE cooks SET points = :points WHERE id = :id');
            $req->execute(array(
              'points' => $cook->total(),
              'id' => $recipe->idCook())) or die('Une erreur s\'est produite 3');

            return 'La vote a bien été ajouté !';
          // }
        }else {
          return 'Vous pouvez noter uniquement des chefs moins étoilés que vous.';
        }
      }else {
        return 'Vous ne pouvez pas noter votre recette.';
      }
    }else {
      return 'Vous avez déjà voté !';
    }
  }else {
    return 'Choississez une note.';
  }
}
