<?php
if(!empty($_POST['identifiant']) AND !empty($_POST['email']) AND !empty($_POST['password']))
{
	if($_POST['password'] == $_POST['passwordConfirm'])
	{
		require '../base.php';

		$req = $bdd->prepare('SELECT email, identifiant FROM cooks WHERE email = :email');
		$req->execute(array('email' => $_POST['email']));
		$resultat = $req->fetch();

		if(!empty($resultat['identifiant']) AND !empty($resultat['email']))
		{
			echo 'Vous avez déjà un compte.<br>
			Si vous n\'êtes pas redirigé, <a href="../?action=cook"">cliquez ici</a>.';
			header( "refresh:3;url=../?action=cook" );
		}else {

			$req = $bdd->prepare('SELECT identifiant FROM cooks WHERE identifiant = :identifiant');
			$req->execute(array('identifiant' => $_POST['identifiant']));
			$resultat = $req->fetch();

			if(!empty($resultat))
			{
				echo 'Cet identifiant est déjà utilisé.<br>
				Si vous n\'êtes pas redirigé, <a href="../?action=cook"">cliquez ici</a>.';
				header( "refresh:3;url=../?action=cook" );
			}else {
				$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$req = $bdd->prepare('INSERT INTO cooks (last_name, first_name, email, password, biography, profile_picture, identifiant, date, subscription) VALUES(:last_name, :first_name, :email, :password, :biography, :profile_picture, :identifiant, NOW(), :subscription)');
				$req->execute(array(
					'last_name' => '',
					'first_name' => '',
					'email' => $_POST['email'],
					'password' => $password_hash,
					'biography' => '',
					'profile_picture' => '',
					'identifiant' => $_POST['identifiant'],
					'subscription' => ''
				)) or die('Une erreur s\'est produite');

				$req = $bdd->prepare('SELECT id FROM cooks WHERE email = :email');
				$req->execute(array('email' => $_POST['email']));
				$resultat = $req->fetch();

				session_start();
				$_SESSION['id'] = $resultat['id'];
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['identifiant'] = $_POST['identifiant'];

				echo 'Vous êtes inscrit !';
				header('Location: ../?action=cook');
			}
		}
	}
}else {
	echo '
	Veuilliez saisir toutes les informations obligatoires.<br>
	Si vous n\'êtes pas redirigé, <a href="../?action=cook"">cliquez ici</a>.';
	header( "refresh:3;url=../?action=cook" );
}
?>
