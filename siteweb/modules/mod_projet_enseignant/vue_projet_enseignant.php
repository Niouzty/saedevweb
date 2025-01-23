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
            <?php 
                Template::afficherNavigationEnseignantProjet();
            ?>
        <?php

    }

    // Afficher les ressources d'un projet
    public function afficherRessources($ressources, $idProjet) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gestion des Ressources</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <!-- Barre de navigation -->
            <?php $this->afficherBarreDeNavigationProjet(); ?>
    
            <!-- Section de gestion des ressources -->
            <div class="container mt-4">
                <h2 class="mb-4">Ressources pour le Projet</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Chemin/Contenu</th>
                            <th>Mise en Avant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ressources as $ressource): ?>
                            <tr>
                                <td><?= htmlspecialchars($ressource['fichier']); ?></td>
                                <td><?= htmlspecialchars($ressource['chemin_contenu']); ?></td>
                                <td><?= $ressource['mise_en_avant'] ? 'Oui' : 'Non'; ?></td>
                                <td>
                                    <a href="<?= htmlspecialchars($ressource['chemin_contenu']); ?>" target="_blank" class="btn btn-success btn-sm">Voir</a>
                                    <a href="?module=projet_enseignant&action=supprimerRessource&id=<?= $ressource['id_ressource']; ?>&projet_id=<?= $idProjet; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                                    <a href="?module=projet_enseignant&action=modifierMiseEnAvant&id=<?= $ressource['id_ressource']; ?>&projet_id=<?= $idProjet; ?>&mise_en_avant=<?= $ressource['mise_en_avant'] ? 0 : 1; ?>" class="btn btn-warning btn-sm">
                                        <?= $ressource['mise_en_avant'] ? 'Désactiver' : 'Mettre en Avant'; ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
    
                <!-- Formulaire d'ajout de ressources -->
                <h3 class="mt-4">Ajouter une Ressource</h3>
                <form method="POST" enctype="multipart/form-data" action="?module=projet_enseignant&action=ajouterRessource&projet_id=<?= $idProjet; ?>">
                    <div class="mb-3">
                        <label for="type" class="form-label">Type de Ressource</label>
                        <select class="form-select" id="type" name="type">
                            <option value="fichier">Fichier</option>
                            <option value="lien">Lien</option>
                            <option value="texte">Texte</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="chemin_contenu" class="form-label">Fichier</label>
                        <input type="file" class="form-control" id="chemin_contenu" name="chemin_contenu" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="mise_en_avant" name="mise_en_avant">
                        <label for="mise_en_avant" class="form-check-label">Mettre en avant</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
                </form>
            </div>
        </body>
        </html>
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
                
                <?php if (empty($rendus)): ?>
                    <div class="alert alert-warning" role="alert">
                        Aucun rendu n'a été trouvé.
                    </div>
                <?php else: ?>
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
                <?php endif; ?>
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
                        <label for="intervenants" class="form-label">Attribuer des Intervenants</label>
                        <select class="form-select" id="intervenants" name="intervenants[]" multiple>
                            <?php foreach ($enseignants as $enseignant): ?>
                                <option value="<?= $enseignant['id_enseignant']; ?>"><?= htmlspecialchars($enseignant['nom']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-muted">Sélectionnez les enseignants intervenants pour ce projet.</small>
                    </div>
                    <div class="mb-3">
                        <label for="ressources" class="form-label">Ajouter des Ressources</label>
                        <input type="file" class="form-control" id="ressources" name="ressources[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Créer Projet</button>
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
                                    <p class="card-text">
                                        <small class="text-muted">Année: <?= htmlspecialchars($projet['annee']); ?>, Semestre: <?= htmlspecialchars($projet['semestre']); ?></small>
                                    </p>
                                    <a href="?module=projet_enseignant&action=ressources&projet_id=<?= $projet['id_projet']; ?>" class="btn btn-primary">Gérer Ressources</a>
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