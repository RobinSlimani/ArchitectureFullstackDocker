-- Créer la base de données
CREATE DATABASE contacts_db;

-- Utiliser la base de données
USE contacts_db;

-- Créer la table "contacts"
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL
);
