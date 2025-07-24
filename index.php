<?php
    require_once('config/database.php');
    require_once('classes/Livre.php');

    $livreModel = new Livre($pdo);
    $livres = $livreModel->getAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($_GET['message']) && $_GET['message'] === 'updated'): ?>
    <div id="popup-success">Modification effectuée avec succès !</div>
    <?php endif; ?>

    <h1>Liste des livres</h1>
    <div class="liens-actions">
        <a href="liste_auteurs.php">Liste des auteurs</a>
        <a href="liste_membre.php">Liste des membres</a>
        <a href="pages/livres/create.php" id="ajouter-livre">Ajouter un livre</a>
        <a href="pages/membres/create_membre.php" id="ajouter-membre">Ajouter un membre</a>
        <a href="liste_emprunt.php">Liste des emprunts</a>

    </div>
    

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Date de publication</th>
                <th>Disponible</th>
                <th>Suppression</th>
                <th>Modification</th>
                <th>Information</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres as $livre): ?>
            <tr>
                <td><?php echo htmlspecialchars($livre ['id_livre']) ?> </td>
                <td><?php echo htmlspecialchars($livre ['titre']) ?> </td>
                <td><?php echo htmlspecialchars($livre ['date_publication']) ?> </td>
                <td><?php echo htmlspecialchars($livre ['disponible']) ?> </td>
                <td>
                    <form method="POST" action="pages/livres/delete.php" class="delete-form">
                        <input type="hidden" name="id_livre" value="<?php echo htmlspecialchars($livre ['id_livre']) ?>">
                        <input type="submit" value="X" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">
                    </form>
                </td>
                <td>
                    <a href="pages/livres/update.php?id_livre=<?php echo htmlspecialchars($livre ['id_livre']) ?>" id="modifier-livre">Modifier un livre</a>
                </td>
                <td>
                    <a href="pages/livres/read.php?id_livre=<?php echo htmlspecialchars($livre['id_livre']); ?>">Voir plus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (empty($livres)): ?>
        <p>Aucun livre trouvé, <a href="">Ajouter le premier livre</a></p>
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