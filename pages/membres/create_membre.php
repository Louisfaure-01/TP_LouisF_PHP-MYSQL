<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Membre.php');

$membreModel = new Membre($pdo);
$errors = [];

//Traitement du formulaire
if ($_POST){
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';

    //Validation des données


    //Gestion des erreurs
    $membreModel->create($nom, $prenom, $email, $telephone);
    header('Location: ../../index.php?message=created'); //permet de rediriger à la page d'accueil après la création


    //Validation des données


    //Gestion des erreurs
    $membreModel->create($nom, $prenom, $email, $telephone);
    header('Location: ../../index.php?message=created'); //permet de rediriger à la page d'accueil après la création

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un membre</title>
    <link rel="stylesheet" href="../../create.css">
</head>
<body>
    <h1>Ajouter un membre</h1>
    <form method="POST">
        <div>
            <label for="nom">Nom *</label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom *</label>
            <input type="text" name="prenom" id="prenom" required>
        </div>
        <div>
            <label for="email">Email *</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="telephone">Téléphone *</label>
            <input type="text" name="telephone" id="telephone" required>
        </div>

        <input type="submit" value="Ajouter le membre">
        <div class="form-actions">
            <input type="reset" value="Annuler">
            <a href="../../index.php">Retour à la liste</a>
        </div>
    </form>
    
</body>
</html>