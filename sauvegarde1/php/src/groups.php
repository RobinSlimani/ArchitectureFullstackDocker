<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté']);
    exit;
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT g.id, g.nom
                       FROM groupes g
                       JOIN membres_groupe mg ON g.id = mg.groupe_id
                       WHERE mg.utilisateur_id = :userId");
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['success' => true, 'groups' => $groups]);
