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
    $id = filter_var(sanitizeInput($_POST["id"]), FILTER_VALIDATE_INT);
    $nom = sanitizeInput($_POST["nom"]);
    $prenom = sanitizeInput($_POST["prenom"]);
    $email = filter_var(sanitizeInput($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $telephone = sanitizeInput($_POST["telephone"]);

    if ($id === false) {
        die("ID invalide.");
    }

    if ($email === false) {
        die("Adresse email invalide.");
    }

    $sql = "UPDATE contacts SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telephone", $telephone);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Contact modifié avec succès";
    } else {
        echo "Erreur: " . $stmt->errorInfo()[2];
    }

    $conn = null;
    header("Location: index.php");
    exit();
}

ob_end_flush();

