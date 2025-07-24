<?php
require_once('../../config/database.php');
require_once('../../classes/Livre.php');

$livreModel = new Livre($pdo);

// Récupérer l'ID du livre depuis l'URL
$id_livre = $_GET['id_livre'] ?? null;
$livre = null;
if ($id_livre) {
    $livre = $livreModel->getById($id_livre);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du livre</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <h1>Détail du livre</h1>
    <div class="liens-actions">
        <a href="../../index.php">Retour à la liste</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>ISBN</th>
                <th>Date de publication</th>
                <th>Nombre de pages</th>
                <th>Nombre d'exemplaires</th>
                <th>Disponible</th>
                <th>Résumé</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($livre): ?>
            <tr>
                <td><?php echo htmlspecialchars($livre['id_livre']); ?></td>
                <td><?php echo htmlspecialchars($livre['titre']); ?></td>
                <td><?php echo htmlspecialchars($livre['isbn']); ?></td>
                <td><?php echo htmlspecialchars($livre['date_publication']); ?></td>
                <td><?php echo htmlspecialchars($livre['nombre_pages']); ?></td>
                <td><?php echo htmlspecialchars($livre['nombre_exemplaires']); ?></td>
                <td><?php echo $livre['disponible'] ? 'Oui' : 'Non'; ?></td>
                <td><?php echo htmlspecialchars($livre['resume']); ?></td>
            </tr>
            <?php else: ?>
                <tr>
                    <td colspan="8">Livre non trouvé.</td>
                </tr>
                <a href="../../index.php">Retour à la liste</a>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>