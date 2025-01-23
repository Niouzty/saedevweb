<?php
// VueCreerGroupeEnseignant.php
class VueCreerGroupeEnseignant extends VueGenerique {

    public function afficherFormulaireCreerGroupe($id_projet, $etudiants) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Créer un Groupe</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <!-- Barre de navigation -->
            <?php Template::afficherNavigationEnseignant(); ?>

            <div class="container mt-5">
                <h2 class="mb-4 text-center">Créer un Nouveau Groupe</h2>

                <!-- Formulaire de création de groupe -->
                <div class="card mx-auto" style="max-width: 600px;">
                    <div class="card-body">
                        <form action="index.php?module=enseignant&action=creerGroupe" method="POST">
                            <input type="hidden" name="id_projet" value="<?= htmlspecialchars($id_projet) ?>">

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom du Groupe</label>
                                <input type="text" id="nom" name="nom" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Créer Groupe</button>
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
