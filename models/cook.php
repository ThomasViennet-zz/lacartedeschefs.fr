<?php
function cookList()
{
  require 'base.php';
  //Liste des moyennes des cooks ordonnée de la plus grande à la plus petite
  $reponse = $bdd->query(
    'SELECT SUM(v.note) cook_note_total, AVG(v.note) cook_note_moyenne, c.identifiant cook_identifiant, c.profile_picture cook_picture, c.id cook_id
    FROM votes v
    INNER JOIN cooks c
    ON c.id = v.id_cook
    GROUP BY id_cook
    ORDER BY cook_note_total DESC');

    $position = 1;
    while ($resultat = $reponse->fetch())
    {
      $cook = new Cook($resultat['cook_id']);

      echo '
      <div class="element" style="width:30%;text-align:center;">
        <a href="?action=cook&cook_id='.$cook->id().'"><img src="/uploads/avatars/80x80_'.$cook->picture().'"  width="80px" height="80px" class="profilPicture" /></a><br>
        #'.$position.' '.$cook->identifiant().'<br>
        '.$cook->moyenne().'<br>
      </div>
      ';

      $position++;
    }
}

function cookRegister()
{
	if(!empty($_POST['identifiant']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['passwordConfirm']))
	{
		if($_POST['password'] == $_POST['passwordConfirm'])
		{
			require 'base.php';

			$req = $bdd->prepare('SELECT email, identifiant FROM cooks WHERE email = :email');
			$req->execute(array('email' => $_POST['email']));
			$resultat = $req->fetch();

			if(!empty($resultat['identifiant']) AND !empty($resultat['email']))
			{
				return 'Vous avez déjà un compte.';
			}else {

				$req = $bdd->prepare('SELECT identifiant FROM cooks WHERE identifiant = :identifiant');
				$req->execute(array('identifiant' => $_POST['identifiant']));
				$resultat = $req->fetch();

				if(!empty($resultat))
				{
					return 'Cet identifiant est déjà utilisé.';
				}else {
					$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

					$req = $bdd->prepare('INSERT INTO cooks (last_name, first_name, email, password, biography, profile_picture, identifiant, date, subscription) VALUES(:last_name, :first_name, :email, :password, :biography, :profile_picture, :identifiant, NOW(), :subscription)');
					$req->execute(array(
						'last_name' => '',
						'first_name' => '',
						'email' => $_POST['email'],
						'password' => $password_hash,
						'biography' => '',
						'profile_picture' => 'account.svg',
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

					header('Location: ../?action=account');
				}
			}
		}else {
			return 'Les mots de passe de correspondent pas.';
		}
	}else {
		return 'Veuilliez saisir toutes les informations obligatoires.';
	}
}

function cookUpdate()
{
  require 'base.php';

  $req = $bdd->prepare('SELECT password FROM cooks WHERE id = :id');
  $req->execute(array('id' => $_SESSION['id']));
  $resultat = $req->fetch();
  $req->closeCursor();

  $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

  if ($isPasswordCorrect) {

    //changer email
    if (!empty($_POST['email'])) {

      $req = $bdd->prepare('SELECT email FROM cooks WHERE email = :email');
      $req->execute(array('email' => $_POST['email']));
      $resultat = $req->fetch();

      if(empty($resultat['email']))
      {
        $req = $bdd->prepare('UPDATE cooks SET email = :email WHERE id = :id');
        $req->execute(array(
          'email' => $_POST['email'],
          'id' => $_SESSION['id']
        )) or die('Une erreur s\'est produite');

        return 'Adresse email sauvegardée.';
      }else {
        return 'Cette adresse email est déjà utilisée.';
      }
    }

    // Changer identifiant
    if (!empty($_POST['identifiant'])) {
      $req = $bdd->prepare('SELECT identifiant FROM cooks WHERE identifiant = :identifiant');
      $req->execute(array('identifiant' => $_POST['identifiant']));
      $resultat = $req->fetch();

      if(!empty($resultat))
      {
        return 'Cet identifiant est déjà utilisé.';
      }else {
        $req = $bdd->prepare('UPDATE cooks SET identifiant = :identifiant WHERE id = :id');
        $req->execute(array(
          'identifiant' => $_POST['identifiant'],
          'id' => $_SESSION['id']
        )) or die('Une erreur s\'est produite');
        return 'Identifiant sauvegardé';
      }
    }

    //Changer photo
    if (isset($_FILES['profile_picture']) AND $_FILES['profile_picture']['error'] == 0)
    {
      if ($_FILES['profile_picture']['size'] <= 5000000)
      {
        $infosfichier = pathinfo($_FILES['profile_picture']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'png');
        if (in_array($extension_upload, $extensions_autorisees))
        {
          $name_profile_picture = time().''.rand().'.jpeg';

          move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../uploads/avatars/'.$name_profile_picture);

          if($extension_upload == 'png')
            $image = imagecreatefrompng("../uploads/avatars/".$name_profile_picture."");
          else {
            $image = imagecreatefromjpeg("../uploads/avatars/".$name_profile_picture."");
          }

          $filename = '../uploads/avatars/80x80_'.$name_profile_picture;

          $thumb_width = 80;
          $thumb_height = 80;

          $width = imagesx($image);
          $height = imagesy($image);

          $original_aspect = $width / $height;
          $thumb_aspect = $thumb_width / $thumb_height;

          if ( $original_aspect >= $thumb_aspect )
          {
             // If image is wider than thumbnail (in aspect ratio sense)
             $new_height = $thumb_height;
             $new_width = $width / ($height / $thumb_height);
          }
          else
          {
             // If the thumbnail is wider than the image
             $new_width = $thumb_width;
             $new_height = $height / ($width / $thumb_width);
          }

          $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

          // Resize and crop
          imagecopyresampled($thumb,
                             $image,
                             0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                             0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                             0, 0,
                             $new_width, $new_height,
                             $width, $height);
          imagejpeg($thumb, $filename, 80);

          $req = $bdd->prepare('UPDATE cooks SET profile_picture = :profile_picture WHERE id = :id');
          $req->execute(array(
            'profile_picture' => $name_profile_picture,
            'id' => $_SESSION['id']
          )) or die('Une erreur s\'est produite<br>');

          return 'Photo modifié';
        }
      }
    }

  }else {
    return 'Mauvais mot de passe !';
  }

}
