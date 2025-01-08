<?php
require_once 'modele_ressources.php';

class ControleurRessource {
    private $modele;

    public function __construct() {
        $this->modele = new ModeleRessource();
    }

    public function afficherFormulaire() {
        require_once 'vue_ressources.php';
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
