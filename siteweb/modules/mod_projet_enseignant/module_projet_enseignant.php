<?php
require_once "controleur_projet_enseignant.php";

class ModuleProjetEnseignant extends ModuleGenerique {
    public function __construct() {
        $this->controleur = new ControleurProjetEnseignant();

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            switch ($action) {
                case 'projets':
                case 'listeProjets':
                    $this->controleur->afficherProjets();
                    break;
                case 'rendus':
                    if (isset($_GET['projet_id'])) {
                        $projetId = intval($_GET['projet_id']);
                        $this->controleur->afficherRendus($projetId);
                    } else {
                        echo "ID du projet manquant.";
                    }
                    break;
                case 'ressources':
                    if (isset($_GET['projet_id'])) {
                        $projetId = intval($_GET['projet_id']);
                        $this->controleur->afficherRessources($projetId);
                    } else {
                        echo "ID du projet manquant pour afficher les ressources.";
                    }
                    break;
                case 'ajouterRessource':
                    if (isset($_GET['projet_id'])) {
                        $projetId = intval($_GET['projet_id']);
                        $this->controleur->ajouterRessource($projetId);
                    } else {
                        echo "ID du projet manquant pour ajouter une ressource.";
                    }
                    break;
                case 'creerProjet':
                    $this->controleur->creerProjet();
                    break;
                case 'creerRendu':
                    $this->controleur->creerRendu();
                    break;
                case 'listeRendus' : 
                    $this->controleur->afficherListeRendus();
                default:
                    echo "Action non reconnue.";
            }
        } else {
            $this->controleur->afficherProjets();
        }
    }

    protected function creerControleur() {
        $this->controleur = new ControleurProjetEnseignant();
    }

    protected function creerModele() {
        $this->modele = new ModeleProjetEnseignant();
    }
}
?>
