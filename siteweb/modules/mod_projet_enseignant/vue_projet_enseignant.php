<?php
class VueProjetEnseignant extends VueGenerique {

    // Inclure Bootstrap dans le `<head>`
    private function inclureBootstrap() {
        ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <?php
    }

    // Afficher la barre de navigation
    private function afficherBarreDeNavigationProjet() {
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php?module=projet_enseignant&action=projets">Gestion des Projets</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?module=enseignant&action=home">Home</a>
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
        </nav>
        <?php
    }

    // Méthode pour afficher des messages (succès, erreur, information)
    public function afficherMessage($message, $type = "info") {
        // Types disponibles : success, danger, warning, info
        ?>
        <div class="container mt-3">
            <div class="alert alert-<?= htmlspecialchars($type); ?>" role="alert">
                <?= htmlspecialchars($message); ?>
            </div>
        </div>
        <?php
    }

    // Afficher la page principale avec la barre de navigation et Bootstrap
    public function afficherPagePrincipale() {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gestion des Projets</title>
            <!-- Inclure Bootstrap directement ici -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <?php $this->afficherBarreDeNavigationProjet(); ?>

            <div class="container mt-4">
                <h1 class="text-center">Bienvenue dans la Gestion des Projets</h1>
                <p class="text-center">Utilisez la barre de navigation pour accéder aux différentes fonctionnalités.</p>
            </div>
        </body>
        </html>
        <?php
    }

    // Afficher la liste des projets
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
            <?php $this->afficherBarreDeNavigationProjet(); ?>
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
                                    <a href="?module=projet_enseignant&action=rendus&projet_id=<?= $projet['id_projet']; ?>" class="btn btn-primary">Voir les rendus</a>
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

    // Afficher la liste des rendus
    public function afficherListeRendus($rendus) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des Rendus</title>
            <!-- Inclure Bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <?php $this->afficherBarreDeNavigationProjet(); ?>
    
            <div class="container mt-4">
                <h1 class="mb-4">Liste des Rendus</h1>
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Rendu</th>
                            <th scope="col">Projet</th>
                            <th scope="col">Date de Dépôt</th>
                            <th scope="col">Fichier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rendus as $rendu): ?>
                            <tr>
                                <td><?= htmlspecialchars($rendu['id_rendu']); ?></td>
                                <td><?= htmlspecialchars($rendu['id_projet']); ?></td>
                                <td><?= htmlspecialchars($rendu['date_depot']); ?></td>
                                <td>
                                    <a href="<?= htmlspecialchars($rendu['fichier']); ?>" class="btn btn-sm btn-success" target="_blank">
                                        Télécharger
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </body>
        </html>
        <?php
    }
    

    // Afficher le formulaire de création de projet
    public function afficherFormulaireProjet($enseignants, $ressources) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Créer un Projet</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <?php $this->afficherBarreDeNavigationProjet(); ?>
    
            <div class="container mt-4">
                <h1 class="mb-4">Créer un nouveau Projet</h1>
                <form method="POST" action="?module=projet_enseignant&action=creerProjet" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="annee" class="form-label">Année</label>
                        <input type="number" class="form-control" id="annee" name="annee" required>
                    </div>
                    <div class="mb-3">
                        <label for="semestre" class="form-label">Semestre</label>
                        <select class="form-select" id="semestre" name="semestre" required>
                            <option value="1">Semestre 1</option>
                            <option value="2">Semestre 2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="intervenants" class="form-label">Intervenants</label>
                        <select class="form-select" id="intervenants" name="intervenants[]" multiple>
                            <?php foreach ($enseignants as $enseignant): ?>
                                <option value="<?= $enseignant['id_enseignant']; ?>"><?= htmlspecialchars($enseignant['nom']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ressources" class="form-label">Ajouter des Ressources</label>
                        <input type="file" class="form-control" id="ressources" name="ressources[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
    
    

    // Afficher le formulaire de création de rendu
    public function afficherFormulaireRendu() {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Créer un Rendu</title>
            <!-- Inclure Bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <?php $this->afficherBarreDeNavigationProjet(); ?>

            <div class="container mt-4">
                <h1 class="mb-4">Créer un nouveau Rendu</h1>
                <form method="POST" action="?module=projet_enseignant&action=creerRendu" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="projet_id" class="form-label">Projet</label>
                        <select class="form-select" id="projet_id" name="projet_id" required>
                            <!-- Remplacez par les projets dynamiques -->
                            <option value="1">Projet 1</option>
                            <option value="2">Projet 2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Fichier</label>
                        <input type="file" class="form-control" id="fichier" name="fichier" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    }

    public function afficherFormulaireAjoutRessource($projets) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ajouter une Ressource</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <?php $this->afficherBarreDeNavigationProjet(); ?>
    
            <div class="container mt-4">
                <h1 class="mb-4">Ajouter une Ressource</h1>
                <form method="POST" action="?module=projet_enseignant&action=ajouterRessource" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de la Ressource</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="projet_id" class="form-label">Projet</label>
                        <select class="form-select" id="projet_id" name="projet_id" required>
                            <?php foreach ($projets as $projet): ?>
                                <option value="<?= $projet['id_projet']; ?>"><?= htmlspecialchars($projet['nom']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Fichier</label>
                        <input type="file" class="form-control" id="fichier" name="fichier" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    }

    public function afficherFormulaireAttributionIntervenant($projets, $enseignants) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Attribuer un Intervenant</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <?php $this->afficherBarreDeNavigationProjet(); ?>
    
            <div class="container mt-4">
                <h1 class="mb-4">Attribuer un Intervenant</h1>
                <form method="POST" action="?module=projet_enseignant&action=attribuerIntervenant">
                    <div class="mb-3">
                        <label for="projet_id" class="form-label">Projet</label>
                        <select class="form-select" id="projet_id" name="projet_id" required>
                            <?php foreach ($projets as $projet): ?>
                                <option value="<?= $projet['id_projet']; ?>"><?= htmlspecialchars($projet['nom']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="enseignant_id" class="form-label">Intervenant</label>
                        <select class="form-select" id="enseignant_id" name="enseignant_id" required>
                            <?php foreach ($enseignants as $enseignant): ?>
                                <option value="<?= $enseignant['id_enseignant']; ?>"><?= htmlspecialchars($enseignant['nom']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Attribuer</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
    
    
}
?>
