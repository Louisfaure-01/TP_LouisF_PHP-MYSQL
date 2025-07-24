<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Auteurs.php');

$auteurModel = new Auteurs($pdo);
$errors = [];

//Traitement du formulaire
    $id_auteur = $_POST['id_auteur'];

    //Gestion des erreurs
$auteurModel->delete($id_auteur);
    header('Location: ../../liste_auteurs.php?message=deleted'); //permet de rediriger à la page d'accueil après la création

?>
