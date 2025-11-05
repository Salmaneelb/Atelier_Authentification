<?php
session_start();

if (!isset($_COOKIE['authToken'], $_SESSION['authToken']) ||
    $_COOKIE['authToken'] !== $_SESSION['authToken']) {
    header('Location: index.php');
    exit();
}

// Ici, l’utilisateur est authentifié
?>
<h1>Bienvenue dans page_user.php</h1>
