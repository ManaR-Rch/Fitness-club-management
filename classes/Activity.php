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
    
}