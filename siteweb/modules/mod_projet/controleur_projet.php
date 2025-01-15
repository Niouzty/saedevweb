<?php
require_once "modele_projet.php";
require_once "vue_projet.php";
session_start();

class ControleurProjet {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleProjet();
    }

    public function afficherProjets() {
        $vue = new VueProjet();

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }

        $projets = $this->modele->getProjets();
        $vue->afficherProjets($projets);
    }

    public function afficherRendus($projetId) {
        $vue = new VueProjet();

        $rendus = $this->modele->getRendus($projetId);
        $vue->afficherRendus($rendus, $projetId);
    }

    public function deposerRendu() {
        // Vérification de l'upload
        if (isset($_FILES['fichier'])) {
            $fichier = $_FILES['fichier'];
            $cheminCible = __DIR__ . '/uploads/' . basename($fichier['name']);
    
            if (move_uploaded_file($fichier['tmp_name'], $cheminCible)) {
                // Sauvegarde du rendu dans la base de données
                $this->modele->saveRendu($projetId, $userId, $cheminCible);
                header("Location: ?module=projet&action=rendus&projet_id=$projetId");
                exit;
            } else {
                echo "Erreur lors de l'upload du fichier.";
            }
        } else {
            echo "Aucun fichier sélectionné.";
        }
    }
}