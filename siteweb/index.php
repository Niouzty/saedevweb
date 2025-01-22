<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('memory_limit', '512M'); // Augmente la limite à 512 Mo

require_once "connexion.php";
require_once "site.php";
require_once __DIR__ . '/core/module_generique.php';
require_once __DIR__ . '/core/modele_generique.php';
require_once __DIR__ . '/core/vue_generique.php';
require_once __DIR__ . '/templates/template.php';

if (isset($_GET['module'])) {
    $module = $_GET['module']; // Exemple : "mod_projet_enseignant" ou "projet"
    $role = $_GET['role'] ?? null; // Récupère le rôle (enseignant, étudiant)

    // Corrige la construction du chemin pour éviter les doublons "mod_"
    if (strpos($module, 'mod_') === 0) {
        $basePath = 'modules/' . $module . '/';
        $filePath = $basePath . 'module_' . substr($module, 4) . ($role === 'enseignant' ? '_enseignant' : '') . '.php';
    } else {
        $basePath = 'modules/mod_' . $module . '/';
        $filePath = $basePath . 'module_' . $module . ($role === 'enseignant' ? '_enseignant' : '') . '.php';
    }

    

    if (file_exists($filePath)) {
        require_once $filePath;

        // Générer dynamiquement le nom de la classe
        $classeModule = "Module" . str_replace('_', '', ucwords(str_replace('mod_', '', $module), '_'));
        if ($role === 'enseignant') {
            $classeModule .= 'Enseignant';
        }


        if (class_exists($classeModule)) {
            new $classeModule();
        } else {
            die("Erreur : Classe $classeModule non trouvée dans $filePath");
        }
    } else {
        die("Erreur : Fichier du module introuvable. Chemin recherché : $filePath");
    }
} else {
    // Module par défaut ou page d'accueil
    $vue = new VueGenerique();
    $vue->afficherPageAccueil();
}
