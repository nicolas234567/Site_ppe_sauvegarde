<?php
session_start(); // Démarre la session si elle existe

// Supprime toutes les variables de session
$_SESSION = [];

// Détruit complètement la session
session_destroy();

// (Optionnel) Supprime le cookie de session sur le navigateur
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirige vers la page du panier
header("Location: page_acceuil_site.html");
exit;
?>
