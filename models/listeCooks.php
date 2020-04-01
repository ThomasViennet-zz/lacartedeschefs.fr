<table>
  <tr>
    <th>Identidiant</th>
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

$reponse = $bdd->query('SELECT * FROM cooks');

if(isset($_GET['chercher_chef']))
{
  if(!empty($_POST['identifiant']))
  {
    $req = $bdd->prepare('SELECT identifiant FROM cooks WHERE identifiant = :identifiant');
    $req->execute(array('identifiant' => $_POST['identifiant']));
    $resultat = $req->fetch();
    ?>
    <tr>
      <td class="colorMain"><?php echo $resultat['identifiant']; ?></td>
      <td class="colorMain">1221</td>
    </tr>
    <?php
    }
}

while ($donnees = $reponse->fetch())
{
?>
<tr>
  <td><?php echo $donnees['identifiant']; ?></td>
  <td><?php echo $donnees['reputation']; ?></td>
</tr>
<?php
}
  $reponse->closeCursor();
?>
</table>
<center>
  <form method="post" action="?chercher_chef">
    <input type="text" name="identifiant" placeholder="Identifiant du chef" style="width: 300px;"/>
    <input type="submit" name="submit" value="Chercher" class="button">
  </form>
</center>
