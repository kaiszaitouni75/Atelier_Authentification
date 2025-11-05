<?php
setcookie('lang', 'fr', time() + 60, null, null, false, true);

// Démarrer une session utilisateur
session_start();

// Générer un token unique si pas encore défini
if (!isset($_SESSION['authToken'])) {
    $_SESSION['authToken'] = bin2hex(random_bytes(16));
}

// Vérifier si l'utilisateur est déjà connecté (cookie valide)
if (isset($_COOKIE['authToken']) && $_COOKIE['authToken'] === $_SESSION['authToken']) {
    header('Location: page_admin.php');
    exit();
}

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'secret') {

        // Créer le cookie avec le token de session
        setcookie('authToken', $_SESSION['authToken'], time() + 60, '/', '', false, true);

        header('Location: page_admin.php');
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
