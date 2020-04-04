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
			echo '<p class="colorMain">Vous avez déjà un compte.<p>';
		}else {

			$req = $bdd->prepare('SELECT identifiant FROM cooks WHERE identifiant = :identifiant');
			$req->execute(array('identifiant' => $_POST['identifiant']));
			$resultat = $req->fetch();

			if(!empty($resultat))
			{
				echo '<p class="colorMain">Cet identifiant est déjà utilisé.<p>';
			}else {
				if (isset($_FILES['profile_picture']) AND $_FILES['profile_picture']['error'] == 0)
				{
					if ($_FILES['profile_picture']['size'] <= 5000000)
					{
						$infosfichier = pathinfo($_FILES['profile_picture']['name']);
						$extension_upload = $infosfichier['extension'];
						$extensions_autorisees = array('jpg', 'jpeg', 'png');
						if (in_array($extension_upload, $extensions_autorisees))
						{
							$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
							$name_profile_picture = time().''.$_SESSION['id'].'.jpeg';

							$req = $bdd->prepare('INSERT INTO cooks (last_name, first_name, email, password, biography, profile_picture, identifiant, date) VALUES(:last_name, :first_name, :email, :password, :biography, :profile_picture, :identifiant, NOW())');
							$req->execute(array(
								'last_name' => '',
								'first_name' => '',
								'email' => $_POST['email'],
								'password' => $password_hash,
								'biography' => '',
								'profile_picture' => $name_profile_picture,
								'identifiant' => $_POST['identifiant']
							)) or die('Une erreur s\'est produite');

							$req = $bdd->prepare('SELECT id FROM cooks WHERE email = :email');
							$req->execute(array('email' => $_POST['email']));
							$resultat = $req->fetch();

							session_start();
							$_SESSION['id'] = $resultat['id'];
							$_SESSION['email'] = $_POST['email'];
							$_SESSION['identifiant'] = $_POST['identifiant'];

							echo 'Vous êtes inscrit !';

							move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../uploads/avatars/'.$name_profile_picture);

							if($extension_upload == 'png')
							$source = imagecreatefrompng("../uploads/avatars/".$name_profile_picture."");
							else {
								$source = imagecreatefromjpeg("../uploads/avatars/".$name_profile_picture."");
							}
							$destination = imagecreatetruecolor(300, 300);

							$largeur_source = imagesx($source);
							$hauteur_source = imagesy($source);
							$largeur_destination = imagesx($destination);
							$hauteur_destination = imagesy($destination);

							imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

							imagejpeg($destination, "../uploads/avatars/300x300_".$name_profile_picture."");

							header('Location: ../?action=cook');
						}else {
							echo '<p class="colorMain">Format de photo non autorisé.</p>';
						}
					}else {
						echo '<p class="colorMain">La photo est trop lourde.</p>';
					}
				}else {
					echo '<p class="colorMain">Ajoutez une photo.</p>';
				}
			}
		}
	}
}else {
	echo '<p class="colorMain">Veuilliez saisir toutes les informations obligatoires.</p>';
}
?>
