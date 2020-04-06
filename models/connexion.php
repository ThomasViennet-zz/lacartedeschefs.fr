<?php
if(isset($_POST['email']) && isset($_POST['password']))
{
	require '../base.php';

	$req = $bdd->prepare('SELECT id, password, email, identifiant FROM cooks WHERE email = :email');
	$req->execute(array('email' => $_POST['email']));
	$resultat = $req->fetch();
	$req->closeCursor();

	$id = $resultat['id'];
	$email = $resultat['email'];
	$identifiant = $resultat['identifiant'];

	$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

	if (!$resultat)
	{
		echo '
		Mauvais email ou mot de passe ! <br>
		Si vous n\'êtes pas redirigé, <a href="../?action=cook"">cliquez ici</a>.';
		header( "refresh:3;url=../?action=cook" );
	}else{
		if ($isPasswordCorrect)
		{
			$req = $bdd->prepare('SELECT AVG(note) AS note_moyenne FROM votes WHERE id_cook = :id_cook');
			$req->execute(array('id_cook' => $id));
			$resultat = $req->fetch();
			$req->closeCursor();

			session_start();
			$_SESSION['id'] = $id;
			$_SESSION['email'] = $email;
			$_SESSION['identifiant'] = $identifiant;
			$_SESSION['moyenne'] = $resultat['note_moyenne'];;

			header('Location: ../?action=cook');

		}else {
				echo '
				Mauvais email ou mot de passe ! <br>
				Si vous n\'êtes pas redirigé, <a href="../?action=cook"">cliquez ici</a>.';
				header( "refresh:3;url=../?action=cook" );
		}
	}
}else {
	echo '
	Veuilliez saisir toutes les informations ! <br>
	Si vous n\'êtes pas redirigé, <a href="../?action=cook"">cliquez ici</a>.';
	header( "refresh:3;url=../?action=cook" );
}
?>
