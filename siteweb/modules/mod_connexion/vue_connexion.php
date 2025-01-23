<?php

class VueConnexion extends VueGenerique {
    public function afficherFormulaire() {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Connexion</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>       
         </head>
        <body class="bg-light d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
                <div class="text-center">
                    <img src="./public/images/logo.png" alt="Logo IUT Montreuil" class="img-fluid mb-4" style="max-width: 150px;">
                </div>
                <h1 class="text-center mb-4">Connexion</h1>
                <form action="?module=connexion&action=verifier" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Identifiant (Email):</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Connexion</button>
                </form>
            </div>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </body>
        </html>
        <?php
    }
}
?>
