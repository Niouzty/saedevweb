<?php
require_once "core/module_generique.php";
require_once "controleur_projet_enseignant.php";

class ModuleProjetEnseignant extends ModeleGenerique{
    private $controleur; // Déclarer $controleur comme propriété de la classe
    public function __construct() {
        $this->controleur = $this->creerControleur();

    
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            switch ($action) {
                case 'projets':
                    $this->controleur->afficherProjets();
                    break;
                case 'listeProjets':
                    $this->controleur->afficherProjets();
                    break;
                case 'supprimerRessource':
                    if (isset($_GET['projet_id'])){
                    $projetId = intval($_GET['projet_id']);
                    $this->controleur->supprimerRessource($projetId);
                    $this->controleur->afficherRessources($projetId);
                    }
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
                case 'listeRendus':
                    $this->controleur->afficherListeRendus();
                    break;
                default:
                    echo "Action non reconnue.";
            }
        } else {
            $this->controleur->afficherProjets();
        }
    }
    protected function creerControleur() {
        return new ControleurProjetEnseignant();
    }

    protected function creerModele() {
        return new ModeleProjetEnseignant();
    }

}
?>