<?php
function connexion()
{
	// // Ma clé privée
  // $secret = "6Ld31ukUAAAAAK2FNOGCcp0XHg4bPnpDV5jqdZAI";
  // // Paramètre renvoyé par le recaptcha
  // $response = $_POST['g-recaptcha-response'];
  // // On récupère l'IP de l'utilisateur
  // $remoteip = $_SERVER['REMOTE_ADDR'];
  //
  // $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
  //     . $secret
  //     . "&response=" . $response
  //     . "&remoteip=" . $remoteip ;
  //
  // $decode = json_decode(file_get_contents($api_url), true);
  //
  // if ($decode['success'] == true) {
		if(isset($_POST['email']) && isset($_POST['password']))
		{
			require 'base.php';

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
				return 'Mauvais email ou mot de passe !';

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

					header('Location: ../?action=account');

				}else {
					return 'Mauvais email ou mot de passe !';
				}
			}
		}else {
			return 'Veuilliez saisir toutes les informations !';
		}
	// }else {
	// 	return 'Veuillez cocher la case "I\'m not a bot"';
	// }
}
