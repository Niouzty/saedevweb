<div class="container mt-5">
    <h1 class="text-center">Liste des projets</h1>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Année</th>
                <th>Semestre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projets as $projet): ?>
                <tr>
                    <td><?= htmlspecialchars($projet['id_projet']) ?></td>
                    <td><?= htmlspecialchars($projet['nom']) ?></td>
                    <td><?= htmlspecialchars($projet['description']) ?></td>
                    <td><?= htmlspecialchars($projet['annee']) ?></td>
                    <td><?= htmlspecialchars($projet['semestre']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<?php if (!empty($message)) { ?>
        <p class="message"><?= $message ?></p>
    <?php } ?>
</div>