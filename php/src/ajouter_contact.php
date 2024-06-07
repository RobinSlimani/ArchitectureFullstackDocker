<?php

ob_start();

$servername = "my-mysql-container";
$username = "root";
$password = "root";
$dbname = "contacts_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connexion échouée: " . $e->getMessage());
}

// Validation et nettoyage des entrées utilisateur
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = sanitizeInput($_POST["nom"]);
    $prenom = sanitizeInput($_POST["prenom"]);
    $email = filter_var(sanitizeInput($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $telephone = sanitizeInput($_POST["telephone"]);

    if ($email === false) {
        die("Adresse email invalide.");
    }

    $sql = "INSERT INTO contacts (nom, prenom, email, telephone) VALUES (:nom, :prenom, :email, :telephone)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telephone", $telephone);

    if ($stmt->execute()) {
        echo "Contact ajouté avec succès";
    } else {
        echo "Erreur: " . $stmt->errorInfo()[2];
    }

    $conn = null;
    header("Location: index.php");
    exit();
}

ob_end_flush();

