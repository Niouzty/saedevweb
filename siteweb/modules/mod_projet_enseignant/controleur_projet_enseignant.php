<?php
require_once "controleur_projet_enseignant.php";

class ControleurProjetEnseignant {
    public function __construct() {
        $module = new ModuleProjetEnseignant();

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            switch ($action) {
                case 'projets':
                case 'listeProjets':
                    $module->afficherProjets();
                    break;
                case 'rendus':
                    if (isset($_GET['projet_id'])) {
                        $projetId = intval($_GET['projet_id']);
                        $module->afficherRendus($projetId);
                    } else {
                        echo "ID du projet manquant.";
                    }
                    break;
                case 'ressources':
                    if (isset($_GET['projet_id'])) {
                        $projetId = intval($_GET['projet_id']);
                        $module->afficherRessources($projetId);
                    } else {
                        echo "ID du projet manquant pour afficher les ressources.";
                    }
                    break;
                case 'ajouterRessource':
                    if (isset($_GET['projet_id'])) {
                        $projetId = intval($_GET['projet_id']);
                        $module->ajouterRessource($projetId);
                    } else {
                        echo "ID du projet manquant pour ajouter une ressource.";
                    }
                    break;
                case 'creerProjet':
                    $module->creerProjet();
                    break;
                case 'creerRendu':
                    $module->creerRendu();
                    break;
                case 'listeRendus':
                    $module->afficherListeRendus();
                    break;
                default:
                    echo "Action non reconnue.";
            }
        } else {
            $module->afficherProjets();
        }
    }
}
?>