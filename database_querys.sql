CREATE DATABASE IF NOT EXISTS coach_sportif_platform;

use coach_sportif_platform;

CREATE TABLE utilisateur (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'coach', 'sportif') NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL UNIQUE,
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
        ON DELETE CASCADE
);

CREATE TABLE coach (
    id_coach INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    discipline VARCHAR(100) NOT NULL,
    annees_experience INT NOT NULL,
    description TEXT,
    id_user INT NOT NULL UNIQUE,
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
        ON DELETE CASCADE
);

CREATE TABLE sportif (
    id_sportif INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    id_user INT NOT NULL UNIQUE,
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
        ON DELETE CASCADE
);

CREATE TABLE seance (
    id_seance INT AUTO_INCREMENT PRIMARY KEY,
    date_seance DATE NOT NULL,
    heure TIME NOT NULL,
    duree INT NOT NULL,
    statut ENUM('disponible', 'reservee') DEFAULT 'disponible',
    id_coach INT NOT NULL,
    FOREIGN KEY (id_coach) REFERENCES coach(id_coach)
        ON DELETE CASCADE
);
CREATE TABLE reservation (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_seance INT NOT NULL UNIQUE,
    id_sportif INT NOT NULL,
    FOREIGN KEY (id_seance) REFERENCES seance(id_seance)
        ON DELETE CASCADE,
    FOREIGN KEY (id_sportif) REFERENCES sportif(id_sportif)
        ON DELETE CASCADE
);
