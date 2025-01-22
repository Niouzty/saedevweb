<?php
class Connexion {
    protected static $bdd;

    public static function init_connexion() {
        $dsn = "mysql:host=localhost;dbname=saemanager";
        $user = "root";
        $password = "";

        try {
            self::$bdd = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Gère les erreurs via des exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Définit le mode de récupération par défaut
                PDO::ATTR_EMULATE_PREPARES => false, // Utilise les requêtes préparées natives
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getBdd() {
        if (!self::$bdd) {
            self::init_connexion();
        }
        return self::$bdd;
    }
}
?>
