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

    public static function afficherPiedDePage() {
        echo "<footer>
    <p>&copy; " . date('Y') . " Mon Site. Tous droits réservés.</p>
</footer>
</body>
</html>";
    }
}
?>

