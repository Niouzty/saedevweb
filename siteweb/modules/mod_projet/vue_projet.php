<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .navbar {
            background-color: #007BFF;
            padding: 10px;
            display: flex;
            justify-content: space-around;
            color: white;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px;
        }
        .navbar a:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }
        .container {
            padding: 20px;
        }
        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <div class="navbar">
        <a href="index.php?module=projet&action=afficher">Créer un projet</a>
        <a href="index.php?module=projet&action=listerEtudiants">Liste des étudiants</a>
        <a href="index.php?module=projet&action=afficherStatistiques">Statistiques des étudiants</a>
        <a href="index.php?module=projet&action=creerGroupes">Créer des groupes</a>
    </div>

    <div class="container">
        <?php if (!empty($message)) { ?>
            <div class="success-message"><?= htmlspecialchars($message) ?></div>
        <?php } ?>

        <h1>Créer un projet</h1>
        <form action="?module=projet&action=enregistrerRessource" method="POST" enctype="multipart/form-data">
            <label for="titre">Titre du projet :</label>
            <input type="text" id="titre" name="titre" placeholder="Projet" required>

            <label for="description">Description/Consignes :</label>
            <textarea id="description" name="description" rows="4" placeholder="Décrivez le projet..." required></textarea>

            <label for="annee">Année :</label>
            <input type="number" id="annee" name="annee" min="2000" max="2100" required>

            <label for="semestre">Semestre :</label>
            <select id="semestre" name="semestre" required>
                <option value="1">Semestre 1</option>
                <option value="2">Semestre 2</option>
                <option value="3">Semestre 3</option>
                <option value="4">Semestre 4</option>
            </select>

            <label for="fichier">Ajouter un fichier ou un lien :</label>
            <input type="file" id="fichier" name="fichier">

            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>

<?php

