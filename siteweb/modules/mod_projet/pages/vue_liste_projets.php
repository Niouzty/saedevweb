<div class="liste">
    <h1>Liste des projets</h1>
    <link rel="stylesheet" href="./public/css/style.css"> <!-- Lien vers le CSS -->
    <table>
        <thead>
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
</div>
