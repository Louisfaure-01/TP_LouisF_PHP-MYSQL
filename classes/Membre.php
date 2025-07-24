<?php
    // Classe Membre
    class Membre {
        //Propriétés
        private $pdo;

        //Constructeur
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        //Méthodes

        //Ajouter un emprunt

        //CREATE - Ajouter un membre
        public function create($nom, $prenom, $email, $telephone) {
            $sql = "INSERT INTO `membres`(`id_membre`, `nom`, `prenom`, `email`, `telephone`) VALUES (null, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$nom, $prenom, $email, $telephone]);
        }

        //READ - Récupérer un membre par son ID
        public function getAll() {
            $sql = "SELECT * FROM membres ORDER BY id_membre DESC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll();
        }   

        //UPDATE - Modifier un membre
        public function update($id_membre, $nom, $prenom, $email, $telephone) {
            $sql = "UPDATE membres SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id_membre = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$nom, $prenom, $email, $telephone, $id_membre]);
        }
        //READ - Récupérer un membre par son ID
        public function getById($id_membre) {
            $sql = "SELECT * FROM membres WHERE id_membre = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_membre]);
            return $stmt->fetch();
        }

        //DELETE - Supprimer un membre

        public function delete($id_membre) {
            $sql = "DELETE FROM membres WHERE id_membre = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id_membre]);
        }

    }

?>