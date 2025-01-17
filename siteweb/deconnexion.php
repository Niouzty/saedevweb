<?php
//session_start();
if (isset($_SESSION)) {
    session_unset();
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
   
    <script>
        // Redirection après 3 secondes
        setTimeout(function() {
            window.location.href = "index.php?module=connexion";
        }, 3000);
    </script>
</head>
<body>
    <h1>Vous vous êtes déconnecté</h1>
    <p>Redirection vers la page de connexion dans quelques secondes...</p>
</body>
</html>
