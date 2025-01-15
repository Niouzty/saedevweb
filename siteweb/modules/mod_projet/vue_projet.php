<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets</title>
    <link rel="stylesheet" href="./public/css/style.css"> <!-- Lien vers le CSS -->
</head>
<body>
    <!-- Barre de navigation -->
    <div class="navbar">
        <img src="./public/images/logoiutmontreuil-sommaire.png" alt="Logo IUT Montreuil">
        <div>
            <a href="index.php">Home</a>
            <a href="#">Ressources</a>
            <a href="index.php?module=projet&action=cree_projet">Créer Projet</a>
            <a href="index.php?module=projet&action=cree_rendu">Créer Rendu</a>
            <a href="index.php?module=projet&action=listerProjets">Voir la liste des Projets</a>
            <a href="index.php?module=projet&action=listerRendus">Voir la liste des Rendus</a>
            <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>

    <!-- Contenu dynamique -->
    <div class="content">
        <?php
            // Inclure le contenu spécifique selon l'action
            if (isset($content)) {
                echo $content;
            } else {
                // Afficher un message par défaut
                echo '<p>Bienvenue dans la gestion des projets !</p>';
            }
        ?>
    </div>
</body>
</html>
