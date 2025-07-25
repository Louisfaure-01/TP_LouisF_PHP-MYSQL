<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Emprunt.php');

$empruntModel = new Emprunt($pdo);
$errors = [];

// Récupérer l'emprunt à modifier si on arrive sur la page (GET)
$id_emprunt = $_GET['id_emprunt'] ?? null;
$emprunt = null;
if ($id_emprunt) {
    $emprunt = $empruntModel->getById($id_emprunt);
}

//Traitement du formulaire
if ($_POST){
    $data_emprunt = [
        'id_emprunt' => $_GET['id_emprunt'] ?? '',
        'id_livre' => $_POST['id_livre'] ?? '',
        'id_membre' => $_POST['id_membre'] ?? '',
        'date_emprunt' => $_POST['date_emprunt'] ?? '',
        'date_retour_prevue' => $_POST['date_retour_prevue'] ?? '',
        'date_retour_effectif' => $_POST['date_retour_effectif'] ?? '',
        'statut' => $_POST['statut'] ?? ''
    ];

    //Validation des données
    $id_emprunt = isset($data_emprunt['id_emprunt']) && $data_emprunt['id_emprunt'] !== '' ? (int)$data_emprunt['id_emprunt'] : null;
    $id_livre = isset($data_emprunt['id_livre']) && $data_emprunt['id_livre'] !== '' ? (int)$data_emprunt['id_livre'] : null;
    $id_membre = isset($data_emprunt['id_membre']) && $data_emprunt['id_membre'] !== '' ? (int)$data_emprunt['id_membre'] : null;

    //Gestion des erreurs
    if ($id_emprunt && $id_livre && $id_membre) {
        $empruntModel->update(
            $id_emprunt,
            $id_livre,
            $id_membre,
            $data_emprunt['date_emprunt'],
            $data_emprunt['date_retour_prevue'],
            $data_emprunt['date_retour_effectif'],
            $data_emprunt['statut']
        );
        header('Location: ../../liste_emprunt.php?message=updated');
    } else {
        $errors[] = "Les champs ID Emprunt, ID Livre et ID Membre sont obligatoires et doivent être des nombres.";
    }

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un emprunt</title>
    <link rel="stylesheet" href="../../update.css">
</head>
<body>
    <h1>Modifier un emprunt</h1>
    <form method="POST">
        <div>
            <label for="id_emprunt">ID Emprunt *</label>
            <input type="number" name="id_emprunt" id="id_emprunt" value="<?php echo htmlspecialchars($emprunt['id_emprunt'] ?? ''); ?>" required>
        </div>
        <div>
            <label for="id_livre">ID Livre *</label>
            <input type="number" name="id_livre" id="id_livre" value="<?php echo htmlspecialchars($emprunt['id_livre'] ?? ''); ?>" required>
        </div>
        <div>
            <label for="id_membre">ID Membre *</label>
            <input type="number" name="id_membre" id="id_membre" value="<?php echo htmlspecialchars($emprunt['id_membre'] ?? ''); ?>" required>
        </div>
        <div>
            <label for="date_emprunt">Date d'emprunt *</label>
            <input type="date" name="date_emprunt" id="date_emprunt" value="<?php echo htmlspecialchars($emprunt['date_emprunt'] ?? ''); ?>" required>
        </div>
        <div>
            <label for="date_retour_prevue">Date de retour prévue *</label>
            <input type="date" name="date_retour_prevue" id="date_retour_prevue" value="<?php echo htmlspecialchars($emprunt['date_retour_prevue'] ?? ''); ?>" required>
        </div>
        <div>
            <label for="date_retour_effectif">Date de retour effectif *</label>
            <input type="date" name="date_retour_effectif" id="date_retour_effectif" value="<?php echo htmlspecialchars($emprunt['date_retour_effectif'] ?? ''); ?>">
        </div>
        <div>
            <label for="statut">Statut *</label>
            <select name="statut" id="statut" required>
                <option value="en_cours" <?php if ($emprunt['statut'] == 'en_cours') echo 'selected'; ?>>En cours</option>
                <option value="termine" <?php if ($emprunt['statut'] == 'termine') echo 'selected'; ?>>Terminé</option>
            </select>
        </div>


        <input type="submit" value="Modifier l'emprunt">
    </form>
    
</body>
</html>