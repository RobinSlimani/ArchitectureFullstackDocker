<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: account.php");
    exit;
}
require 'includes/header.php';
?>
<h1>Bienvenue sur notre application de messagerie sécurisée</h1>
<a href="login.php">Se connecter</a>
<a href="register.php">S'inscrire</a>
<?php require 'includes/footer.php'; ?>
