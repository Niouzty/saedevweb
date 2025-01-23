<?php
// Vuelisstegroupeenseignant.php
// VueListerGroupes.php
class VueListerGroupes extends VueGenerique {

    public function afficherListeGroupes($groupes, $id_projet) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des Groupes</title>
        </head>
        <body>
            <!-- Message de succès si le groupe a été créé avec succès -->
            <?php if (isset($_GET['success']) && $_GET['success'] == 'true') { ?>
                <p style="color: green;">Groupe créé avec succès !</p>
            <?php } ?>

            <h2>Liste des Groupes pour ce Projet</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom du Groupe</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groupes as $groupe) { ?>
                        <tr>
                            <td><?= htmlspecialchars($groupe['nom']) ?></td>
                            <td>
                                <a href="index.php?module=enseignant&action=afficherMembres&id_groupe=<?= htmlspecialchars($groupe['id_groupe']) ?>">Voir les Membres</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Retour à la liste des projets -->
            <form action="index.php?module=enseignant&action=afficherProjets" method="POST">
                <button type="submit">Retour aux Projets</button>
            </form>
        </body>
        </html>
        <?php
    }
}
