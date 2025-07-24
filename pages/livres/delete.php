<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Livre.php');

$livreModel = new Livre($pdo);
$errors = [];

//Traitement du formulaire
    $id_livre = $_POST['id_livre'];

    //Gestion des erreurs
$livreModel->delete($id_livre);
    header('Location: ../../index.php?message=deleted'); //permet de rediriger à la page d'accueil après la création

?>
