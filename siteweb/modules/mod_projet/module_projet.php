<?php
require_once 'modele_projet.php';
require_once 'controleur_projet.php';
require_once 'vue_projet.php';

class ModuleProjet {
    public function run($action) {
        $controleur = new ControleurProjet();

        switch ($action) {
            case 'afficher':
                $controleur->afficherFormulaire();
                break;
            case 'listeEtudiants':
                $controleur->listerEtudiants();
                break;
            case 'statistiquesEtudiants':
                $controleur->afficherStatistiques();
                break;
            default:
                echo "Action inconnue.";
                break;
        }
    }
}

?>
