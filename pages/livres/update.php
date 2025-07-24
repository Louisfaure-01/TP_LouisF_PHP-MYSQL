<?php 
require_once ('./../../config/database.php');
require_once ('./../../classes/Livre.php');

$livreModel = new Livre($pdo);
$errors = [];

// Récupérer le livre à modifier si on arrive sur la page (GET)
$id_livre = $_GET['id_livre'] ?? null;
$livre = null;
if ($id_livre) {
    $livre = $livreModel->getById($id_livre);
}

//Traitement du formulaire
if ($_POST){
    $data_livre = [
        'id_livre' => $_GET['id_livre'] ?? '',
        'titre' => $_POST['titre'] ?? '',
        'isbn' => $_POST['isbn'] ?? '',
        'date_publication' => $_POST['date_publication'] ?? '',
        'nb_pages' => $_POST['nb_pages'] ?? '',
        'nb_exemplaires' => $_POST['nb_exemplaires'] ?? '',
        'disponible' => $_POST['disponible'] ?? '',
        'resume' => $_POST['resume'] ?? ''
    ];

    //Validation des données


    //Gestion des erreurs
    $livreModel->update(
        $data_livre['id_livre'], 
        $data_livre['titre'], 
        $data_livre['isbn'], 
        $data_livre['date_publication'], 
        $data_livre['nb_pages'], 
        $data_livre['nb_exemplaires'], 
        $data_livre['disponible'], 
        $data_livre['resume']
    );
    header('Location: ../../index.php?message=updated'); //permet de rediriger à la page d'accueil après la création

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un livre</title>
    <link rel="stylesheet" href="../../update.css">
</head>
<body>
    <h1>Modifier un livre</h1>
    <form method="POST">
        <div>
            <label for="titre">Titre *</label>
            <input type="text" name="titre" id="titre" value="<?php echo htmlspecialchars($livre['titre']); ?>" required>
        </div>
        <div>
            <label for="isbn">ISBN *</label>
            <input type="text" name="isbn" id="isbn" value="<?php echo htmlspecialchars($livre['isbn']); ?>" required>
        </div>
        <div>
            <label for="date_publication">Date de publication *</label>
            <input type="date" name="date_publication" id="date_publication" value="<?php echo htmlspecialchars($livre['date_publication']); ?>" required>
        </div>
        <div>
            <label for="nb_pages">Nombre de pages *</label>
            <input type="text" name="nb_pages" id="nb_pages" value="<?php echo htmlspecialchars($livre['nombre_pages']); ?>" required>
        </div>
        <div>
            <label for="nb_exemplaires">Nombre d'exemplaires *</label>
            <input type="text" name="nb_exemplaires" id="nb_exemplaires" value="<?php echo htmlspecialchars($livre['nombre_exemplaires']); ?>" required>
        </div>
        <div>
            <label for="disponible">Disponible *</label>
            <select name="disponible" id="disponible" required>
                <option value="1" <?php if ($livre['disponible'] == 1) echo 'selected'; ?>>Oui</option>
                <option value="0" <?php if ($livre['disponible'] == 0) echo 'selected'; ?>>Non</option>
            </select>
        </div>
        <div>
            <label for="resume">Resumé *</label>
            <input type="text" name="resume" id="resume" value="<?php echo htmlspecialchars($livre['resume']); ?>" required>
        </div>





        <input type="submit" value="Modifier le livre">
    </form>
    
</body>
</html>