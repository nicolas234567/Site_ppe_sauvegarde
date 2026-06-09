<?php
session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

$id_client       = $_SESSION['user_id'];
$username_client = $_SESSION['username'];

$host     = "localhost";
$user     = "root";
$password = "";
$database = "site_ecommerce";

$connect = mysqli_connect($host, $user, $password, $database);
if (!$connect) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

$res_role = mysqli_query($connect, "SELECT role FROM client WHERE id_client = '$id_client'");
$client   = mysqli_fetch_assoc($res_role);
$role     = $client['role'] ?? 'client';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rapports PDF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="bouton_droite">
    <ol>
        <li><a href="inscription.html">Inscription</a></li>
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="deconnexion.php">Déconnexion</a></li>
    </ol>
</nav>
<div class="compte-info">Connecté : <?= htmlspecialchars($username_client) ?></div>
<h1 class="texte">Rapports PDF</h1>
<nav class="bouton_centré">
    <ol>
        <li><a href="ordinateur.html">Ordinateur</a></li>
        <li><a href="péripherique.html">Périphérique</a></li>
        <li><a href="a propos de nous.html">À propos</a></li>
        <li><a href="panier.php">Panier</a></li>
        <li><a href="reservation.php">Réservation</a></li>
        <li><a href="rapport.php">Rapport</a></li>
    </ol>
</nav>

<?php if ($role !== 'admin'): ?>
    <p class="texte" style="color:red;">Vous n'êtes pas administrateur.</p>
<?php else: ?>
    <div class="panier">
        <p class="texte">Aucun rapport disponible.</p>
    </div>
<?php endif; ?>
</body>
</html>
