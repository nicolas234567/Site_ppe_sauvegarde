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

// Traitement de la réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $role === 'admin') {
    $modele = mysqli_real_escape_string($connect, $_POST['modele']);

    if ($_POST['action'] === 'liberer') {
        mysqli_query($connect, "UPDATE stock SET duree_blocage = NULL WHERE modele = '$modele'");
        header('Location: reservation.php?status=libere');
    } else {
        $duree = (int) $_POST['duree'];
        mysqli_query($connect,
            "UPDATE stock SET duree_blocage = DATE_ADD(NOW(), INTERVAL $duree MINUTE)
             WHERE modele = '$modele'"
        );
        header('Location: reservation.php?status=reserve');
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réservation</title>
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
<h1 class="texte">Réservation de produits</h1>
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

<?php if (isset($_GET['status'])): ?>
    <?php if ($_GET['status'] === 'reserve'): ?>
        <script>alert('Produit bien réservé.');</script>
    <?php elseif ($_GET['status'] === 'libere'): ?>
        <script>alert('Produit bien libéré.');</script>
    <?php endif; ?>
<?php endif; ?>

<?php if ($role !== 'admin'): ?>
    <p class="texte" style="color:red;">Vous n'êtes pas administrateur.</p>
<?php else: ?>
    <div class="panier">
    <?php
    $produits = mysqli_query($connect, "SELECT * FROM stock");
    while ($row = mysqli_fetch_assoc($produits)):
        $modele_html = htmlspecialchars($row['modele']);
    ?>
        <div class="item">
            <div class="item-info">
                <p><strong>Modèle :</strong> <?= $modele_html ?></p>
                <p><strong>Stock :</strong> <?= (int)$row['quantite'] ?></p>
                <p><strong>Prix :</strong> <?= htmlspecialchars($row['prix']) ?></p>
            </div>
            <div class="item-actions">
                <form method="post" action="reservation.php">
                    <input type="hidden" name="action" value="reserver">
                    <input type="hidden" name="modele" value="<?= $modele_html ?>">
                    <label>Durée :
                        <select name="duree">
                            <option value="1">1 minute</option>
                            <option value="10">10 minutes</option>
                            <option value="30">30 minutes</option>
                            <option value="60">1 heure</option>
                            <option value="120">2 heures</option>
                        </select>
                    </label>
                    <button type="submit" class="btn-ajouter">Réserver</button>
                </form>
                <form method="post" action="reservation.php">
                    <input type="hidden" name="action" value="liberer">
                    <input type="hidden" name="modele" value="<?= $modele_html ?>">
                    <button type="submit" class="btn-supprimer">Enlever la réservation</button>
                </form>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
<?php endif; ?>
</body>
</html>
