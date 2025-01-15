<?php
class VueProjet extends VueGenerique{
    public function afficherProjets($projets) {
        ?>
        <div class="projets-container">
            <h1>Liste des Projets</h1>
            <ul>
                <?php foreach ($projets as $projet): ?>
                    <li>
                        <a href="?module=projet&action=rendus&projet_id=<?= $projet['id_projet']; ?>">
                            <?= htmlspecialchars($projet['nom']); ?>
                        </a>
                        <p><?= htmlspecialchars($projet['description']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }

    public function afficherRendus($rendus, $projetId) {
        ?>
        <div class="rendus-container">
            <h1>Rendus pour le projet</h1>
            <ul>
                <?php foreach ($rendus as $rendu): ?>
                    <li>
                        <a href="<?= $rendu['chemin_fichier']; ?>" target="_blank">Fichier rendu</a>
                        <span>Déposé par utilisateur <?= $rendu['id_utilisateur']; ?> le <?= $rendu['date_depot']; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h2>Déposer un rendu</h2>
            <form method="POST" enctype="multipart/form-data" action="?module=projet&action=deposer">
                <input type="hidden" name="projet_id" value="<?= $projetId; ?>">
                <input type="file" name="fichier" required>
                <button type="submit">Déposer</button>
            </form>
        </div>
        <?php
    }
}

