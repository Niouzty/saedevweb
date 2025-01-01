<?php
class Connexion {
    protected static $bdd;

    public static function init_connexion() {

            $dsn = "pgsql:host=dpg-ctqr9hrtq21c73a8n420-a.frankfurt-postgres.render.com;dbname=db_etudiants;port=5432";
            $user = "db_etudiants_user";
            $password = "OrT6gi8ppzdJGmbexXQpcsh0lGk0JNOK";


            self::$bdd = new PDO($dsn, $user, $password);

    }


    public static function getBdd() {
        return self::$bdd;
    }
}
?>
