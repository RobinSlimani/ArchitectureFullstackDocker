<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = validateInput($_POST['nom']);
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO groupes (nom) VALUES (:nom)");
    $stmt->bindParam(':nom', $nom);
    $stmt->execute();
    $groupId = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO membres_groupe (groupe_id, utilisateur_id) VALUES (:groupId, :userId)");
    $stmt->bindParam(':groupId', $groupId);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    echo json_encode(['success' => true, 'group_id' => $groupId]);
}
