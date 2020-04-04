<?php
$dbName = 'laCarte';
$dbLogin = 'root';
$dbPassword = 'root';
$host = 'localhost';

try {
  $bdd = new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', ''.$dbLogin.'', ''.$dbPassword.'');
} catch (Exception $e) {
  die('Erreur : '.$e->getMessage());
}
?>
