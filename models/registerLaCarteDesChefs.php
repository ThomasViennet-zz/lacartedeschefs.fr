<?php
if(!empty($_POST['email']))
{
	require '../base.php';

	$req = $bdd->prepare('SELECT email FROM lacartedeschefs WHERE email = :email');
	$req->execute(array('email' => $_POST['email']));
	$resultat = $req->fetch();

	if(!empty($resultat))
	{
		$message = 'Cette adresse email est déjà abonnée !';
    header('Location: /?message='.$message.'#abonnement');
	}else {

		if($_POST['password'] == $_POST['passwordConfirm'])
		{
			$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$req = $bdd->prepare('INSERT INTO lacartedeschefs (email, password, date, subscribe) VALUES(:email, :password, NOW(), :subscribe)');
			$req->execute(array('email' => $_POST['email'], 'password' => $password_hash, 'subscribe' => 'Oui'))
			or die('<p class="colorWhite">Une erreur s\'est produite</p>');

			$message = 'Félicitations vous êtes abonnées !';
	    header('Location: /?message='.$message.'#abonnement');
		}else {
			$message = 'Les mots de passe ne correspondent pas.';
	    header('Location: /?message='.$message.'#abonnement');
		}
	}
}else {
		$message = 'Vous n\'avez pas saisi votre adresse email.';
    header('Location: /?message='.$message.'#abonnement');
}
?>
