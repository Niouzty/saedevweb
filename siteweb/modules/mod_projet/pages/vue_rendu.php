<div class="formulaire">
    <h1>Créer un rendu</h1>
    <link rel="stylesheet" href="./public/css/style.css"> <!-- Lien vers le CSS -->
    <form action="?module=projet&action=cree_rendu" method="POST">
        <label for="titre">Titre du rendu :</label>
        <input type="text" id="titre" name="titre" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea>

        <label for="date_limite">Date limite :</label>
        <input type="date" id="date_limite" name="date_limite" required>

        <button type="submit">Créer le rendu</button>
    </form>

    <!-- Message de succès ou erreur -->
    <?php if (!empty($message)) { ?>
        <p class="message"><?= $message ?></p>
    <?php } ?>
</div>
