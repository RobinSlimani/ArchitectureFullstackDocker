<?php


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

$sql = "SELECT nom, prenom, email, telephone FROM contacts WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    echo "Aucun contact trouvé avec l'ID $id";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un contact</title>
</head>
<body>
    <h1>Modifier un contact</h1>
    <form action="enregistrer_modification.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $contact["nom"]; ?>" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $contact["prenom"]; ?>" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo $contact["email"]; ?>" required><br>

        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" value="<?php echo $contact["telephone"]; ?>" required><br>

        <input type="submit" value="Enregistrer">
    </form>

    <?php
    $conn = null;
   
    ?>
</body>
</html>
