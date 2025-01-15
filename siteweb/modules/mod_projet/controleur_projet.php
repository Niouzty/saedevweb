<?php
require_once 'modele_projet.php';

class ControleurProjet {
    private $modele;

    public function __construct() {
        $this->modele = new ModeleProjet();
    }

    public function run($action) {
        switch ($action) {
            case 'afficher':
                $this->afficherFormulaire();
                break;
            case 'enregistrerRessource':
                $message = $this->enregistrerRessource();
                $this->afficherFormulaire($message); // Affiche avec un message de succès
                break;
            case 'listerEtudiants':
                $this->listerEtudiants();
                break;
            case 'statistiquesEtudiants':
                $this->afficherStatistiques();
                break;
            case 'creerGroupes':
                $this->creerGroupes();
                break;
            default:
                echo "Action inconnue.";
                break;
        }
    }

    public function afficherFormulaire($message = '') {
        require_once 'vue_projet.php';
    }

    public function enregistrerRessource() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $annee = $_POST['annee'] ?? '';
            $semestre = $_POST['semestre'] ?? '';
            $fichier = $_FILES['fichier'] ?? null;

            if ($this->modele->sauvegarder($titre, $description, $annee, $semestre)) {
                return "Le projet a été enregistré avec succès !";
            } else {
                return "Erreur lors de l'enregistrement du projet.";
            }
        }
    }

    public function listerEtudiants() {
        $etudiants = $this->modele->getEtudiants();
        require_once 'vue_liste_etudiants.php';
    }

    public function afficherStatistiques() {
        $statistiques = $this->modele->getStatistiques();
        require_once 'vue_statistiques_etudiants.php';
    }

    public function creerGroupes() {
        $etudiants = $this->modele->getEtudiants();
        require_once 'vue_creation_groupes.php';
    }
}
