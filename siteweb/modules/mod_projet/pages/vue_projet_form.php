<div class="formulaire">
    <h1>Créer un projet</h1>
    <link rel="stylesheet" href="./public/css/style.css"> <!-- Lien vers le CSS -->
    <form action="?module=projet&action=cree_projet" method="POST">
        <label for="titre">Titre du projet :</label>
        <input type="text" id="titre" name="titre" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea>

        <label for="annee">Année :</label>
        <input type="number" id="annee" name="annee" required>

        <label for="semestre">Semestre :</label>
        <select id="semestre" name="semestre" required>
            <option value="1">Semestre 1</option>
            <option value="2">Semestre 2</option>
            <option value="3">Semestre 3</option>
            <option value="4">Semestre 4</option>
        </select>

        <button type="submit">Créer le projet</button>
    </form>

    <!-- Message de succès ou erreur -->
    <?php if (!empty($message)) { ?>
        <p class="message"><?= $message ?></p>
    <?php } ?>
</div>
