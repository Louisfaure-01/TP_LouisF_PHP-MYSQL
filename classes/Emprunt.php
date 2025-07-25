<?php
    // Classe Emprunt
    class Emprunt {
        //Propriétés
        private $pdo;

        //Constructeur
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        //Méthodes

        //Ajouter un emprunt

        //CREATE - Ajouter un emprunt
        public function create($id_livre, $id_membre, $date_emprunt, $date_retour_prevue, $date_retour_effectif, $statut) {
            $sql = "INSERT INTO `emprunts`(`id_emprunt`, `id_livre`, `id_membre`, `date_emprunt`, `date_retour_prevue`, `date_retour_effectif`, `statut`) VALUES (null, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id_livre, $id_membre, $date_emprunt, $date_retour_prevue, $date_retour_effectif, $statut]);
        }

        //READ Récupérer tous les emprunts
        public function getAll()
        {
            $sql = "SELECT * FROM emprunts ORDER BY date_emprunt DESC";

            $stmt = $this->pdo->query($sql);

            return $stmt->fetchAll();
        }

        //DELETE - Supprimer un emprunt
        public function delete($id_emprunt) {
            $sql = "DELETE FROM emprunts WHERE id_emprunt = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id_emprunt]);
        }

        //UPDATE - Modifier un emprunt
        public function update($id_emprunt, $id_livre, $id_membre, $date_emprunt, $date_retour_prevue, $date_retour_effectif, $statut) {
            $sql = "UPDATE `emprunts` SET `id_livre`=?, `id_membre`=?, `date_emprunt`=?, `date_retour_prevue`=?, `date_retour_effectif`=?, `statut`=? WHERE id_emprunt = ?";
            $stmt = $this->pdo->prepare($sql);
            $date_retour_effectif = ($date_retour_effectif === '' || $date_retour_effectif === null) ? null : $date_retour_effectif;
            return $stmt->execute([$id_livre, $id_membre, $date_emprunt, $date_retour_prevue, $date_retour_effectif, $statut, $id_emprunt]);
        }
        //READ - Récupérer un livre par son ID
        public function getById($id_emprunt) {
            $sql = "SELECT * FROM emprunts WHERE id_emprunt = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_emprunt]);
            return $stmt->fetch();
}

    }

?>