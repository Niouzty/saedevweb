<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "connexion.php";
require_once "site.php";
  require_once __DIR__ . '/core/module_generique.php';
    require_once __DIR__ . '/core/modele_generique.php';
    require_once __DIR__ . '/core/vue_generique.php';
    require_once __DIR__ . '/templates/template.php';

//Connexion::init_connexion();



if (isset($_GET['module'])) {
            $module = $_GET['module'];
            require_once 'modules/mod_'.$module.'/module_'.$module.'.php';
            $classeModule = "Module" . ucfirst($module); // Exemple : "ModuleConnexion"
            
            if (class_exists($classeModule)) {
                new $classeModule(); // Instancie et exécute le module
            } else {
                echo "Erreur : Module introuvable.";
            }
        } else {
            // Module par défaut ou page d'accueil
        $vue = new VueGenerique();
        $vue->afficherPageAccueil();

}


