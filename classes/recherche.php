<?php
try {
    // Connexion
    $pdo = new PDO('mysql:host=localhost:3307;dbname=bibliotheque', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    // Requête simple
    $query = "SELECT id, Titre FROM livres ORDER BY Titre";
    $stmt = $pdo->query($query);
   
    // Récupérer tous les résultats
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
var_dump($livres); // Pour vérifier les données récupérées
 
    // Affichage
    echo "<h3>Livres dans la bibliothèque :</h3>";
    foreach ($livres as $livre) {
        echo "<p>";
        echo "<strong>" . htmlspecialchars($livres['Titre']) . "</strong><br>";
        echo "Auteur : " . htmlspecialchars($livres['auteurs']) . "<br>";
        echo "Genre : " . htmlspecialchars($livres['genres']);
        echo "</p>";
    }
   
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>