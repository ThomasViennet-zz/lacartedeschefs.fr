<?php
function cookList()
{
  require 'base.php';
  //Liste des moyennes des cooks ordonnée de la plus grande à la plus petite
  $reponse = $bdd->query(
    'SELECT SUM(v.note) cook_note_total, AVG(v.note) cook_note_moyenne, c.identifiant cook_identifiant, c.profile_picture cook_picture, c.id cook_id
    FROM votes v
    INNER JOIN cooks c
    ON c.id = v.id_cook
    GROUP BY id_cook
    ORDER BY cook_note_total DESC');

    $position = 1;
    while ($resultat = $reponse->fetch())
    {
      $cook = new Cook($resultat['cook_id']);

      echo '
      <div class="element" style="width:30%;text-align:center;">
        <a href="?action=cook&cook_id='.$cook->id().'"><img src="/uploads/avatars/80x80_'.$cook->picture().'"  width="80px" height="80px" class="profilPicture" /></a><br>
        #'.$position.' '.$cook->identifiant().'<br>
        '.$cook->moyenne().'<br>
      </div>
      ';

      $position++;
    }
}
