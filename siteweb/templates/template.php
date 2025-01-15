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
<div class='home-header-container'>
    <header>
        <h1 class='home-site-title'>{$titre}</h1>
        <nav class='home-main-nav'>
            <a href='?module=connexion' class='home-nav-link'>Go !</a>
        </nav>
    </header>
</div>";
    }

    public static function afficherPiedDePage() {
        echo "<div class='home-footer-container'>
    <footer>
        <p class='home-footer-text'>&copy; " . date('Y') . " Mon Site. Tous droits réservés.</p>
    </footer>
</div>
</body>
</html>";
    }
}
?>
