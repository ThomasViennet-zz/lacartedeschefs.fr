<?php
require 'base.php';

//Liste des moyennes des cooks ordonnée de la plus grande à la plus petite
$reponse = $bdd->query(
  'SELECT SUM(v.note) cook_note_total, AVG(v.note) cook_note_moyenne, c.identifiant cook_identifiant, c.profile_picture cook_picture, c.id cook_id
  FROM votes v
  INNER JOIN cooks c
  ON c.id = v.id_cook
  GROUP BY id_cook
  ORDER BY cook_note_total DESC');

  while ($resultat = $reponse->fetch())
  {
    echo '
    <div id="element">
      <a href="?action=cook&cook_id='.$resultat['cook_id'].'"><img src="/uploads/avatars/80x80_'.$resultat['cook_picture'].'" class="profilPicture" /></a>
      '.$resultat['cook_identifiant'].'
      '.$resultat['cook_note_moyenne'].'
      '.$resultat['cook_note_total'].'
    </div>
    ';
  }
?>
