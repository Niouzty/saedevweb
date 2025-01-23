<?php
class VueGroupeEnseignant extends VueGenerique {

    // Afficher les projets
    public function afficherProjets($projets) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gestion des Groupes par Projet</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <!-- Barre de navigation -->
            <?php Template::afficherNavigationEnseignant(); ?>

            <!-- Contenu principal -->
            <div class="container mt-5">
                <h1 class="text-center mb-4">Gestion des Groupes par Projet</h1>
                <p class="text-center">Sélectionnez un projet pour gérer les groupes et les élèves associés.</p>

                <!-- Sélection d'un projet -->
                <section>
                    <h2 class="mb-3">Projets Existants</h2>
                    <form action="index.php?module=enseignant&action=afficherGroupes" method="POST" class="d-flex justify-content-center">
                        <select id="selectProjet" name="id_projet" class="form-select w-auto me-3">
                            <?php foreach ($projets as $projet) { ?>
                                <option value="<?= htmlspecialchars($projet['id_projet']); ?>">
                                    <?= htmlspecialchars($projet['nom']); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <button type="submit" class="btn btn-primary">Afficher les Groupes</button>
                    </form>
                </section>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }

    // Afficher les membres d'un groupe
    public function afficherMembres($membres, $etudiantsDisponibles, $id_groupe) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Membres du Groupe</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <!-- Barre de navigation -->
            <?php Template::afficherNavigationEnseignant(); ?>
    
            <!-- Contenu principal -->
            <div class="container mt-5">
                <h2 class="mb-4">Membres du Groupe</h2>
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Nom de l'Élève</th>
                            <th>Voir les Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($membres as $membre) { ?>
                            <tr>
                                <td><?= htmlspecialchars($membre['nom']) ?> <?= htmlspecialchars($membre['prenom']) ?></td>
                                <td>
                                    <a href="index.php?module=enseignant&action=voirNotes&id_etudiant=<?= $membre['id_etudiant'] ?>" class="btn btn-info btn-sm">Voir les Notes</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
    
                <!-- Ajouter des étudiants -->
                <h3 class="mt-4">Ajouter des Étudiants au Groupe</h3>
                <?php if (empty($etudiantsDisponibles)) { ?>
                    <p class="alert alert-warning">Aucun étudiant disponible à ajouter à ce groupe.</p>
                <?php } else { ?>
                    <table class="table table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($etudiantsDisponibles as $etudiant) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                                    <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                                    <td>
                                        <form action="index.php?module=enseignant&action=ajouterEtudiant" method="POST">
                                            <input type="hidden" name="id_etudiant" value="<?= htmlspecialchars($etudiant['id_etudiant']) ?>">
                                            <input type="hidden" name="id_groupe" value="<?= htmlspecialchars($id_groupe) ?>">
                                            <button type="submit" class="btn btn-success btn-sm">Ajouter au Groupe</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
    
                <!-- Retour à la liste des groupes -->
                <a href="index.php?module=enseignant&action=afficherGroupes" class="btn btn-secondary mt-3">Retour à la Liste des Groupes</a>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
    

    // Afficher les groupes d'un projet
    public function afficherGroupes($groupes, $id_projet) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Groupes du Projet</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <!-- Barre de navigation -->
            <?php Template::afficherNavigationEnseignant(); ?>
    
            <!-- Contenu principal -->
            <div class="container mt-5">
                <h2 class="mb-4">Groupes du Projet</h2>
                <a href="index.php?module=enseignant&action=afficherFormulaireCreerGroupe&id_projet=<?= $id_projet ?>" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Créer un Nouveau Groupe
                </a>
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Nom du Groupe</th>
                            <th>Membres</th>
                            <th>Voir les Notes</th>
                            <th>Supprimer le Groupe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($groupes as $groupe) { ?>
                            <tr>
                                <td><?= htmlspecialchars($groupe['nom']) ?></td>
                                <td>
                                    <a href="index.php?module=enseignant&action=afficherMembres&id_groupe=<?= $groupe['id_groupe'] ?>" class="btn btn-info btn-sm">Voir les Membres</a>
                                </td>
                                <td>
                                    <a href="index.php?module=enseignant&action=voirNotes&id_groupe=<?= $groupe['id_groupe'] ?>" class="btn btn-warning btn-sm">Voir les Notes</a>
                                </td>
                                <td>
                                    <form action="index.php?module=enseignant&action=supprimerGroupe" method="POST">
                                        <input type="hidden" name="id_groupe" value="<?= $groupe['id_groupe'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
    
}