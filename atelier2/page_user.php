<?php
session_start();

// Vérifier cookie + token + rôle utilisateur
if (
    !isset($_COOKIE['authToken']) ||
    !isset($_SESSION['authToken']) ||
    $_COOKIE['authToken'] !== $_SESSION['authToken'] ||
    !isset($_SESSION['role']) ||
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
    <title>Espace Utilisateur</title>
</head>
<body>
    <h1>Bienvenue sur la page USER</h1>
    <p>Vous êtes connecté en tant qu'utilisateur standard ✅</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
