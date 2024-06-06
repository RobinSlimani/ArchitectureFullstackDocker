<?php
// Informations de connexion à la base de données
$host = 'my-mysql-container';
$dbname = 'messagerie';
$user = 'root';
$password = 'education';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion etablie" ;
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
