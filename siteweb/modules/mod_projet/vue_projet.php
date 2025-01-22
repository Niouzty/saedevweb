<?php
class VueProjet extends VueGenerique{
    
    public function afficherProjets($projets) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des Projets</title>
            <!-- Inclure Bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        </head>
        <body>
            <?php 
                Template::afficherNavigationEtudiant();
            ?>
            <div class="container mt-4">
                <h1 class="mb-4">Liste des Projets</h1>
                <div class="row">
                    <?php foreach ($projets as $projet): ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($projet['nom']); ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($projet['description']); ?></p>
                                    <p class="card-text"><small class="text-muted">Année: <?= htmlspecialchars($projet['annee']); ?>, Semestre: <?= htmlspecialchars($projet['semestre']); ?></small></p>
                                    <a href="?module=projet&action=rendus&projet_id=<?= $projet['id_projet']; ?>" class="btn btn-primary">Travail à rendre</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </body>
        </html>
        <?php
    }

    public function afficherRendus($rendus, $projetId) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des Projets</title>
            <!-- Inclure Bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


        </head>
        <body>
            <?php 
                Template::afficherNavigationEtudiant();
            ?>
            <div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h4">Rendus pour le projet</h1>
        </div>
        <div class="card-body">
            <ul class="list-group mb-4">
                <?php if (!empty($rendus)): ?>
                    <?php foreach ($rendus as $rendu): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">
                                    <a href="<?= htmlspecialchars($rendu['chemin_fichier']); ?>" target="_blank" class="text-decoration-none text-primary">
                                        Fichier à rendre
                                    </a>
                                </div>
                                <?= htmlspecialchars($rendu['description'] ?? 'Description non disponible'); ?>
                                <br>
                                <small class="text-muted">
                                    Déposé par <?= htmlspecialchars($rendu['nom'] . ' ' . $rendu['prenom'] ?? 'Utilisateur inconnu'); ?> 
                                    le <?= htmlspecialchars($rendu['date_depot']); ?>
                                </small>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item text-center text-muted">
                        Aucun rendu disponible pour ce projet.
                    </li>
                <?php endif; ?>
            </ul>

            
        </div>
    </div>
</div>

        </body>
        </html>
        <?php
    }
    
}

