<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT u.nom, u.id 
                       FROM utilisateurs u
                       JOIN amities a ON u.id = a.utilisateur2_id
                       WHERE a.utilisateur1_id = :userId");
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$friends = $stmt->fetchAll(PDO::FETCH_ASSOC);

require 'includes/header.php';
?>
<h1>Mes amis</h1>
<ul>
    <?php foreach ($friends as $friend): ?>
        <li><?php echo $friend['nom']; ?> <a href="remove_friend.php?id=<?php echo $friend['id']; ?>">Supprimer</a></li>
    <?php endforeach; ?>
</ul>
<?php require 'includes/footer.php'; ?>
