<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Emprunt.php');

$empruntModel = new Emprunt($pdo);
$errors = [];

//Traitement du formulaire
if ($_POST){
    $id_livre = $_POST['id_livre'] ?? '';
    $date_emprunt = $_POST['date_emprunt'] ?? '';
    $date_retour_prevue = $_POST['date_retour_prevue'] ?? '';
    $date_retour_effectif = $_POST['date_retour_effectif'] ?? '';
    $statut = $_POST['statut'] ?? '';


    //Validation des données
   if (empty($id_livre) || empty($date_emprunt) || empty($date_retour_prevue)) {
       $errors[] = "Tous les champs sont obligatoires.";
   }

    //Validation des données


    //Gestion des erreurs
    $empruntModel->create($id_livre, $date_emprunt, $date_retour_prevue, $date_retour_effectif, $statut);
    header('Location: ../../liste_emprunt.php?message=created'); //permet de rediriger à la page d'accueil après la création

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un emprunt</title>
    <link rel="stylesheet" href="../../create.css">
</head>
<body>
    <h1>Ajouter un emprunt</h1>
    <form method="POST">
        <div>
            <label for="id_livre">ID Livre *</label>
            <input type="text" name="id_livre" id="id_livre" required>
        </div>
        <div>
            <label for="date_emprunt">Date d'emprunt *</label>
            <input type="date" name="date_emprunt" id="date_emprunt" required>
        </div>
        <div>
            <label for="date_retour_prevue">Date de retour prévue *</label>
            <input type="date" name="date_retour_prevue" id="date_retour_prevue" required>
        </div>
        <div>
            <label for="date_retour_effectif">Date de retour effective *</label>
            <input type="date" name="date_retour_effectif" id="date_retour_effectif" required>
        </div>
        <div>
            <label for="statut">Statut *</label>
            <select name="statut" id="statut" required>
                <option value="en_cours">En cours</option>
                <option value="termine">Terminé</option>
            </select>
        </div>
        





        <input type="submit" value="Ajouter l'emprunt'">
        <div class="form-actions">
            <input type="reset" value="Annuler">
            <a href="../../index.php">Retour à la liste</a>
        </div>
    </form>
    
</body>
</html>