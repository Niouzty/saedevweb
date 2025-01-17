<div class="container mt-5">
    <h1 class="text-center">Créer un rendu</h1>
    <form action="?module=projet&action=cree_rendu" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du rendu</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Nom du rendu" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description du rendu..." required></textarea>
        </div>
        <div class="mb-3">
            <label for="date_limite" class="form-label">Date limite</label>
            <input type="date" class="form-control" id="date_limite" name="date_limite" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Créer le rendu</button>
    </form>


<?php if (!empty($message)) { ?>
        <p class="message"><?= $message ?></p>
    <?php } ?>
</div>
