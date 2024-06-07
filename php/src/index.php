<?php
ob_start();

//comme dans tous les autres fichiers il aurait été bien de faire un fichier pour faire une connection et de le réutiliser ici à chaque fois mais par manque de temps nous l'avons pas fais.

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

// Récupérer les contacts de la base de données
$sql = "SELECT id, nom, prenom, email, telephone FROM contacts";
$stmt = $conn->prepare($sql);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des contacts</title>
</head>
<body>
    <h1>Gestion des contacts</h1>

    <!-- Formulaire d'ajout de contact -->
    <h2>Ajouter un contact</h2>
    <form action="ajouter_contact.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br>

        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" required><br>

        <input type="submit" value="Ajouter">
    </form>

    <!-- Afficher les contacts existants -->
    <h2>Contacts existants</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($contacts as $contact) : ?>
            <tr>
                <td><?php echo $contact["nom"]; ?></td>
                <td><?php echo $contact["prenom"]; ?></td>
                <td><?php echo $contact["email"]; ?></td>
                <td><?php echo $contact["telephone"]; ?></td>
                <td>
                    <a href="modifier_contact.php?id=<?php echo $contact["id"]; ?>">Modifier</a>
                    <a href="supprimer_contact.php?id=<?php echo $contact["id"]; ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    $conn = null;
    ob_end_flush();
    ?>
</body>
</html>
