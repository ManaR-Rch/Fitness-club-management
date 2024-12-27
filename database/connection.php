<?php

class Connection {  
   private $bd;
   private $host; 
   private $user;      
   private $password;  
   private $pdo;

   public function __construct(){
    try {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->db = "gestionreservation";

        $this->pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->password);
        
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error : " . $e->getMessage();
    }
   }
    public function getConnection(){
        return $this->pdo;
    }
}