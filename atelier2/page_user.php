<?php
// page_user.php
session_start();

// Vérifie le couple cookie + session ET le rôle "user"
if (
    !isset($_COOKIE['authToken'], $_SESSION['authToken'], $_SESSION['role']) ||
    $_COOKIE['authToken'] !== $_SESSION['authToken'] ||
    $_SESSION['role'] !== 'user'
) {
    header('Location: index.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Espace Utilisateur</title>
</head>
<body>
  <h1>Bienvenue sur la page Utilisateur protégée par un Cookie</h1>
  <p>Vous êtes connecté en tant que <strong>user</strong>.</p>
  <p><a href="logout.php">Se déconnecter</a></p>
</body>
</html>
