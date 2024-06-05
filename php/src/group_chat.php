<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté']);
    exit;
}

if (isset($_GET['id'])) {
    $groupId = validateInput($_GET['id']);
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT m.contenu, m.date_envoi, u.nom AS expediteur
                           FROM messages m
                           JOIN utilisateurs u ON m.expediteur_id = u.id
                           WHERE m.groupe_id = :groupId
                           ORDER BY m.date_envoi ASC");
    $stmt->bindParam(':groupId', $groupId);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT g.nom
                           FROM groupes g
                           WHERE g.id = :groupId");
    $stmt->bindParam(':groupId', $groupId);
    $stmt->execute();
    $groupName = $stmt->fetchColumn();

    echo json_encode(['success' => true, 'messages' => $messages, 'group_name' => $groupName]);
} else {
    echo json_encode(['success' => false, 'error' => 'ID de groupe manquant']);
}
