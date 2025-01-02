<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "connexion.php";
require_once "site.php";

//Connexion::init_connexion();
$site = new Site();
$site->ajouterModule('connexion', 'modules/mod_connexion/module_connexion.php');

// Redirection vers le module de connexion par défaut
if (!isset($_GET['module'])) {
    $_GET['module'] = 'connexion';
}

$site->afficher();


