<?php

class Activity{
    private $id_activite;
    private $titre;
    private $description;
    private $capacite;
    private $date_debut;
    private $date_fin;
    private $disponibilite;
    protected $database;


    public function __construct($id_activite, $titre, $description, $capacite, $date_debut, $date_fin, $disponibilite){
        $this->setId($id_activite);
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

    public function AjouterActivite() {
        try {
            $pdo = $this->database->getConnection();
            $stmt = $pdo->prepare("INSERT INTO activite (titre, description, capacite, date_debut, date_fin, disponibilite) VALUES (:titre, :description, :capacite, :date_debut, :date_fin, :disponibilite)");
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
            $pdo = $this->database->getConnection();
            $stmt = $pdo->prepare("DELETE FROM Activite WHERE id_activite = :id_activite");
            $stmt->bindParam(':id_activite', $this->id_activity);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "L'activité avec l'ID {$this->id_activity} a été supprimée avec succès.";
            } else {
                echo "Aucune activité trouvée avec l'ID {$this->id_activity}.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    

    public function ModifierActivite() {
        try {
            $pdo = $this->database->getConnection();
            $stmt = $pdo->prepare("
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
            $stmt->bindParam(':titre', $this->titre, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':capacite', $this->capacite, PDO::PARAM_INT);
            $stmt->bindParam(':date_debut', $this->date_debut, PDO::PARAM_STR);
            $stmt->bindParam(':date_fin',$this->date_fin, PDO::PARAM_STR);
            $stmt->bindParam(':disponibilite',$this->disponibilite, PDO::PARAM_INT);
    
            $stmt->execute();
    
            try {
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function ConsulterActivites() {
        try {
            $pdo = $this->database->getConnection();
            $stmt = $pdo->query("SELECT * FROM Activite");
            $activites = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($activites)) {
                foreach ($activites as $activite) {
                    echo "ID: " . htmlspecialchars($activite['id_activite']) . "<br>";
                    echo "Titre: " . htmlspecialchars($activite['titre']) . "<br>";
                    echo "Description: " . htmlspecialchars($activite['description']) . "<br>";
                    echo "Capacité: " . htmlspecialchars($activite['capacite']) . "<br>";
                    echo "Date Début: " . htmlspecialchars($activite['date_debut']) . "<br>";
                    echo "Date Fin: " . htmlspecialchars($activite['date_fin']) . "<br>";
                    echo "Disponibilité: " . ($activite['disponibilite'] ? "Disponible" : "Non Disponible") . "<br><br>";
                }
            } else {
                echo "Aucune activité trouvée.";
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des activités : " . $e->getMessage();
        }
    }
}
?>
