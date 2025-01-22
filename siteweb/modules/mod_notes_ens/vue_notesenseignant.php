<?php
class VueNoteEnseignant extends VueGenerique {

    // Afficher les notes par étudiant
    public function afficherNotesParEtudiant($notes, $etudiant) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Notes de l'Étudiant</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <?php Template::afficherNavigationEnseignant(); ?>
    
            <div class="container mt-5">
                <h2 class="mb-4">Notes de <?= htmlspecialchars($etudiant['prenom'] . " " . $etudiant['nom']) ?></h2>
                
                <?php if (empty($notes)): ?>
                    <div class="alert alert-warning" role="alert">
                        Cet étudiant n'a aucune note enregistrée.
                    </div>
                <?php else: ?>
                    <table class="table table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>Projet</th>
                                <th>Rendu</th>
                                <th>Type</th>
                                <th>Note</th>
                                <th>Coefficient</th>
                                <th>Commentaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notes as $note): ?>
                                <tr>
                                    <td><?= htmlspecialchars($note['projet']) ?></td>
                                    <td><?= htmlspecialchars($note['id_rendu']) ?></td>
                                    <td><?= htmlspecialchars($note['type_eval']) ?></td>
                                    <td><?= htmlspecialchars($note['note']) ?></td>
                                    <td><?= htmlspecialchars($note['coefficient']) ?></td>
                                    <td><?= htmlspecialchars($note['commentaire']) ?></td>
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
    

    // Afficher le formulaire pour créer une note
    public function afficherFormulaireCreationNote($rendus) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Créer une Note</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <?php Template::afficherNavigationEnseignant(); ?>
    
            <div class="container mt-5">
                <h2 class="mb-4">Créer une Note</h2>
    
                <div class="card mx-auto" style="max-width: 600px;">
                    <div class="card-body">
                        <form action="index.php?module=enseignant&action=creerNote" method="POST">
                            <div class="mb-3">
                                <label for="id_rendu" class="form-label">Rendu</label>
                                <select id="id_rendu" name="id_rendu" class="form-select" required>
                                    <?php foreach ($rendus as $rendu): ?>
                                        <option value="<?= htmlspecialchars($rendu['id_rendu']) ?>">
                                            Rendu ID: <?= htmlspecialchars($rendu['id_rendu']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <input type="number" id="note" name="note" class="form-control" step="0.01" required>
                            </div>
    
                            <div class="mb-3">
                                <label for="type_eval" class="form-label">Type d'Évaluation</label>
                                <input type="text" id="type_eval" name="type_eval" class="form-control" required>
                            </div>
    
                            <div class="mb-3">
                                <label for="coefficient" class="form-label">Coefficient</label>
                                <input type="number" id="coefficient" name="coefficient" class="form-control" step="0.01" required>
                            </div>
    
                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Commentaire</label>
                                <textarea id="commentaire" name="commentaire" class="form-control" rows="4"></textarea>
                            </div>
    
                            <button type="submit" class="btn btn-primary w-100">Créer la Note</button>
                        </form>
                    </div>
                </div>
            </div>
    
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
    
}
?>
