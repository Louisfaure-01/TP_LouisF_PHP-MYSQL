<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Membre.php');

$membreModel = new Membre($pdo);
$errors = [];

//Traitement du formulaire
    $id_membre = $_POST['id_membre'];

    //Gestion des erreurs
$membreModel->delete($id_membre);
    header('Location: ../../liste_membre.php?message=deleted'); //permet de rediriger à la page d'accueil après la création

?>
