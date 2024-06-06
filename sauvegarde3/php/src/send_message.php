<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = validateInput($_POST['message']);
    $groupId = validateInput($_POST['group_id']);
    $expediteurId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO messages (contenu, expediteur_id, groupe_id) VALUES (:contenu, :expediteurId, :groupId)");
    $stmt->bindParam(':contenu', $contenu);
    $stmt->bindParam(':expediteurId', $expediteurId);
    $stmt->bindParam(':groupId', $groupId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Une erreur est survenue lors de l\'envoi du message.']);
    }
}
