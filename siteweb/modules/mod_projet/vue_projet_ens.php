<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un projet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .container h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container input, .container button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Créer un projet</h1>
        <form action="?action=enregistrerRessource" method="POST" enctype="multipart/form-data">
            <label for="titre">Titre du projet :</label>
            <input type="text" id="titre" name="titre" placeholder="Projet" required>

            <label for="fichier">Ajouter un fichier ou un lien :</label>
            <input type="file" id="fichier" name="fichier" required>

            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>
