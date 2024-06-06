<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté']);
    exit;
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
$stmt->bindParam(':id', $userId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(['success' => true, 'user' => $user]);
