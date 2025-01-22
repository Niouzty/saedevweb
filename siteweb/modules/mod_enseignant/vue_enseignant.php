<?php
class VueEnseignant extends VueGenerique {
    public function afficherPageAcceuil() {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Tableau de Bord - Enseignant</title>
            <!-- Inclure Bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        </head>
        <body>
            <!-- En-tête -->
            <header class="bg-primary text-white text-center py-4">
                <div class="container">
                    <h1 class="display-5">Bienvenue, Professeur <span class="fw-bold">[Nom de l'enseignant]</span></h1>
                    <div class="mt-3 d-flex justify-content-center align-items-center">
                        <img src="path/to/profile-image.jpg" alt="Photo de profil" class="rounded-circle me-3" style="width: 60px; height: 60px;">
                        <span class="fs-5">Nom de l'enseignant</span>
                    </div>
                </div>
            </header>

            <!-- Conteneur principal -->
            <div class="container mt-5">

                <!-- Actions rapides -->
                <section class="text-center">
                    <h2 class="mb-4">Actions rapides</h2>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-3">
                            <a href="index.php?module=enseignant&action=afficherGroupes" class="btn btn-outline-primary btn-lg w-100 py-3">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <br>Accéder aux Groupes
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="index.php?module=projet_enseignant&action=projets" class="btn btn-outline-primary btn-lg w-100 py-3">
                                <i class="fas fa-project-diagram fa-2x mb-2"></i>
                                <br>Accéder aux Projets
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="index.php?module=messagerie&action=conversations" class="btn btn-outline-primary btn-lg w-100 py-3">
                                <i class="fas fa-envelope fa-2x mb-2"></i>
                                <br>Accéder à la Messagerie
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="index.php?module=ressources&action=afficher" class="btn btn-outline-primary btn-lg w-100 py-3">
                                <i class="fas fa-book fa-2x mb-2"></i>
                                <br>Accéder aux Ressources
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="index.php?module=enseignant&action=afficherEmploiDuTemps" class="btn btn-outline-primary btn-lg w-100 py-3">
                                <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                <br>Accéder à l'Emploi du Temps
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Informations supplémentaires -->
                <section class="mt-5 text-center">
                    <h2 class="mb-3">Informations supplémentaires</h2>
                    <p class="fs-5">
                        Utilisez les sections ci-dessus pour accéder rapidement à vos outils et gérer vos responsabilités académiques.
                        Chaque lien mène à une fonctionnalité dédiée.
                    </p>
                    <p class="fs-5">
                        Vous pouvez consulter vos projets, gérer les groupes, communiquer avec vos étudiants et accéder à vos ressources pédagogiques en toute simplicité.
                    </p>
                </section>

            </div>

            <!-- Pied de page -->
            <footer class="bg-light text-center py-3 mt-5">
                <p class="mb-0">&copy; 2025 Votre École - Tous droits réservés</p>
            </footer>
        </body>
        </html>
        <?php
    }
}
?>
