<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Auteurs.php');

$auteurModel = new Auteurs($pdo);
$errors = [];

//Traitement du formulaire
if ($_POST){
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $date_naissance = $_POST['date_naissance'] ?? '';
    $nationalite = $_POST['nationalite'] ?? '';

    //Validation des données


    //Gestion des erreurs
    $auteurModel->create($nom, $prenom, $date_naissance, $nationalite);
    header('Location: ../../liste_auteurs.php?message=created'); //permet de rediriger à la page d'accueil après la création

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un auteur</title>
    <link rel="stylesheet" href="../../create.css">
</head>
<body>
    <h1>Ajouter un auteur</h1>
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
            <label for="date_naissance">Date de naissance *</label>
            <input type="date" name="date_naissance" id="date_naissance" required>
        </div>
        <div>
            <label for="nationalite">Nationalité *</label>
            <input type="text" name="nationalite" id="nationalite" required>
        </div>


        <input type="submit" value="Ajouter l'auteur">
        <div class="form-actions">
            <input type="reset" value="Annuler">
            <a href="../../index.php">Retour à la liste</a>
        </div>
    </form>
    
</body>
</html>