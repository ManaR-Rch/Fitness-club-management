<?php

class Reservation{
    private $id_reservation;
    private $id_membre;
    private $id_activite;
    private $date_reservation;
    private $status;

    public function __construct($id_reservation, $id_membre, $id_activite, $date_reservation, $status){
        $this->setId($id_reservation);
        $this->setIdMember($id_membre);
        $this->setIdActivite($id_activite);
        $this->setDateReservation($date_reservation);
        $this->setStatus($status);
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
}