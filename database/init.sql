CREATE DATABASE IF NOT EXISTS messagerie;
USE messagerie;

CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS ami (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur1_id INT NOT NULL,
    utilisateur2_id INT NOT NULL,
    FOREIGN KEY (utilisateur1_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (utilisateur2_id) REFERENCES utilisateurs(id),
    UNIQUE (utilisateur1_id, utilisateur2_id)
);

CREATE TABLE IF NOT EXISTS groupes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS membres_groupe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    groupe_id INT NOT NULL,
    utilisateur_id INT NOT NULL,
    FOREIGN KEY (groupe_id) REFERENCES groupes(id),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
    UNIQUE (groupe_id, utilisateur_id)
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expediteur_id INT NOT NULL,
    groupe_id INT,
    FOREIGN KEY (expediteur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (groupe_id) REFERENCES groupes(id)
);
