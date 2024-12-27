/*CREATE DATABASE GestionReservation;
USE GestionReservation;


CREATE TABLE User (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'membre') NOT NULL
);


CREATE TABLE Activite (
    id_activite INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    description TEXT,
    capacite INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    disponibilite TINYINT(1) NOT NULL
);


CREATE TABLE Reservation (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_membre INT NOT NULL,
    id_activite INT NOT NULL,
    date_reservation DATETIME NOT NULL,
    status ENUM('confirmee', 'annulee') NOT NULL,
    FOREIGN KEY (id_membre) REFERENCES User(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_activite) REFERENCES Activite(id_activite) ON DELETE CASCADE
); */


-- Insert a new user
INSERT INTO User (nom, prenom, email, telephone, password, role)
VALUES ('Doe', 'John', 'john.doe@example.com', '1234567890', 'hashed_password', 'membre');

-- Insert a new activity
INSERT INTO Activite (titre, description, capacite, date_debut, date_fin, disponibilite)
VALUES ('Yoga Session', 'A calming yoga session for all levels.', 20, '2024-01-05', '2024-01-05', 1);

-- Insert a new reservation
INSERT INTO Reservation (id_membre, id_activite, date_reservation, status)
VALUES (1, 1, NOW(), 'confirmee');

-- Update a user's email
UPDATE User
SET email = 'new.email@example.com'
WHERE id_user = 1;

-- Update an activity's capacity and availability
UPDATE Activite
SET capacite = 25, disponibilite = 1
WHERE id_activite = 1;

-- Update a reservation's status
UPDATE Reservation
SET status = 'annulee'
WHERE id_reservation = 1;

-- Delete a user (and cascade delete their reservations)
DELETE FROM User
WHERE id_user = 1;

-- Delete an activity (and cascade delete its reservations)
DELETE FROM Activite
WHERE id_activite = 1;

-- Delete a specific reservation
DELETE FROM Reservation
WHERE id_reservation = 1;


SELECT COUNT(*) AS nb_reservations_confirmees
FROM Reservation
WHERE status = 'confirmee';

SELECT AVG(capacite) AS capacite_moyenne
FROM Activite;

SELECT COUNT(DISTINCT id_membre) AS nb_membres_distincts
FROM Reservation;


SELECT a.titre, COUNT(r.id_reservation) AS nb_reservations
FROM Reservation r
JOIN Activite a ON r.id_activite = a.id_activite
GROUP BY a.id_activite, a.titre
ORDER BY nb_reservations DESC
LIMIT 3;


SELECT 
    ROUND((SUM(CASE WHEN status = 'annulee' THEN 1 ELSE 0 END) * 100.0) / COUNT(*), 2) AS pourcentage_annulations
FROM Reservation;
