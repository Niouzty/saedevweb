<?php

class VueEtudiant extends VueGenerique {
  public function afficherPageAcceuil() {
        ?>
        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Étudiant</title>
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .highlight {
            background-color: #f8d7da; /* Couleur de fond pour les moments spéciaux */
        }
        .emploi-du-temps h1, .emploi-du-temps h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <?php
        Template::afficherNavigationEtudiant(); // Appel de la méthode pour afficher la navigation
    ?>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <div class="emploi-du-temps">
            <h1>Accueil Étudiant</h1>
            <h2>Jeudi 19 décembre 2024</h2>
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Horaire</th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8 h 30 - 8 h 45</td>
                        <td colspan="5" class="highlight">Installation - Informations diverses</td>
                    </tr>
                    <tr>
                        <td>8 h 45 - 10 h 15</td>
                        <td>Écriture</td>
                        <td>Étude de la langue</td>
                        <td>Étude de la langue</td>
                        <td>Expression orale</td>
                        <td>Lecture</td>
                    </tr>
                    <tr>
                        <td>10 h 15 - 10 h 30</td>
                        <td colspan="5" class="highlight">Récréation</td>
                    </tr>
                    <tr>
                        <td>10 h 30 - 11 h 30</td>
                        <td>EPS</td>
                        <td>Arts</td>
                        <td>Anglais</td>
                        <td>Mathématiques</td>
                        <td>Mathématiques</td>
                    </tr>
                    <tr>
                        <td>11 h 30 - 13 h 30</td>
                        <td colspan="5" class="highlight">Cantine - Récréation - Aide personnalisée</td>
                    </tr>
                    <tr>
                        <td>13 h 30 - 14 h 15</td>
                        <td>Calcul mental</td>
                        <td>Écriture</td>
                        <td colspan="3">Questionner le monde : sciences</td>
                    </tr>
                    <tr>
                        <td>14 h 15 - 15 h 15</td>
                        <td>Questionner le monde : le temps</td>
                        <td>Mathématiques</td>
                        <td>Récréation</td>
                        <td>Mathématiques</td>
                        <td>Calcul mental</td>
                    </tr>
                    <tr>
                        <td>15 h 15 - 15 h 30</td>
                        <td colspan="5" class="highlight">Récréation</td>
                    </tr>
                    <tr>
                        <td>15 h 30 - 16 h 30</td>
                        <td>Anglais</td>
                        <td>Activités périscolaires</td>
                        <td></td>
                        <td>EPS</td>
                        <td>Activités périscolaires</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
        <?php
  }
}
