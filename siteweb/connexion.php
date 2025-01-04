<?php
class Connexion {
    protected static $bdd;

    public static function init_connexion() {
        $dsn = "pgsql:host=c7u1tn6bvvsodf.cluster-czz5s0kz4scl.eu-west-1.rds.amazonaws.com;dbname=d527299jlj893t;port=5432";
        $user = "ubb1tnsj4gj1rn";
        $password = "pf3c500e18dcf6dea745cf9165c9c3e28d48b12f430623c79cb95573a1993b814";

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
