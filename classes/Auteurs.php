<?php
    // Classe Auteurs
    class Auteurs {
        //Propriétés
        private $pdo;

        //Constructeur
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        //Méthodes

        //Ajouter un emprunt

        //CREATE - Ajouter un auteur
        public function create($nom, $prenom, $date_naissance, $nationalite) {
            $sql = "INSERT INTO `auteurs`(`id_auteur`, `nom`, `prenom`, `date_naissance`, `nationalite`) VALUES (null, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$nom, $prenom, $date_naissance, $nationalite]);
        }

        //READ - Récupérer un auteur par son ID
        public function getAll() {
            $sql = "SELECT * FROM auteurs ORDER BY id_auteur DESC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll();
        }   

        //UPDATE - Modifier un auteur
        public function update($id_auteur, $nom, $prenom, $date_naissance, $nationalite) {
            $sql = "UPDATE auteurs SET nom = ?, prenom = ?, date_naissance = ?, nationalite = ? WHERE id_auteur = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$nom, $prenom, $date_naissance, $nationalite, $id_auteur]);
        }
        //READ - Récupérer un auteur par son ID
        public function getById($id_auteur) {
            $sql = "SELECT * FROM auteurs WHERE id_auteur = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_auteur]);
            return $stmt->fetch();
        }

        //DELETE - Supprimer un auteur
        public function delete($id_auteur) {
            $sql = "DELETE FROM auteurs WHERE id_auteur = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id_auteur]);
        }

    }

?>