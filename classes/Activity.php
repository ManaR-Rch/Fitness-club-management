<?php

class Activity {

    private $id_activite;
    private $titre;
    private $description;
    private $capacite;
    private $date_debut;
    private $date_fin;
    private $disponibilite;
    private $database;

    public function __construct($id_activite, $titre, $description, $capacite, $date_debut, $date_fin, $disponibilite) {
        $this->setId($id_activite);
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setCapacite($capacite);
        $this->setDateDebut($date_debut);
        $this->setDateFin($date_fin);
        $this->setDisponibilite($disponibilite);
        $this->database = new Connection();
    }

    // Getters
    public function getId() {
        return $this->id_activite;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCapacite() {
        return $this->capacite;
    }

    public function getDateDebut() {
        return $this->date_debut;
    }

    public function getDateFin() {
        return $this->date_fin;
    }

    // Setters
    public function setId($id) {
        $this->id_activite = $id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setCapacite($capacite) {
        $this->capacite = $capacite;
    }

    public function setDateDebut($date_debut) {
        $this->date_debut = $date_debut;
    }

    public function setDateFin($date_fin) {
        $this->date_fin = $date_fin;
    }

    public function setDisponibilite($disponibilite) {
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

    public function SupprimerActivite(): void {
        try {
            $pdo = $this->database->getConnection();
            $stmt = $pdo->prepare("DELETE FROM Activite WHERE id_activite = :id_activite");
            $stmt->bindParam(':id_activite', $this->id_activite);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                echo "L'activité avec l'ID {$this->id_activite} a été supprimée avec succès.";
            } else {
                echo "Aucune activité trouvée avec l'ID {$this->id_activite}.";
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
            $stmt->bindParam(':id_activite', $this->id_activite, PDO::PARAM_INT);
            $stmt->bindParam(':titre', $this->titre, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':capacite', $this->capacite, PDO::PARAM_INT);
            $stmt->bindParam(':date_debut', $this->date_debut, PDO::PARAM_STR);
            $stmt->bindParam(':date_fin', $this->date_fin, PDO::PARAM_STR);
            $stmt->bindParam(':disponibilite', $this->disponibilite, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                echo "Activité modifiée avec succès.";
            } else {
                echo "Aucune modification effectuée.";
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
                echo "<table class='table-auto w-full border-collapse text-sm'>";
                echo "<thead>";
                echo "<tr class='bg-gray-100'>";
                echo "<th class='px-2 py-1 border'>ID</th>";
                echo "<th class='px-2 py-1 border'>Titre</th>";
                echo "<th class='px-2 py-1 border'>Description</th>";
                echo "<th class='px-2 py-1 border'>Capacité</th>";
                echo "<th class='px-2 py-1 border'>Date Début</th>";
                echo "<th class='px-2 py-1 border'>Date Fin</th>";
                echo "<th class='px-2 py-1 border'>Disponibilité</th>";
                echo "<th class='px-2 py-1 border'>Actions</th>"; 
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
    
                foreach ($activites as $activite) {
                    echo "<tr class='hover:bg-gray-100'>";
                    echo "<td class='px-2 py-1 border'>" . htmlspecialchars($activite['id_activite']) . "</td>";
                    echo "<td class='px-2 py-1 border'>" . htmlspecialchars($activite['titre']) . "</td>";
                    echo "<td class='px-2 py-1 border'>" . htmlspecialchars($activite['description']) . "</td>";
                    echo "<td class='px-2 py-1 border'>" . htmlspecialchars($activite['capacite']) . "</td>";
                    echo "<td class='px-2 py-1 border'>" . htmlspecialchars($activite['date_debut']) . "</td>";
                    echo "<td class='px-2 py-1 border'>" . htmlspecialchars($activite['date_fin']) . "</td>";
                    echo "<td class='px-2 py-1 border'>" . ($activite['disponibilite'] ? "Disponible" : "Non Disponible") . "</td>";
    
                    echo "<td class='px-2 py-1 border text-center'>";
                    echo "<a href='modification.php?id=" . htmlspecialchars($activite['id_activite']) . "' class='text-blue-500 hover:text-blue-700'>modifier</a>";
                    echo " | ";
                    echo "<a href='delete.php?id=" . htmlspecialchars($activite['id_activite']) . "' class='text-red-500 hover:text-red-700')'>Supprimer</a>";
                    echo "</td>";
    
                    echo "</tr>";
                }
    
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "Aucune activité trouvée.";
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des activités : " . $e->getMessage();
        }
    }
    
    
    
}

?>
