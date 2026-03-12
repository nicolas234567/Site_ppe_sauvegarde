<?php
// login.php (formulaire + traitement simple)
session_start();

$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "site_ecommerce";

//connection
$mysqli = new mysqli($host, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_error) {
    die("Erreur BDD");
}

//recuperation uniquement si la method est post et peu importe si le mot de passe ou identifiant est vide
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $mdp = $_POST['mdp'] ?? '';

    //requete
    $sql = "SELECT id_client FROM client WHERE nom_utilisateur = '$username' AND mot_de_passe = '$mdp' LIMIT 1";
    $res = $mysqli->query($sql);

    //recuperation et association des valeur a la session
    if ($res && $res->num_rows === 1) {
        $user = $res->fetch_assoc();
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id_client'];
        $_SESSION['username'] = $username;
        header('Location: panier.php');
        exit;
    } else {
         $_SESSION['erreur_connexion'] = "Votre identifiant ou mot de passe n'est pas bon.";
        header('Location: connexion.php');
        exit;
    }
}
?>
