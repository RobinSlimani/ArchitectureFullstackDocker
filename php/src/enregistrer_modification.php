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

$id = $_POST["id"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$telephone = $_POST["telephone"];

$sql = "UPDATE contacts SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":nom", $nom);
$stmt->bindParam(":prenom", $prenom);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":telephone", $telephone);
$stmt->bindParam(":id", $id);

if ($stmt->execute()) {
    echo "Contact modifié avec succès";
} else {
    echo "Erreur: " . $stmt->errorInfo()[2];
}

$conn = null;
header("Location: index.php");
exit();
ob_end_flush();
