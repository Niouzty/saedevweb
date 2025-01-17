<div class="container mt-5">
    <h1 class="text-center">Créer un projet</h1>
    <form action="?module=projet&action=cree_projet" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du projet</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Nom du projet" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Décrivez le projet..." required></textarea>
        </div>
        <div class="mb-3">
            <label for="annee" class="form-label">Année</label>
            <input type="number" class="form-control" id="annee" name="annee" placeholder="2025" required>
        </div>
        <div class="mb-3">
            <label for="semestre" class="form-label">Semestre</label>
            <select class="form-select" id="semestre" name="semestre" required>
                <option value="1">Semestre 1</option>
                <option value="2">Semestre 2</option>
                <option value="3">Semestre 3</option>
                <option value="4">Semestre 4</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Créer le projet</button>
    </form>


    <!-- Message de succès ou erreur -->
    <?php if (!empty($message)) { ?>
        <p class="message"><?= $message ?></p>
    <?php } ?>
</div>
