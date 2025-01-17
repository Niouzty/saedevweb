<?php
class Template {
    public static function afficherEnTete($titre = "Mon Site") {
        echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>{$titre}</title>
    <link rel='stylesheet' href='public/css/style.css'>
</head>
<body>
<header>
    <h1>{$titre}</h1>
    <nav>
        <a href='?module=connexion'>Connexion</a>
    </nav>
</header>";
    }


    public static function afficherNavigationEtudiant() {
        echo '<div class="navbar">
            <img src="./public/images/logoiutmontreuil-sommaire.png" alt="Logo IUT Montreuil">
            <div>
                <a href="#">Home</a>
                <a href="#">Texte</a>
                <a href="index.php?module=projet&action=projets">Projets</a>
                <a href="index.php?module=messagerie&action=conversations">Messagerie</a>
                <a href="deconnexion.php">Déconnexion</a>
            </div>
        </div>';
    }
    
    public static function afficherNavigationEnseignant() {
        echo '<div class="navbar">
            <img src="./public/images/logoiutmontreuil-sommaire.png" alt="Logo IUT Montreuil">
            <div>
                <a href="#">Home</a>
                <a href="#">Texte</a>
                <a href="index.php?module=projet&action=projets">Projets</a>
                <a href="index.php?module=messagerie&action=conversations">Messagerie</a>
                <a href="deconnexion.php">Déconnexion</a>
            </div>
        </div>';
    }
    

    public static function afficherPiedDePage() {
        echo "<footer>
    <p>&copy; " . date('Y') . " Mon Site. Tous droits réservés.</p>
</footer>
</body>
</html>";
    }
}
?>

