CREATE DATABASE GestionReservation;
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
);