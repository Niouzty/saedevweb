<div class="container">
    <h1>Créer des groupes</h1>
    <form action="?module=projet&action=enregistrerGroupes" method="POST">
        <label for="nombre_groupes">Nombre de groupes :</label>
        <input type="number" id="nombre_groupes" name="nombre_groupes" min="1" required>

        <button type="submit">Créer les groupes</button>
    </form>
</div>
