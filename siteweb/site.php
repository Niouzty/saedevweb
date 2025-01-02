<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Site {
    private $modules = [];

    public function __construct() {
        // Démarre la session
        session_start();
        
        // Charge la configuration de la base de données
        $this->chargerConfiguration();
    }

    /**
     * Charge la configuration de la base de données ou autres fichiers nécessaires.
     */
    private function chargerConfiguration() {
       
    require_once __DIR__ . '/connexion.php';              // Connexion à la base de données
    require_once __DIR__ . '/core/module_generique.php';
    require_once __DIR__ . '/core/modele_generique.php';
    require_once __DIR__ . '/core/vue_generique.php';
    require_once __DIR__ . '/templates/template.php';

    }

    /**
     * Ajoute un module au site.
     * 
     * @param string $nom Nom du module
     * @param string $chemin Chemin vers le fichier PHP du module
     */
    public function ajouterModule($nom, $chemin) {
        $this->modules[$nom] = $chemin;
    }

    /**
     * Affiche le site en fonction du module demandé.
     */
    public function afficher() {
        // Vérifie si un module spécifique est demandé
        if (isset($_GET['module']) && isset($this->modules[$_GET['module']])) {
            $module = $_GET['module'];
            require_once $this->modules[$module];
            $classeModule = "Module" . ucfirst($module); // Exemple : "ModuleConnexion"
            
            if (class_exists($classeModule)) {
                new $classeModule(); // Instancie et exécute le module
            } else {
                echo "Erreur : Module introuvable.";
            }
        } else {
            // Module par défaut ou page d'accueil
            $this->afficherAccueil();
        }
    }

    /**
     * Affiche la page d'accueil.
     */
    private function afficherAccueil() {
        $vue = new VueGenerique();
        $vue->afficherPageAccueil();
    }
}

?>

