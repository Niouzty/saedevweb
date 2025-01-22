class VueGroupe {
    public function afficherBarreDeNavigationGroupe() {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gestion des Groupes</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php?module=groupe&action=gestionGroupes">Gestion des Groupes</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?module=groupe&action=listeGroupes">Liste des Groupes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?module=groupe&action=creerGroupe">Créer un Groupe</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?module=groupe&action=notesGroupes">Notes des Groupes</a>
                            </li>
                        </ul>
                        <a class="btn btn-light ms-auto" href="deconnexion.php">Déconnexion</a>
                    </div>
                </div>
            </nav>
            <div class="container mt-4">
                <h1 class="text-center">Bienvenue dans la Gestion des Groupes</h1>
                <p class="text-center">Utilisez les options ci-dessus pour gérer les groupes d'étudiants.</p>
            </div>
        </body>
        </html>
        <?php
    }


    public function afficherListeGroupes($groupes) {
        ?>
        <div class="container mt-4">
            <h2>Liste des Groupes</h2>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nom du Groupe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groupes as $groupe): ?>
                        <tr>
                            <td><?= htmlspecialchars($groupe['id_groupe']); ?></td>
                            <td><?= htmlspecialchars($groupe['nom_groupe']); ?></td>
                            <td>
                                <a href="index.php?module=groupe&action=voirGroupe&id=<?= $groupe['id_groupe']; ?>" class="btn btn-info btn-sm">Voir</a>
                                <a href="index.php?module=groupe&action=modifierGroupe&id=<?= $groupe['id_groupe']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="index.php?module=groupe&action=supprimerGroupe&id=<?= $groupe['id_groupe']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function afficherFormulaireCreerGroupe($etudiants) {
        ?>
        <div class="container mt-4">
            <h2>Créer un Groupe</h2>
            <form method="POST" action="index.php?module=groupe&action=creerGroupe">
                <div class="mb-3">
                    <label for="nom_groupe" class="form-label">Nom du Groupe</label>
                    <input type="text" class="form-control" id="nom_groupe" name="nom_groupe" required>
                </div>
                <div class="mb-3">
                    <label for="etudiants" class="form-label">Étudiants</label>
                    <select class="form-select" id="etudiants" name="etudiants[]" multiple required>
                        <?php foreach ($etudiants as $etudiant): ?>
                            <option value="<?= $etudiant['id_etudiant']; ?>">
                                <?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="form-text text-muted">Utilisez CTRL+clic pour sélectionner plusieurs étudiants.</small>
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </div>
        <?php
    }

    public function afficherNotesGroupes($notes) {
        ?>
        <div class="container mt-4">
            <h2>Notes des Groupes</h2>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Nom du Groupe</th>
                        <th>Note Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notes as $note): ?>
                        <tr>
                            <td><?= htmlspecialchars($note['nom_groupe']); ?></td>
                            <td><?= htmlspecialchars($note['moyenne_note']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
