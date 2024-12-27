<?php

class Activity {
    private $pdo;
    private $id_activity;
    private $titre;
    private $description;
    private $capacite;
    private $date_debut;
    private $date_fin;
    private $disponibilite;

    // البناء: إعداد الاتصال بقاعدة البيانات
    public function __construct($pdo, $id_activity = null, $titre = null, $description = null, $capacite = null, $date_debut = null, $date_fin = null, $disponibilite = null) {
        $this->pdo = $pdo; // اتصال PDO
        $this->setId($id_activity);
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setCapacite($capacite);
        $this->setDateDebut($date_debut);
        $this->setDateFin($date_fin);
        $this->setDisponibilite($disponibilite);
    }

    // Getters and Setters...

    public function getId() {
        return $this->id_activity;
    }

    public function setId($id) {
        $this->id_activity = $id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCapacite() {
        return $this->capacite;
    }

    public function setCapacite($capacite) {
        $this->capacite = $capacite;
    }

    public function getDateDebut() {
        return $this->date_debut;
    }

    public function setDateDebut($date_debut) {
        $this->date_debut = $date_debut;
    }

    public function getDateFin() {
        return $this->date_fin;
    }

    public function setDateFin($date_fin) {
        $this->date_fin = $date_fin;
    }

    public function getDisponibilite() {
        return $this->disponibilite;
    }

    public function setDisponibilite($disponibilite) {
        $this->disponibilite = $disponibilite;
    }

    // Ajouter une activité
    public function AjouterActivite() {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO Activite (titre, description, capacite, date_debut, date_fin, disponibilite) 
                VALUES (:titre, :description, :capacite, :date_debut, :date_fin, :disponibilite)
            ");
            $stmt->bindParam(':titre', $this->titre);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':capacite', $this->capacite);
            $stmt->bindParam(':date_debut', $this->date_debut);
            $stmt->bindParam(':date_fin', $this->date_fin);
            $stmt->bindParam(':disponibilite', $this->disponibilite);
            $stmt->execute();
            echo "Activité ajoutée avec succès !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Supprimer une activité
    public function SupprimerActivite() {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Activite WHERE id_activite = :id_activite");
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

    // Modifier une activité
    public function ModifierActivite() {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE Activite 
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
            $stmt->bindParam(':id_activite', $this->id_activity);
            $stmt->bindParam(':titre', $this->titre);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':capacite', $this->capacite);
            $stmt->bindParam(':date_debut', $this->date_debut);
            $stmt->bindParam(':date_fin', $this->date_fin);
            $stmt->bindParam(':disponibilite', $this->disponibilite);
            $stmt->execute();

            echo "Activité modifiée avec succès !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    public function ConsulterActivites() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM Activite");
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

