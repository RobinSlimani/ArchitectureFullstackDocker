CREATE DATABASE chatdb;
\c chatdb;

CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username VARCHAR(50) NOT NULL
);

-- Ajoutez d'autres tables nécessaires comme groupes, amis, conversations, messages

