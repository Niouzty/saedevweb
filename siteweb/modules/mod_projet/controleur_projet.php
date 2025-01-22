<?php
require_once "modele_projet.php";
require_once "vue_projet.php";
session_start();

class ControleurProjet {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleProjet();
    }

    /*
    public function afficherProjets() {
        $vue = new VueProjet();

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }

        $projets = $this->modele->getProjets();
        $vue->afficherProjets($projets);
    }
*/
    public function afficherProjets() {
        $vue = new VueProjet();
        $projets = $this->modele->getProjets();
        $vue->afficherProjets($projets);
    }

    public function afficherRendus($projetId) {
        $vue = new VueProjet();

        $rendus = $this->modele->getRendus($projetId);
        $vue->afficherRendus($rendus, $projetId);
    }

    public function deposerRendu() {
        if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
            $dossierCible = '/home/etudiants/info/epembelefuala/uploads/';
            

            // Vérifier si le dossier existe, sinon le créer
            if (!is_dir($dossierCible)) {
                mkdir($dossierCible, 0775, true);
            }
            
            // Nettoyer le nom du fichier pour éviter les caractères spéciaux
            $nomFichier = preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['fichier']['name']);
            
            // Définir le chemin cible dans le dossier 'uploads'
            $cheminCible = $dossierCible . $nomFichier;
    
            // Déplacement du fichier dans le dossier cible
            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $cheminCible)) {
                echo "Fichier uploadé avec succès.";
            } else {
                echo "Erreur lors du déplacement du fichier.";
            }
        } else {
            echo "Erreur : " . ($_FILES['fichier']['error'] ?? "Aucun fichier reçu.");
        }
    }
    
    
}