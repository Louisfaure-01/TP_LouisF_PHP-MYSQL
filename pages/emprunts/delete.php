<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Emprunt.php');

$empruntModel = new Emprunt($pdo);
$errors = [];

//Traitement du formulaire
    $id_emprunt = $_POST['id_emprunt'];

    //Gestion des erreurs
$empruntModel->delete($id_emprunt);
    header('Location: ../../liste_emprunt.php?message=deleted'); //permet de rediriger à la page d'accueil après la création

?>
