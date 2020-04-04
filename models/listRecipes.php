<?php
require '../base.php';

$reponse = $bdd->query('SELECT id, title, recipe_picture, description, id_cook FROM recipes');

while ($donnees = $reponse->fetch())
{

  $starFull = '<img src="images/starFull.svg"/>';
  $star = '<img src="images/star.svg"/>';

  //Recipes
  // $reponse2 = $bdd->query(
  //   'SELECT AVG(note) recipe_moyenne
  //   FROM votes
  //   WHERE id_recipe = '.$donnees['id']);
  //   $resultat2 = $reponse2->fetch();
  //   $reponse2->closeCursor();
  //
  //   if(empty($resultat2['recipe_moyenne']))
  //   {
  //     $recipe_note = 'Pas encore de note';
  //   }else {
  //     if($resultat2['recipe_moyenne'] < 2)
  //     {
  //       $recipe_note = $starFull.''.$star.''.$star;
  //     }
  //
  //     if($resultat2['recipe_moyenne'] >= 2)
  //     {
  //       $recipe_note = $starFull.''.$starFull.''.$star;
  //     }
  //
  //     if($resultat2['recipe_moyenne'] >= 3)
  //     {
  //       $recipe_note = $starFull.''.$starFull.''.$starFull;
  //     }
  //   }

    //cooks
    $reponse3 = $bdd->prepare(
      'SELECT c.identifiant cook_identifiant, c.profile_picture cook_picture,
      AVG(v.note) note_moyenne
      FROM votes v
      INNER JOIN cooks c
      ON v.id_cook = c.id
      WHERE c.id = :id');
      $reponse3->execute(array('id' => $donnees['id_cook']));
      $resultat3 = $reponse3->fetch();
      $reponse3->closeCursor();

      if(empty($resultat3['note_moyenne']))
      {
        $cook_note = 'Pas encore de note';
      }else {
        if($resultat3['note_moyenne'] < 2)
        {
          $cook_note = $starFull.''.$star.''.$star;
        }

        if($resultat3['note_moyenne'] >= 2)
        {
          $cook_note = $starFull.''.$starFull.''.$star;
        }

        if($resultat3['note_moyenne'] >= 3)
        {
          $cook_note = $starFull.''.$starFull.''.$starFull;
        }
      }

      echo '
      <div class="element">
        <div class="publicationCook">
          <img src="uploads/avatars/300x300_'.$resultat3['cook_picture'].'" width="80px" class="profilPicture"/>
          <div class="publicationNoteCook">'.$cook_note.'</div>
          <div class="publicationIdentifiant">'.$resultat3['cook_identifiant'].'</div>
        </div>
        <a href="?action=recipe&id='.$donnees['id'].'"><img src="uploads/recipes/300x300_'.$donnees['recipe_picture'].'"/></a><br>
        '.$donnees['title'].'<br>
        '.$donnees['description'].'
      </div>
      '

      ;
    }

    $reponse->closeCursor();
?>
