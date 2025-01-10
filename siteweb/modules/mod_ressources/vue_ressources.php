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
    <title>Créer un projet</title>
   <link rel="stylesheet" href="/public/css/style.css"> <!-- Lien vers le CSS -->>
</head>
<body class="body-ressource">
    <div class="ressource-container">
        <h1>Créer un projet</h1>
        <form class="ressource-form" action="?action=enregistrerRessource" method="POST" enctype="multipart/form-data">
            <label class="label-titre" for="titre-ressource">Titre du projet :</label>
            <input class="input-titre" type="text" id="titre-ressource" name="titre" placeholder="Projet" required>

            <label class="label-fichier" for="fichier-ressource">Ajouter un fichier ou un lien :</label>
            <input class="input-fichier" type="file" id="fichier-ressource" name="fichier" required>

            <button class="btn-submit" type="submit">Envoyer</button>
        </form>
    </div>
</body>


</html>
<?php
