<?php
$dsn = 'mysql:dbname=dutinfopw201612;host=database-etudiants.iut.univ-paris8.fr';
$user = 'dutinfopw201612';
$password = 'rupapare';
$bdd = new PDO($dsn, $user, $password);
$result = mysql_query('SELECT * WHERE 1=1');
if (!$resultat) {
	die('Requête invalide : ' . mysql_error());
}
?>
