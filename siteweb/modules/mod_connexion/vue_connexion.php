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
            <link rel="stylesheet" href="/public/css/style.css"> <!-- Lien vers le CSS -->
        </head>
        <body class="body-connexion">
            <div class="container">
                <img src="/public/images/logo.png" alt="Logo IUT Montreuil" class="logo">
                <div class="login-form">
                    <h1>Connexion</h1>
                    <form action="?module=connexion&action=verifier" method="POST">
                        <label for="email">Identifiant (Email):</label>
                        <input type="email" id="email" name="email" required>
                        
                        <label for="password">Mot de passe:</label>
                        <input type="password" id="password" name="password" required>
                        
                        <input type="submit" value="Connexion">
                    </form>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
}
