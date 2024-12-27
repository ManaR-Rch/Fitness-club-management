<?php
require_once __DIR__.'/../database/connection.php';

class Activity{
    private $id_activity;
    private $titre;
    private $description;
    private $capacite;
    private $date_debut;
    private $date_fin;
    private $disponibilite;
    private $database;

    public function __construct($id_activity, $titre, $description, $capacite, $date_debut, $date_fin, $disponibilite){
        $this->setId($id_activity);
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setCapacite($capacite);
        $this->setDateDebut($date_debut);
        $this->setDateFin($date_fin);
        $this->setDisponibilite($disponibilite);
        $this->database = new Connection();
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

    //methods
    public function availableActivities(){
        try{
            $db = $this->database->getConnection();
            $sql = "SELECT * FROM activite WHERE disponibilite = 1";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Error : " . $e->getMessage();
            return null;
        }
    }
}