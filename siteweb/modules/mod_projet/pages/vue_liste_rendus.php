<div class="container mt-5">
    <h1 class="text-center">Liste des rendus</h1>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Date limite</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rendus as $rendu): ?>
                <tr>
                    <td><?= htmlspecialchars($rendu['id_rendu']) ?></td>
                    <td><?= htmlspecialchars($rendu['titre']) ?></td>
                    <td><?= htmlspecialchars($rendu['description']) ?></td>
                    <td><?= htmlspecialchars($rendu['date_limite']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<?php if (!empty($message)) { ?>
        <p class="message"><?= $message ?></p>
    <?php } ?>
</div>