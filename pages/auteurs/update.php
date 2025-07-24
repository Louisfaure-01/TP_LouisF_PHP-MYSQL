<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Auteurs.php');

$auteurModel = new Auteurs($pdo);
$errors = [];

// Récupérer l'auteur à modifier si on arrive sur la page (GET)
$id_auteur = $_GET['id_auteur'] ?? null;
$auteur = null;
if ($id_auteur) {
    $auteur = $auteurModel->getById($id_auteur);
}

//Traitement du formulaire
if ($_POST){
    $data_auteur = [
        'id_auteur' => $_GET['id_auteur'] ?? '',
        'nom' => $_POST['nom'] ?? '',
        'prenom' => $_POST['prenom'] ?? '',
        'date_naissance' => $_POST['date_naissance'] ?? '',
        'nationalite' => $_POST['nationalite'] ?? '',
    ];

    //Validation des données


    //Gestion des erreurs
    $auteurModel->update(
        $data_auteur['id_auteur'], 
        $data_auteur['nom'], 
        $data_auteur['prenom'], 
        $data_auteur['date_naissance'], 
        $data_auteur['nationalite']
    );
    header('Location: ../../index.php?message=updated'); //permet de rediriger à la page d'accueil après la création

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un auteur</title>
    <link rel="stylesheet" href="../../create.css">
    <link rel="stylesheet" href="../../update.css">
</head>
<body>
    <h1>Modifier un auteur</h1>
    <form method="POST">
        <div>
            <label for="nom">Nom *</label>
            <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($auteur['nom']); ?>" required>
        </div>
        <div>
            <label for="prenom">Prénom *</label>
            <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($auteur['prenom']); ?>" required>
        </div>
        <div>
            <label for="date_naissance">Date de naissance *</label>
            <input type="date" name="date_naissance" id="date_naissance" value="<?php echo htmlspecialchars($auteur['date_naissance']); ?>" required>
        </div>
        <div>
            <label for="nationalite">Nationalité *</label>
            <input type="text" name="nationalite" id="nationalite" value="<?php echo htmlspecialchars($auteur['nationalite']); ?>" required>
        </div>

        <input type="submit" value="Modifier l'auteur">
        <div class="form-actions">
            <a href="../../liste_auteurs.php">Retour à la liste</a>
        </div>
    </form>

</body>
</html>
