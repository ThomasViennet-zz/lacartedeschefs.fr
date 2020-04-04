<table>
  <tr>
    <th>Identidiant</th>
    <th>Étoile</th>
    <th>Réputation</th>
  </tr>
<?php
require '../base.php';

$reponse = $bdd->query('SELECT id, identifiant FROM cooks');

if(isset($_GET['chercher_chef']))
{
  if(!empty($_POST['identifiant']))
  {
    $reponse2 = $bdd->prepare('SELECT id, identifiant FROM cooks WHERE identifiant = :identifiant');
    $reponse2->execute(array('identifiant' => $_POST['identifiant']));
    $resultat2 = $reponse2->fetch();

    if (!$resultat2)
  	{
  		echo '<p class="colorMain">Cet identifiant n\'existe pas !</p>';
  	}else{
      $reponse3 = $bdd->query(
        'SELECT AVG(v.note) note_moyenne, SUM(v.note) note_total
        FROM votes v
        INNER JOIN cooks c
        ON c.id = v.id_cook
        WHERE v.id_cook = '.$resultat2['id'].'');
      $resultat3 = $reponse3->fetch();

    ?>
    <tr class="colorMain">
      <td><?php echo $resultat2['identifiant']; ?></td>
      <td><?php echo $resultat3['note_moyenne']; ?></td>
      <td><?php echo $resultat3['note_total']; ?></td>
    </tr>
    <?php
    }
  }
}


while ($resultat = $reponse->fetch())
{
  $reponse4 = $bdd->query(
    'SELECT AVG(v.note) note_moyenne, SUM(v.note) note_total
    FROM votes v
    INNER JOIN cooks c
    ON c.id = v.id_cook
    WHERE v.id_cook = '.$resultat['id'].'');
  $resultat4 = $reponse4->fetch();

?>
<tr>
  <td><?php echo $resultat['identifiant']; ?></td>
  <td><?php echo $resultat4['note_moyenne']; ?></td>
  <td><?php echo $resultat4['note_total']; ?></td>
</tr>
<?php
}
?>
</table>
<center>
  <form method="post" action="?chercher_chef">
    <input type="text" name="identifiant" placeholder="Identifiant du chef" style="width: 300px;"/>
    <input type="submit" name="submit" value="Chercher" class="button">
  </form>
</center>
