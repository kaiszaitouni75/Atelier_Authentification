<?php
session_start();

// Détruire les données de session
$_SESSION = [];
session_destroy();

// Supprimer le cookie d'authentification
setcookie('authToken', '', time() - 60, '/', '', false, true);

// Redirection vers la page de connexion
header('Location: index.php');
exit();
?>
