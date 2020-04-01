<?php
if(isset($_GET['valider_abonnement']))
{
	if(!empty($_POST['email']))
	{
		try
		{
			require 'secret.php';;
      $bdd = new PDO('mysql:host=localhost;dbname='. $dbName .';charset=utf8', '' . $dbLogin . '', '' . $dbPassword . '');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}

		$req = $bdd->prepare('SELECT email FROM lacartedeschefs WHERE email = :email');
		$req->execute(array('email' => $_POST['email']));
		$resultat = $req->fetch();

		if(!empty($resultat))
		{
			echo '<p class="colorMain">Cette adresse email est déjà abonnée !<p>';
		}else {

      $req = $bdd->prepare('INSERT INTO lacartedeschefs (email, date, subscribe) VALUES(:email, NOW(), :subscribe)');
			$req->execute(array('email' => $_POST['email'], 'subscribe' => 'Oui'))
			or die('<p class="colorWhite">Une erreur s\'est produite</p>');

			echo '<p class="colorMain">Félicitations vous êtes abonnées !<p>';
		}
	}else {
		echo '<p class="colorMain">Vous n\'avez pas saisi votre adresse email.</p>';
	}
}
?>
