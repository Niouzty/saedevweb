<?php
require_once 'modele_projet.php';

class ControleurProjet {
    private $modele;

    public function __construct() {
        $this->modele = new ModeleProjet();
    }

    public function afficherFormulaire() {
        require_once 'vue_projet_ens.php';
    }

    public function enregistrerRessource() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $fichier = $_FILES['fichier'] ?? null;

            if ($this->modele->sauvegarder($titre, $consignes, $semestre, $duree, $fichier)) {
                echo "Ressource enregistrée avec succès !";
            } else {
                echo "Erreur lors de l'enregistrement de la ressource.";
            }
        }
    }


}
?>
