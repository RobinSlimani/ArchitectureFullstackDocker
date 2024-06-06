<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $friendId = validateInput($_POST['friend_id']);

    $stmt = $pdo->prepare("INSERT INTO amities (utilisateur1_id, utilisateur2_id) VALUES (:userId, :friendId)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':friendId', $friendId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Une erreur est survenue lors de l\'ajout de l\'ami.']);
    }
}
