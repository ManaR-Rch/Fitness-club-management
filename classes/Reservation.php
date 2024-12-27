<?php

require_once __DIR__.'/../database/connection.php';

class Reservation{
    private $id_reservation;
    private $id_membre;
    private $id_activite;
    private $date_reservation;
    private $status;
    private $database;

    public function __construct($id_reservation, $id_membre, $id_activite, $date_reservation, $status){
        $this->setId($id_reservation);
        $this->setIdMember($id_membre);
        $this->setIdActivite($id_activite);
        $this->setDateReservation($date_reservation);
        $this->setStatus($status);
        $database = new Connection();

    }

    //getters
    public function getId(){
        return $this->id_reservation;
    }

    public function getIdMember(){
        return $this->id_membre;
    }

    public function getIdActivite(){
        return $this->id_activite;
    }

    public function getDateReservation(){
        return $this->date_reservation;
    }

    public function getStatus(){
        return $this->status;
    }

    //setters
    public function setId($id){
        return $this->id_reservation = $id;
    }

    public function setIdMember($id_activite){
        $this->id_membre = $id_membre;
    }

    public function setIdActivite($id_activite){
        $this->id_activite = $id_activite;
    }

    public function setDateReservation($date_reservation){
        $this->date_reservation = $date_reservation;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    //methods
    public function bookActivity(){
        try{
            $db = $this->database->getConnection();
            $sql = "INSERT INTO reservation(id_membre, id_activite, date_reservation, status) VALUES(:id_membre, :id_activite, :date_reservation, :status)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_membre', $this->id_membre, PDO::PARAM_INT);
            $stmt->bindValue(':id_activite', $this->id_activite, PDO::PARAM_INT);
            $stmt->bindValue(':date_reservation', $this->date_reservation, PDO::PARAM_STR);
            $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            
            return false;
        }catch(PDOException $e){
            echo "Error : " . $e->getMessage();
            return false;
        }
    }

    public function updateReservation(){
        try{
            $db = $this->database->getConnection();
            $sql = "UPDATE reservation SET status = :status WHERE id_membre = :id_membre";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_membre', $this->id_membre, PDO::PARAM_INT);
            $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            
            return false;
        }catch(PDOException $e){
            echo "Error : " . $e->getMessage();
            return false;
        }
    }
}