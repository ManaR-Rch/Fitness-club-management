<?php
require_once __DIR__.'/User.php';

class Member extends User {
    public function __construct($id = null, $nom = "", $prenom = "", $phone = "", $email = "", $password = "", $role = "membre") {
        parent::__construct($id, $nom, $prenom, $phone, $email, $password, $role);
    }

    public function register() {
        try {

            $validationErrors = $this->validateData();
            if (!empty($validationErrors)) {
                return ["success" => false, "message" => "Erreurs de validation", "errors" => $validationErrors];
            }

            $pdo = $this->database->getConnection();
            $checkEmail = $pdo->prepare("SELECT email FROM User WHERE email = ?");
            $checkEmail->execute([$this->email]);
            if ($checkEmail->fetch()) {
                return ["success" => false, "message" => "Cet email existe déjà"];
            }

            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user (nom, prenom, email, telephone, password, role) 
                     VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([
                $this->nom,
                $this->prenom,
                $this->email,
                $this->phone,
                $hashedPassword,
                'membre'
            ]);

            if ($success) {
                return [
                    "success" => true, 
                    "message" => "Inscription réussie!",
                    "user_id" => $pdo->lastInsertId()
                ];
            }

            return ["success" => false, "message" => "Erreur lors de l'inscription"];

        } catch (PDOException $e) {
            echo $e->getMessage();
            return ["success" => false, "message" => "Une erreur est survenue lors de l'inscription"];
        }
    }

    public function validateData() {
        $errors = parent::validateData();
        // zid ay member validation rules hna
        return $errors;
    }
}
?>