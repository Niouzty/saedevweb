<!DOCTYPE html>
<html>
<head>
    <title>Statistiques des étudiants</title>
</head>
<body>
    <h1>Statistiques des étudiants</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Matière</th>
                <th>Moyenne</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statistiques as $stat): ?>
                <tr>
                    <td><?= htmlspecialchars($stat['nom']) ?></td>
                    <td><?= htmlspecialchars($stat['prenom']) ?></td>
                    <td><?= htmlspecialchars($stat['matiere']) ?></td>
                    <td><?= number_format($stat['moyenne'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
