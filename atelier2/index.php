<?php
session_start();

// Si déjà connecté, on redirige selon le rôle
if (isset($_COOKIE['authToken'], $_SESSION['authToken'], $_SESSION['role']) &&
    $_COOKIE['authToken'] === $_SESSION['authToken']) {

    if ($_SESSION['role'] === 'admin') {
        header('Location: page_admin.php');
        exit();
    } elseif ($_SESSION['role'] === 'user') {
        header('Location: page_user.php');
        exit();
    }
}

// Nouveau token de session pour cette visite
$token = bin2hex(random_bytes(16));
$_SESSION['authToken'] = $token;

// Soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérification des identifiants
    if ($username === 'admin' && $password === 'secret') {
        $_SESSION['role'] = 'admin';
        setcookie('authToken', $token, time() + 3600, '/', '', false, true); // 1h
        header('Location: page_admin.php');
        exit();
    } elseif ($username === 'user' && $password === 'utilisateur') {
        $_SESSION['role'] = 'user';
        setcookie('authToken', $token, time() + 3600, '/', '', false, true); // 1h
        header('Location: page_user.php');
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Atelier authentification par Cookie</h1>
    <h3>
        La page <a href="page_admin.php">page_admin.php</a> (admin/secret) et
        la page <a href="page_user.php">page_user.php</a> (user/utilisateur) sont inaccessibles tant que vous n'êtes pas connecté.
    </h3>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
    <br>
    <a href="../index.html">Retour à l'accueil</a>
</body>
</html>
