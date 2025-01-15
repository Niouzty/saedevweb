<div class="liste">
    <h1>Liste des rendus</h1>
    <link rel="stylesheet" href="./public/css/style.css"> <!-- Lien vers le CSS -->
    <table>
        <thead>
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
</div>
