<table>
  <tr>
    <th>Identidiant</th>
    <th>Étoile</th>
    <th>Réputation</th>
  </tr>
<?php
try
{
  require 'secret.php';;
  $bdd = new PDO('mysql:host=localhost;dbname='. $dbName .';charset=utf8', '' . $dbLogin . '', '' . $dbPassword . '');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT id, identifiant FROM cooks');
// $reponse->closeCursor();

if(isset($_GET['chercher_chef']))
{
  if(!empty($_POST['identifiant']))
  {
    $req = $bdd->prepare('SELECT id, identifiant FROM cooks WHERE identifiant = :identifiant');
    $req->execute(array('identifiant' => $_POST['identifiant']));
    $resultat = $req->fetch();

    $reponse3 = $bdd->query(
      'SELECT AVG(v.note) vote_note
      FROM votes v
      INNER JOIN cooks c
      ON c.id = v.id_cook
      WHERE v.id_cook = '.$resultat['id'].'');
    $donnees3 = $reponse3->fetch();

  ?>
  <tr class="colorMain">
    <td><?php echo $resultat['identifiant']; ?></td>
    <td><?php echo $donnees3['vote_note']; ?></td>
    <td><?php echo $resultat['reputation']; ?></td>
  </tr>
    <?php
    }
}

while ($donnees = $reponse->fetch())
{
  $reponse2 = $bdd->query(
    'SELECT AVG(v.note) vote_note
    FROM votes v
    INNER JOIN cooks c
    ON c.id = v.id_cook
    WHERE v.id_cook = '.$donnees['id'].'');
  $donnees2 = $reponse2->fetch();

?>
<tr>
  <td><?php echo $donnees['identifiant']; ?></td>
  <td><?php echo $donnees2['vote_note']; ?></td>
  <td><?php echo $donnees['reputation']; ?></td>
</tr>
<?php
}
  $reponse2->closeCursor();
  $reponse->closeCursor();
?>
</table>
<center>
  <form method="post" action="?chercher_chef">
    <input type="text" name="identifiant" placeholder="Identifiant du chef" style="width: 300px;"/>
    <input type="submit" name="submit" value="Chercher" class="button">
  </form>
</center>
