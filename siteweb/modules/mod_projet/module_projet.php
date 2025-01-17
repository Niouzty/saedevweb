<?php
require_once "core/module_generique.php";
require_once "controleur_projet.php";

class ModuleProjet extends ModuleGenerique {
    public function __construct() {
        $this->controleur = new ControleurProjet();

        // Debugging : Affichage de l'action
        echo var_dump($_GET['action']);
        
        // Vérification de l'action
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'projets':
                    // Afficher les projets disponibles
                    $this->controleur->afficherProjets();
                    break;
                case 'rendus':
                    // Afficher les rendus pour un projet
                    if (isset($_GET['projet_id'])) {
                        $this->controleur->afficherRendus($_GET['projet_id']);
                    }
                    break;
                case 'deposer':
                    // Déposer un rendu
                    $this->controleur->deposerRendu();
                    break;
                default:
                    echo "Action non reconnue.";
            }
        } else {
            // Par défaut, afficher les projets
            $this->controleur->afficherProjets();
        }
    }

    protected function creerControleur() {}
    protected function creerModele() {}
}