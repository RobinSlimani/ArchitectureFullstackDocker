<?php
session_start();
require 'config.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && verifyPassword($password, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Email ou mot de passe incorrect.']);
    }
}
