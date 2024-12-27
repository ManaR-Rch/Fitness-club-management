<?php

class Activity{
    private $id_activity;
    private $titre;
    private $description;
    private $capacite;
    private $date_debut;
    private $date_fin;
    private $disponibilite;

    public function __construct($id_activity, $titre, $description, $capacite, $date_debut, $date_fin, $disponibilite){
        $this->setId($id_activity);
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setCapacite($capacite);
        $this->setDateDebut($date_debut);
        $this->setDateFin($date_fin);
        $this->setDisponibilite($disponibilite);
    }

    //getters
    public function getId(){
        return $this->id_activite;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getCapacite(){
        return $this->capacite;
    }

    public function getDateDebut(){
        return $this->date_debut;
    }

    public function getDateFin(){
        return $this->date_fin;
    }

    public function getDisponibilite(){
        return $this->disponibilite;
    }

    //setters
    public function setId($id){
        $this->id_activite = $id;
    }

    public function setTitre($titre){
        $this->titre = $titre;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setCapacite($capacite){
        $this->capacite = $capacite;
    }

    public function setDateDebut($date_debut){
        $this->date_debut = $date_debut;
    }

    public function setDateFin($date_fin){
        $this->date_fin = $date_fin;
    }

    public function setDisponibilite($disponibilite){
        $this->disponibilite = $disponibilite;
    }

    public function AjouterActivite() {
        try {
    
            $stmt = $this->pdo->prepare("INSERT INTO activite (titre, description, capacite, date_debut, date_fin, disponibilite) VALUES (:titre, :description, :capacite, :date_debut, :date_fin, :disponibilite)");
            $stmt->bindParam(':titre', $this->titre, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':capacite', $this->capacite, PDO::PARAM_INT); 
            $stmt->bindParam(':date_debut', $this->date_debut, PDO::PARAM_STR);
            $stmt->bindParam(':date_fin', $this->date_fin, PDO::PARAM_STR);
            $stmt->bindParam(':disponibilite', $this->disponibilite, PDO::PARAM_INT);
            $stmt->execute();
            echo "Activité ajoutée avec succès !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function SupprimerActivite() {

        try {

            $stmt = $this->pdo->prepare("DELETE FROM activite WHERE id_activite = :id_activite");
            $stmt->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                echo "L'activité avec l'ID $id a été supprimée avec succès.";
            } else {
                echo "Aucune activité trouvée avec l'ID $id_activite.";
            }
        } catch (PDOException $e) {

            echo "Erreur : " . $e->getMessage();
        }
    }
    

    public function ModifierActivite() {
        try {

             $stmt = $this->pdo->prepare("
                UPDATE activite 
                SET 
                    titre = :titre,
                    description = :description,
                    capacite = :capacite,
                    date_debut = :date_debut,
                    date_fin = :date_fin,
                    disponibilite = :disponibilite
                WHERE 
                    id_activite = :id_activite
            ");
    
            $stmt->bindParam(':id', $this->id_activity, PDO::PARAM_INT);
            $stmt->bindParam(':titre', $$this->titre, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':capacite', $this->capacite, PDO::PARAM_INT);
            $stmt->bindParam(':date_debut', $this->date_debut, PDO::PARAM_STR);
            $stmt->bindParam(':date_fin',$this->date_fin, PDO::PARAM_STR);
            $stmt->bindParam(':disponibilite',$this->disponibilite, PDO::PARAM_INT);
    
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
    

    public function ConsulterActivitesReservees() {
        try {
           
            $stmt = $this->pdo->prepare("
                SELECT 
                    Reservation.id_reservation,
                    Reservation.date_reservation,
                    Reservation.status,
                    Activite.id_activite,
                    Activite.titre,
                    Activite.description,
                    Activite.date_debut,
                    Activite.date_fin,
                    User.id_user AS id_membre,
                    User.nom AS nom_membre,
                    User.prenom AS prenom_membre,
                    User.email AS email_membre
                FROM 
                    Reservation
                INNER JOIN 
                    Activite ON Reservation.id_activite = Activite.id_activite
                INNER JOIN 
                    User ON Reservation.id_membre = User.id_user
                ORDER BY 
                    Reservation.date_reservation DESC
            ");
    
            $stmt->execute();
    
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if (count($resultats) > 0) {
                return $resultats;
            } else {
                echo "Aucune réservation trouvée pour le moment.";
                return [];
            }
        } catch (PDOException $e) {

            echo "Erreur lors de la récupération des activités réservées : " . $e->getMessage();
        }
    }
    
    
}