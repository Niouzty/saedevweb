<?php
class VueGenerique {
    public function afficherPageAccueil() {
        Template::afficherEnTete("Page d'accueil");
        echo "<main>
    <h2>Bienvenue sur la page d'accueil</h2>
    <p>Ceci est un exemple de contenu de page.</p>
</main>";
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

