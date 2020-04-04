<?php
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Suppression des cookies de connexion automatique
setcookie('login', '');
setcookie('pass_hache', '');

echo 'Vous êtes déconnecté';

header('Location: ../?action=cook');
exit();
?>
