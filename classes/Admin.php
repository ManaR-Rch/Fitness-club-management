<?php

require_once __DIR__.'/User.php';

class Admin extends User{
    public function __construct($id, $nom, $prenom, $phone, $email, $password){
        parent::__construct($id, $nom, $prenom, $phone, $email, $password, 'admin');
    }
}