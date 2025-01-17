<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets</title>
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/style.css"> <!-- Votre fichier CSS personnalisé -->
</head>

<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary projet-navbar">
        <div class="container-fluid">
            <a class="navbar-brand projet-navbar-brand" href="index.php">Gestion des Projets</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#projetNavbarNav" aria-controls="projetNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="projetNavbarNav">
                <ul class="navbar-nav me-auto projet-nav-links">
                    <li class="nav-item"><a class="nav-link projet-nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link projet-nav-link" href="index.php?module=projet&action=cree_projet">Créer Projet</a></li>
                    <li class="nav-item"><a class="nav-link projet-nav-link" href="index.php?module=projet&action=cree_rendu">Créer Rendu</a></li>
                    <li class="nav-item"><a class="nav-link projet-nav-link" href="index.php?module=projet&action=listerProjets">Liste des Projets</a></li>
                    <li class="nav-item"><a class="nav-link projet-nav-link" href="index.php?module=projet&action=listerRendus">Liste des Rendus</a></li>
                </ul>
                <a class="btn btn-light projet-btn" href="deconnexion.php">Déconnexion</a>
            </div>
        </div>
    </nav>

    <!-- Contenu dynamique -->
    <div class="container mt-4 projet-content">
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
