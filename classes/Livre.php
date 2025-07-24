<?php
    // Classe Livre
    class Livre {
        //Propriétés
        private $pdo;

        //Constructeur
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        //Méthodes

        //Ajouter un livre

        //CREATE - Ajouter un livre
        public function create($titre, $isbn, $date_publication, $nombre_pages, $nombre_exemplaires, $disponible, $resume) {
            $sql = "INSERT INTO `livres`(`id_livre`, `titre`, `isbn`, `id_auteur`, `id_categorie`, `date_publication`, `nombre_pages`, `nombre_exemplaires`, `disponible`, `resume`, `date_ajout`) VALUES (null, ?,?, null, null , ?,?, ?, ?,?,NOW())";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([ $titre, $isbn, $date_publication, $nombre_pages, $nombre_exemplaires, $disponible, $resume]);
        }

        //DELETE - Supprimer un livre

        public function delete($id_livre) {
            $sql = "DELETE FROM livres WHERE id_livre = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id_livre]);
        }

        //UPDATE - Modifier un livre
        public function update($id_livre, $titre, $isbn, $date_publication, $nombre_pages, $nombre_exemplaires, $disponible, $resume) {
            $sql = "UPDATE livres SET titre = ?, isbn = ?, date_publication = ?, nombre_pages = ?, nombre_exemplaires = ?, disponible = ?, resume = ? WHERE id_livre = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$titre, $isbn, $date_publication, $nombre_pages, $nombre_exemplaires, $disponible, $resume, $id_livre]);
        }
        //READ - Récupérer un livre par son ID
        public function getById($id_livre) {
            $sql = "SELECT * FROM livres WHERE id_livre = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_livre]);
            return $stmt->fetch();
        }

        //READ Récupérer tous les livres
        public function getAll()
        {
            $sql = "SELECT * FROM livres ORDER BY date_publication DESC";

            $stmt = $this->pdo->query($sql);

            return $stmt->fetchAll();
        }

    }

?>