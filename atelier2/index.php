<?php
session_start();

// Générer un token unique si pas encore défini
if (!isset($_SESSION['authToken'])) {
    $_SESSION['authToken'] = bin2hex(random_bytes(16));
}

// Vérifier si l'utilisateur est déjà connecté (cookie valide)
if (isset($_COOKIE['authToken']) && $_COOKIE['authToken'] === $_SESSION['authToken']) {
    
    // Rediriger selon le rôle
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header('Location: page_admin.php');
        exit();
    } 
    elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
        header('Location: page_user.php');
        exit();
    }
}

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'secret') {

        // Stocker le rôle en session
        $_SESSION['role'] = 'admin';

        // Créer le cookie avec le token de session
        setcookie('authToken', $_SESSION['authToken'], time() + 60, '/', '', false, true);

        header('Location: page_admin.php');
        exit();
    } 
    
    elseif ($username === 'user' && $password === 'utilisateur') {
        
        $_SESSION['role'] = 'user';

        setcookie('authToken', $_SESSION['authToken'], time() + 60, '/', '', false, true);
        
        header('Location: page_user.php');
        exit();
    }
        
    else {
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
    <h1>Connexion</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <div>
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
