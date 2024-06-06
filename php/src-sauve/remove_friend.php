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

    $stmt = $pdo->prepare("DELETE FROM amities WHERE (utilisateur1_id = :userId AND utilisateur2_id = :friendId) OR (utilisateur1_id = :friendId AND utilisateur2_id = :userId)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':friendId', $friendId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Une erreur est survenue lors de la suppression de l\'ami.']);
    }
}
