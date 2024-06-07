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

$id = $_GET["id"];

$sql = "DELETE FROM contacts WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);

if ($stmt->execute()) {
    echo "Contact supprimé avec succès";
} else {
    echo "Erreur: " . $stmt->errorInfo()[2];
}

$conn = null;
header("Location: index.php");
exit();
ob_end_flush();
