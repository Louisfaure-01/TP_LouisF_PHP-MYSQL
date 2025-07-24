<?php

//Config de la connexion à la base de données
$host = 'localhost:3307';
$dbname = 'biblio';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $error) {
    
    die('Erreur de connexion à la base de données : ' . $error->getMessage());
    
}



?>