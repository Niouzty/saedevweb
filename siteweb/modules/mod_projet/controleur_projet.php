<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'modele_projet.php';
require_once "vue_projet.php";

class ControleurProjet {
    private $modele;

    public function __construct() {
        $this->modele = new ModeleProjet();
    }

    public function afficherProjet() {
        $vue = new VueProjet();
        $vue->afficherProjet();
    }

    public function enregistrerRessource() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $consignes = $_POST['consignes'] ?? '';
            $semestre = $_POST['semestre'] ?? '';
            $duree = $_POST['duree'] ?? '';
            $fichier = $_FILES['fichier'] ?? null;

            if ($this->modele->sauvegarder($titre, $consignes, $semestre, $duree, $fichier)) {
                echo "Ressource enregistrée avec succès !";
            } else {
                echo "Erreur lors de l'enregistrement de la ressource.";
            }
        }
    }

    public function afficherDetails($id) {
        $projet = $this->modele->recupererParId($id);
        if ($projet) {
            require 'vue_details.php';
        } else {
            echo "Projet introuvable.";
        }
    }
}
?>
