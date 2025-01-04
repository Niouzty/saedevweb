<?php
require_once 'Connexion.php'; // Assurez-vous que le fichier Connexion.php existe

abstract class ModeleGenerique {
    protected $bdd;

    public function __construct() {
        $this->bdd = $this->connecterBDD();
    }

    /**
     * Méthode pour établir une connexion à la base de données.
     * Utilise la classe Connexion pour gérer la connexion.
     */
    private function connecterBDD() {
        try {
            // Utilisation de la connexion centralisée
            return Connexion::getBdd();
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données via le modèle générique : ' . $e->getMessage());
        }
    }
}
?>
