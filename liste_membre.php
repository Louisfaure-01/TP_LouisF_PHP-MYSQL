<?php
    require_once('config/database.php');
    require_once('classes/Membre.php');

    $membreModel = new Membre($pdo);
    $membres = $membreModel->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($_GET['message']) && $_GET['message'] === 'updated'): ?>
    <div id="popup-success">Modification effectuée avec succès !</div>
    <?php endif; ?>

    <h1>Liste des membres</h1>
    <div class="liens-actions">
        <a href="index.php">Liste des livres</a>
        <a href="pages/membres/create_membre.php" id="ajouter-membre">Ajouter un membre</a>
    </div>
    

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Suppression</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($membres as $membre): ?>
            <tr>
                <td><?php echo htmlspecialchars($membre ['id_membre']) ?> </td>
                <td><?php echo htmlspecialchars($membre ['nom']) ?> </td>
                <td><?php echo htmlspecialchars($membre ['prenom']) ?> </td>
                <td><?php echo htmlspecialchars($membre ['email']) ?> </td>
                <td><?php echo htmlspecialchars($membre ['telephone']) ?> </td>
                <td>
                    <form method="POST" action="pages/membres/delete_membre.php" class="delete-form">
                        <input type="hidden" name="id_membre" value="<?php echo htmlspecialchars($membre ['id_membre']) ?>">
                        <input type="submit" value="X" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');">
                    </form>
                </td>
                <td>
                    <a href="pages/membres/update_membre.php?id_membre=<?php echo htmlspecialchars($membre ['id_membre']) ?>" id="modifier-membre">Modifier un membre</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (empty($membres)): ?>
        <p>Aucun membre trouvé, <a href="">Ajouter le premier membre</a></p>
    <?php endif; ?>

    <script>
    window.addEventListener('DOMContentLoaded', function() {
        var popup = document.getElementById('popup-success');
        if (popup) {
            setTimeout(function() {
                popup.classList.add('show');
        }, 100); // Apparition douce

        setTimeout(function() {
    popup.classList.remove('show');
    // Supprime le paramètre ?message=updated de l'URL
    if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('message');
        window.history.replaceState({}, document.title, url.pathname + url.search);
    }
    }, 2600); // Disparition après 2,5s
    }
});
</script>
    
</body>
</html>