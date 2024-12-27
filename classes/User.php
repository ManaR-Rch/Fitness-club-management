<?php

require_once __DIR__.'/../database/connection.php'; 

class User{
    protected $id_user;
    protected $nom;
    protected $prenom;
    protected $phone;
    protected $email;
    protected $password;
    protected $role;
    protected $database;

    public function __construct($id, $nom, $prenom, $phone, $email, $password, $role){
        $this->setId($id);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setRole($role);
        $this->database = new Connection();
    }


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

    public function getRole(){
        return $this->role;
    }


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

    public function setRole($role){
        $this->role = $role;
    }

    //magic methods
    public function __toString(){
        return $this->id_user.' '.$this->nom.' '.$this->role;
    }

    //methods 3adyin
    public function validateData() {
        $errors = [];

        if (empty($this->nom) || strlen($this->nom) < 2) {
            $errors['nom'] = "Le nom doit contenir au moins 2 caractères";
        }

        if (empty($this->prenom) || strlen($this->prenom) < 2) {
            $errors['prenom'] = "Le prénom doit contenir au moins 2 caractères";
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'adresse email n'est pas valide";
        }

        if (!preg_match("/^[0-9]{10}$/", $this->phone)) {
            $errors['phone'] = "Le numéro de téléphone doit contenir 10 chiffres";
        }

        if (strlen($this->password) < 8) {
            $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères";
        }

        return $errors;
    }

    public function login($email, $password) {
        try {
            $pdo = $this->database->getConnection();            
            
            if (empty($email) || empty($password)) {
                return ["success" => false, "message" => "Veuillez remplir tous les champs"];
            }

            $query = "SELECT * FROM User WHERE email = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['role'] = $user['role'];

                return ["success" => true, "message" => "Connexion réussie!", "user" => $user];
            }

            return ["success" => false, "message" => "Email ou mot de passe incorrect"];

        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return ["success" => false, "message" => "Une erreur est survenue lors de la connexion"];
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        return ["success" => true, "message" => "Déconnexion réussie"];
    }
}