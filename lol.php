<?php
$to    = "viennet.t@gmail.com";
$from  = "La carte des chefs";
ini_set("SMTP", "smtp.lacartedeschefs.fr");

$JOUR  = date("Y-m-d");
$HEURE = date("H:i");

$Subject = "Modifier votre mot de passe";

$mail_Data = "";
$mail_Data .= "<html> \n";
$mail_Data .= "<head> \n";
$mail_Data .= "<title>Nous avons reçu une demande pour modifier votre mot de passe.</title> \n";
$mail_Data .= "</head> \n";
$mail_Data .= "<body> \n";
$mail_Data .= "<br> \n";
$mail_Data .= "<p>Bonjour <br> \n";
$mail_Data .= "<p>Cliquez sur le lien pour changer de mot de passe :<br> \n";
$mail_Data .= "http://lacartedeschefs.fr/?action=forgetPwd&update&cle=$cle&email=$to</p>\n";
$mail_Data .= "<p>Si vous n'avez pas fait de demande de changement de mot de passe, ne faites rien.</p>> \n";
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

if ($CR_Mail === FALSE) {
  return 'Demande enregistrée. <br>
  Vous allez recevoir un email à <strong>'.$_POST['email'].'</stong>';
}else {
  return 'Une erreur s\'est produite.';
}
