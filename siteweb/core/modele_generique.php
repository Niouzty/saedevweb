<?php
abstract class ModeleGenerique {
    protected $bdd;

    public function __construct() {
        $this->bdd = $this->connecterBDD();
    }

    /**
     * Méthode pour établir une connexion à la base de données.
     * Configure PDO avec des options pour la gestion des erreurs.
     */
    private function connecterBDD() {
        try {
            // Connexion à PostgreSQL
            return new PDO('pgsql:host=dpg-ctqr9hrtq21c73a8n420-a.frankfurt-postgres.render.com;dbname=db_etudiants;port=5432', 
                           'db_etudiants_user', 
                           'OrT6gi8ppzdJGmbexXQpcsh0lGk0JNOK', [
                               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                           ]);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}

?>

