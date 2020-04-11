<?php
function cookList()
{
  require 'base.php';

  $reponse = $bdd->query('SELECT COUNT(v.id) nbr_vote_total FROM votes v');
  $resultat = $reponse->fetch();

  //Liste des moyennes des cooks ordonnée de la plus grande à la plus petite
  $reponse = $bdd->query(
    'SELECT AVG(v.note) * COUNT(v.note) / '.$resultat['nbr_vote_total'].' cook_note_moyenne, c.identifiant cook_identifiant, c.profile_picture cook_picture, c.id cook_id
    FROM cooks c
    LEFT JOIN votes v
    ON c.id = v.id_cook
    GROUP BY cook_id
    ORDER BY cook_note_moyenne DESC');

    $position = 1;

    while ($resultat = $reponse->fetch())
    {
      $cook = new Cook($resultat['cook_id']);

      echo '
      <div class="element" style="width:150px;text-align:center;">
        <a href="?action=cook&cook_id='.$cook->id().'"><img src="/uploads/avatars/80x80_'.$cook->picture().'"  width="80px" height="80px" class="profilPicture" /></a><br>
        #'.$position.' '.$cook->identifiant().'<br>
        '.$cook->moyenne().'<br>
        '.$cook->total().'<br>
        '.$cook->nbrNote().'
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
          'id' => $_SESSION['id'])) or die('Une erreur s\'est produite');
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

          move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'uploads/avatars/'.$name_profile_picture);

          if($extension_upload == 'png')
            $image = imagecreatefrompng("uploads/avatars/".$name_profile_picture."");
          else {
            $image = imagecreatefromjpeg("uploads/avatars/".$name_profile_picture."");
          }

          $filename = 'uploads/avatars/80x80_'.$name_profile_picture;

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
        }else {
          return 'Format de photo non autorisé.';
        }
      }else {
        return 'La photo est trop lourde.';
      }
    }

  }else {
    return 'Mauvais mot de passe !';
  }
}

function forgetPwd($email)
{
  $cle = password_hash(time(), PASSWORD_DEFAULT);

  require ('base.php');

  $req = $bdd->prepare('INSERT INTO password (cle, email, date, done) VALUES(:cle, :email, NOW(), :done)');
  $req->execute(array(
    'cle' => $cle,
    'email' => $email,
    'done' => 0))
    or die('Une erreur s\'est produite');

  $to    = "viennet.t@gmail.com";
  $from  = "bonjour@lacartedeschefs.fr";
  ini_set("SMTP", "smtp.lacartedeschefs.fr");

  $JOUR  = date("Y-m-d");
  $HEURE = date("H:i");

  $Subject = "La carte des chefs - Modifier mot de passe";

  $mail_Data = "";
  $mail_Data .= "<html> \n";
  $mail_Data .= "<head> \n";
  $mail_Data .= "<title> La carte des chefs - Modifier mot de passe</title> \n";
  $mail_Data .= "</head> \n";
  $mail_Data .= "<body> \n";

  $mail_Data .= "<b>$Subject </b> <br> \n";
  $mail_Data .= "<br> \n";
  $mail_Data .= "Si vous n'avez pas fait de demande de changement de mot de passe, ne faites rien.<br> \n";
  $mail_Data .= "Cliquez sur le lien pour changer de mot de passe :<br> \n";
  $mail_Data .= "http://lacartedeschefs.fr/?action=forgetPwd&update&cle=$cle&email=$to<br>\n";
  $mail_Data .= "</body> \n";
  $mail_Data .= "</HTML> \n";

  $headers  = "MIME-Version: 1.0 \n";
  $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
  $headers .= "From: $from  \n";
  $headers .= "Disposition-Notification-To: $from  \n";
  $headers .= "X-Priority: 1  \n";
  $headers .= "X-MSMail-Priority: High \n";

  $CR_Mail = TRUE;
  $CR_Mail = @mail ($to, $Subject, $mail_Data, $headers);

  return 'Demande enregistrée. <br>
  Vous allez recevoir un email à <strong>'.$_POST['email'].'</stong>';
}

function pwdConfirm($email, $cle)
{
  require 'base.php';

  $req = $bdd->prepare('SELECT cle, done FROM password WHERE email = :email');
  $req->execute(array('email' => $email)) or die('Une erreur s\'est produite');
  $resultat = $req->fetch();

  if (isset($resultat['cle']) AND $resultat['cle'] == $cle) {
    if ($resultat['done'] == 0) {
      return 'Vous êtes autorisé à changer de mot de passe.';
    }else {
      return 'Ce lien a déjà été utilisé.';
    }
  }else {
    return 'Vous n\'êtes pas autorisé à changer de mot de passe.';
  }
}

function pwdUpdate($email, $pwd, $cle)
{
  if (!empty($_POST['password'])) {
    if ($_POST['passwordConfirm'] == $_POST['password']) {

      require 'base.php';
      $req = $bdd->prepare('SELECT cle, done FROM password WHERE email = :email');
      $req->execute(array('email' => $email)) or die('Une erreur s\'est produite');
      $resultat = $req->fetch();

      if (isset($resultat['cle']) AND $resultat['cle'] == $cle) {
        $password_hash = password_hash($pwd, PASSWORD_DEFAULT);

        $req = $bdd->prepare('UPDATE cooks SET password = :pwd WHERE email = :email');
        $req->execute(array('email' => $email, 'pwd' => $password_hash)) or die('Une erreur s\'est produite');

        $req = $bdd->prepare('DELETE FROM password WHERE email = :email');
        $req->execute(array('email' => $email)) or die('Une erreur s\'est produite');

        return 'Votre mot de passe a été mis à jour.';
      }else {
        return 'Vous n\'êtes pas autorisé à changer de mot de passe.';
      }
    }else {
      return 'Les mots de passe ne correspondent pas.';
    }
  }else {
    return 'Choisissez un mot de passe.';
  }
}
