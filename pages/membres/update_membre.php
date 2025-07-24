<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Membre.php');

$membreModel = new Membre($pdo);
$errors = [];

// Récupérer le membre à modifier si on arrive sur la page (GET)
$id_membre = $_GET['id_membre'] ?? null;
$membre = null;
if ($id_membre) {
    $membre = $membreModel->getById($id_membre);
}

//Traitement du formulaire
if ($_POST){
    $data_membre = [
        'id_membre' => $_GET['id_membre'] ?? '',
        'nom' => $_POST['nom'] ?? '',
        'prenom' => $_POST['prenom'] ?? '',
        'email' => $_POST['email'] ?? '',
        'telephone' => $_POST['telephone'] ?? '',
    ];

    //Validation des données


    //Gestion des erreurs
    $membreModel->update(
        $data_membre['id_membre'], 
        $data_membre['nom'], 
        $data_membre['prenom'], 
        $data_membre['email'], 
        $data_membre['telephone']
    );
    header('Location: ../../liste_membre.php?message=updated'); //permet de rediriger à la page d'accueil après la création

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un membre</title>
    <link rel="stylesheet" href="../../update.css">
</head>
<body>
    <h1>Modifier un membre</h1>
    <form method="POST">
        <div>
            <label for="nom">Nom *</label>
            <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($membre['nom']); ?>" required>
        </div>
        <div>
            <label for="prenom">Prénom *</label>
            <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($membre['prenom']); ?>" required>
        </div>
        <div>
            <label for="email">Email *</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($membre['email']); ?>" required>
        </div>
        <div>
            <label for="telephone">Téléphone *</label>
            <input type="text" name="telephone" id="telephone" value="<?php echo htmlspecialchars($membre['telephone']); ?>" required>
        </div>

        <input type="submit" value="Modifier le membre">
    </form>
    
</body>
</html>