<?php
    require_once('config/database.php');
    require_once('classes/Auteurs.php');

    $auteurModel = new Auteurs($pdo);
    $auteurs = $auteurModel->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auteurs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($_GET['message']) && $_GET['message'] === 'updated'): ?>
    <div id="popup-success">Modification effectuée avec succès !</div>
    <?php endif; ?>

    <h1>Liste des auteurs</h1>
    <div class="liens-actions">
        <a href="index.php">Liste des livres</a>
        <a href="pages/auteurs/create.php" id="ajouter-auteur">Ajouter un auteur</a>
    </div>
    

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Nationalité</th>
                <th>Date de création</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($auteurs as $auteur): ?>
            <tr>
                <td><?php echo htmlspecialchars($auteur ['id_auteur']) ?> </td>
                <td><?php echo htmlspecialchars($auteur ['nom']) ?> </td>
                <td><?php echo htmlspecialchars($auteur ['prenom']) ?> </td>
                <td><?php echo htmlspecialchars($auteur ['date_naissance']) ?> </td>
                <td><?php echo htmlspecialchars($auteur ['nationalite']) ?> </td>
                <td><?php echo htmlspecialchars($auteur ['date_creation']) ?> </td>
                <td>
                    <form method="POST" action="pages/auteurs/delete.php" class="delete-form">
                        <input type="hidden" name="id_auteur" value="<?php echo htmlspecialchars($auteur ['id_auteur']) ?>">
                        <input type="submit" value="X" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet auteur ?');">
                    </form>
                </td>
                <td>
                    <a href="pages/auteurs/update.php?id_auteur=<?php echo htmlspecialchars($auteur ['id_auteur']) ?>" id="modifier-auteur">Modifier un auteur</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (empty($auteurs)): ?>
        <p>Aucun auteur trouvé, <a href="">Ajouter le premier auteur</a></p>
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