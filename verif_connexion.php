<?php
// === FICHIER : verif_connexion.php ===

session_start();

$host   = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "site_ecommerce";

$mysqli = new mysqli($host, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_error) {
    die("Erreur BDD : " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $mdp      = trim($_POST['mdp']      ?? '');

    // On récupère l'utilisateur par son nom uniquement pour pouvoir vérifier le hash
    $sql = "SELECT id_client, mot_de_passe, nb_tentatives FROM client WHERE nom_utilisateur = '$username' LIMIT 1";
    $res = $mysqli->query($sql);

    if ($res && $res->num_rows === 1) {
        $user = $res->fetch_assoc();

        // Compte bloqué après 3 tentatives incorrectes
        if ($user['nb_tentatives'] >= 3) {
            $_SESSION['erreur_connexion'] = "Votre compte est bloqué, veuillez contacter le support.";
            header('Location: connexion.php');
            exit;
        }

        // Vérification du mot de passe contre le hash stocké en base
        else if (password_verify($mdp, $user['mot_de_passe'])) {
            $mysqli->query("UPDATE client SET nb_tentatives = 0 WHERE id_client = " . $user['id_client']);
            session_regenerate_id(true);
            $_SESSION['user_id']  = $user['id_client'];
            $_SESSION['username'] = $username;
            header('Location: panier.php');
            exit;
        }

        // Mot de passe incorrect : on incrémente le compteur
        else {
            $mysqli->query("UPDATE client SET nb_tentatives = nb_tentatives + 1 WHERE id_client = " . $user['id_client']);
        }
    }

    // Identifiant ou mot de passe incorrect
    $_SESSION['erreur_connexion'] = "Votre identifiant ou mot de passe n'est pas bon.";
    header('Location: connexion.php');
    exit;
}
?>
