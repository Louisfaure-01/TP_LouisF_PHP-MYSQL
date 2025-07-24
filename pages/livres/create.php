<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Livre.php');

$livreModel = new Livre($pdo);
$errors = [];

//Traitement du formulaire
if ($_POST){
    $titre = $_POST['titre'] ?? '';
    $isbn = $_POST['isbn'] ?? '';
    $date_publication = $_POST['date_publication'] ?? '';
    $nb_pages = $_POST['nb_pages'] ?? '';
    $nb_exemplaires = $_POST['nb_exemplaires'] ?? '';
    $disponible = $_POST['disponible'] ?? '';
    $resume = $_POST['resume'] ?? '';

    //Validation des données


    //Gestion des erreurs
    $livreModel->create($titre, $isbn, $date_publication, $nb_pages, $nb_exemplaires, $disponible, $resume);
    header('Location: ../../index.php?message=created'); //permetd de rediriger à la page d'accueil après la création

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un livre</title>
    <link rel="stylesheet" href="../../create.css">
</head>
<body>
    <h1>Ajouter un livre</h1>
    <form method="POST">
        <div>
            <label for="titre">Titre *</label>
            <input type="text" name="titre" id="titre" required>
        </div>
        <div>
            <label for="isbn">ISBN *</label>
            <input type="text" name="isbn" id="isbn" required>
        </div>
        <div>
            <label for="date_publication">Date de publication *</label>
            <input type="date" name="date_publication" id="date_publication" required>
        </div>
        <div>
            <label for="nb_pages">Nombre de pages *</label>
            <input type="text" name="nb_pages" id="nb_pages" required>
        </div>
        <div>
            <label for="nb_exemplaires">Nombre d'exemplaires *</label>
            <input type="text" name="nb_exemplaires" id="nb_exemplaires" required>
        </div>
        <div>
            <label for="disponible">Disponible *</label>
            <select name="disponible" id="disponible" required>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
        <div>
            <label for="resume">Resumé *</label>
            <input type="text" name="resume" id="resume" required>
        </div>





        <input type="submit" value="Ajouter le livre">
        <div class="form-actions">
            <input type="reset" value="Annuler">
            <a href="../../index.php">Retour à la liste</a>
        </div>
    </form>
    
</body>
</html>