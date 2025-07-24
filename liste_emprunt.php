<?php
    require_once('config/database.php');
    require_once('classes/Emprunt.php');

    $empruntModel = new Emprunt($pdo);
    $emprunts = $empruntModel->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($_GET['message']) && $_GET['message'] === 'updated'): ?>
    <div id="popup-success">Modification effectuée avec succès !</div>
    <?php endif; ?>

    <h1>Liste des emprunts</h1>
    <div class="liens-actions">
        <a href="liste_auteurs.php">Liste des auteurs</a>
        <a href="liste_membre.php">Liste des membres</a>
        <a href="pages/livres/create.php" id="ajouter-livre">Ajouter un livre</a>
        <a href="pages/membres/create_membre.php" id="ajouter-membre">Ajouter un membre</a>

    </div>
    

    <table>
        <thead>
            <tr>
                <th>ID Emprunt</th>
                <th>ID Livre</th>
                <th>ID Membre</th>
                <th>Date d'emprunt</th>
                <th>Date de retour prévue</th>
                <th>Date de retour effective</th>
                <th>Suppression</th>
                <th>Modification</th>
                <th>Information</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emprunts as $emprunt): ?>
            <tr>
                <td><?php echo htmlspecialchars($emprunt ['id_emprunt']) ?> </td>
                <td><?php echo htmlspecialchars($emprunt ['id_livre']) ?> </td>
                <td><?php echo htmlspecialchars($emprunt ['id_membre']) ?> </td>
                <td><?php echo htmlspecialchars($emprunt ['date_emprunt']) ?> </td>
                <td><?php echo htmlspecialchars($emprunt ['date_retour_prevue']) ?> </td>
                <td><?php echo htmlspecialchars($emprunt ['date_retour_effectif'] ?? '');  ?> </td>
                <td>
                <td>
                    <form method="POST" action="pages/emprunts/delete.php" class="delete-form">
                        <input type="hidden" name="id_emprunt" value="<?php echo htmlspecialchars($emprunt ['id_emprunt']) ?>">
                        <input type="submit" value="X" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet emprunt ?');">
                    </form>
                </td>
                <td>
                    <a href="pages/emprunts/update.php?id_emprunt=<?php echo htmlspecialchars($emprunt ['id_emprunt']) ?>" id="modifier-emprunt">Modifier un emprunt</a>
                </td>
                <td>
                    <a href="pages/emprunts/read.php?id_emprunt=<?php echo htmlspecialchars($emprunt['id_emprunt']); ?>">Voir plus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

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