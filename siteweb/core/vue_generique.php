<?php
class VueGenerique {
    public function afficherPageAccueil() {

      
        // Appel des méthodes pour afficher l'en-tête et le pied de page
        Template::afficherEnTete("Moodle");
        ?>

        <main class='home-main-content'>
            <section id="infos" class='home-infos-section'>
                <h2 class='home-section-title'>Pourquoi utiliser cette plateforme ?</h2>
                <ul class='home-info-list'>
                    <li class='home-info-item'>Suivi des projets simplifié</li>
                    <li class='home-info-item'>Communication fluide entre étudiants et enseignants</li>
                    <li class='home-info-item'>Outils collaboratifs intégrés</li>
                </ul>
            </section>
        </main>

        <?php
        Template::afficherPiedDePage();
       


    }

    public function afficherPageErreur($message = "Une erreur est survenue.") {
        Template::afficherEnTete("Erreur");
        echo "<main>
    <h2>Erreur</h2>
    <p>{$message}</p>
</main>";
        Template::afficherPiedDePage();
    }
}
?>

