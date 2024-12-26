<?php

class User{
    protected $id_user;
    protected $nom;
    protected $prenom;
    protected $phone;
    protected $email;
    protected $password;

    public function __construct($id, $nom, $prenom, $phone, $email, $password){
        $this->setId($id);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    //getters
    public function getId(){
        return $this->id_user;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    //setters
    public function setId($id){
        $this->id_user = $id;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function __toString(){
        return $this->id_user.' '.$this->nom;
    }
}