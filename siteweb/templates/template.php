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
      
        echo'
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php?module=projet&action=projets">Gestion des Projets</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=etudiant&action=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=&action=">Texte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=projet&action=projets">Projets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=messagerie&action=conversations">Messagerie</a>
                        </li>
                    </ul>
                    <a class="btn btn-light ms-auto" href="deconnexion.php">Déconnexion</a>
                </div>
            </div>
        </nav>';
    }
    
    public static function afficherNavigationEnseignant() {
        echo'
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php?module=projet&action=projets">Gestion des Projets</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=etudiant&action=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=projet_enseignant&action=projets">Accueil Projets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=projet_enseignant&action=creerProjet">Créer Projet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=projet_enseignant&action=creerRendu">Créer Rendu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=projet_enseignant&action=listeProjets">Liste des Projets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=projet_enseignant&action=listeRendus">Liste des Rendus</a>
                        </li>
                    </ul>
                    <a class="btn btn-light ms-auto" href="deconnexion.php">Déconnexion</a>
                </div>
            </div>
        </nav>';
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

