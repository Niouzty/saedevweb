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
    $module = $_GET['module']; // Exemple : "projet"
    $role = $_GET['role'] ?? null;  // Récupère le rôle si spécifié (enseignant, étudiant)

    // Définir le chemin du fichier du module
    $basePath = 'modules/mod_' . $module . '/';  // Dossier du module spécifique
    $filePath = $basePath . 'module_' . $module . ($role ? '_' . $role : '') . '.php'; // Exemple : "module_projet_enseignant.php" ou "module_projet.php"

    if (file_exists($filePath)) {
        require_once $filePath;  // Inclure le fichier correspondant

        // Générer dynamiquement le nom de la classe du module
        $classeModule = "Module" . ucfirst($module);  // Exemple : "ModuleProjet"
        if ($role) {
            $classeModule .= ucfirst($role);  // Exemple : "ModuleProjetEnseignant"
        }

        if (class_exists($classeModule)) {
            new $classeModule();  // Instancie et exécute le module
        } else {
            echo "Erreur : Classe introuvable pour le module.";
        }
    } else {
        echo "Erreur : Fichier du module introuvable.";
    }
} else {
    // Module par défaut ou page d'accueil
    $vue = new VueGenerique();
    $vue->afficherPageAccueil();  // Afficher la page d'accueil
}




