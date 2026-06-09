<?php
// === FICHIER : panier.php ===

session_start();

// Redirige vers la connexion si non connecté
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

// Suppression d'un article entier du panier
if (isset($_POST['action']) && $_POST['action'] === 'supprimer') {
    $modele = mysqli_real_escape_string($connect, $_POST['modele']);
    mysqli_query($connect, "DELETE FROM panier WHERE modele='$modele' AND id_client='$id_client'");
    header('Location: panier.php');
    exit;
}

// Augmentation de la quantité de 1
if (isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    $modele = mysqli_real_escape_string($connect, $_POST['modele']);
    mysqli_query($connect, "UPDATE panier SET quantite = quantite + 1 WHERE modele='$modele' AND id_client='$id_client'");
    header('Location: panier.php');
    exit;
}

// Réduction de la quantité — supprime la ligne si quantité tombe à 0
if (isset($_POST['action']) && $_POST['action'] === 'reduire') {
    $modele  = mysqli_real_escape_string($connect, $_POST['modele']);
    $res_qte = mysqli_query($connect, "SELECT quantite FROM panier WHERE modele='$modele' AND id_client='$id_client'");
    if ($res_qte && $row_qte = mysqli_fetch_assoc($res_qte)) {
        if ($row_qte['quantite'] <= 1) {
            mysqli_query($connect, "DELETE FROM panier WHERE modele='$modele' AND id_client='$id_client'");
        } else {
            mysqli_query($connect, "UPDATE panier SET quantite = quantite - 1 WHERE modele='$modele' AND id_client='$id_client'");
        }
    }
    header('Location: panier.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
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
<h1 class="texte">Votre panier</h1>
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

<?php
$result = mysqli_query($connect, "SELECT * FROM panier WHERE id_client='$id_client'");

if ($result && mysqli_num_rows($result) > 0) {
    echo "<div class='panier'>";

    $total = 0;
    $rows  = [];

    // On stocke les lignes pour calculer le total ensuite
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
        $total += floatval($row['prix']) * (int)$row['quantite'];
    }

    $remise = false;
    if ($total > 1000) {
        $total *= 0.90;
        $remise = true;
    }

    foreach ($rows as $row) {
        $modele_html = htmlspecialchars($row['modele']);
        echo "
        <div class='item'>
            <div class='item-info'>
                <p><strong>Modèle :</strong> {$modele_html}</p>
                <p><strong>Quantité :</strong> {$row['quantite']}</p>
                <p><strong>Prix unitaire :</strong> {$row['prix']}</p>
            </div>
            <div class='item-actions'>
                <!-- Réduit la quantité de 1, supprime la ligne si quantité = 1 -->
                <form method='post'>
                    <input type='hidden' name='action'  value='reduire'>
                    <input type='hidden' name='modele'  value='{$modele_html}'>
                    <button type='submit' class='btn-reduire'>− Réduire</button>
                </form>
                <!-- Augmente la quantité de 1 -->
                <form method='post'>
                    <input type='hidden' name='action'  value='ajouter'>
                    <input type='hidden' name='modele'  value='{$modele_html}'>
                    <button type='submit' class='btn-ajouter'>+ Ajouter</button>
                </form>
                <!-- Supprime tout l'article du panier -->
                <form method='post'>
                    <input type='hidden' name='action'  value='supprimer'>
                    <input type='hidden' name='modele'  value='{$modele_html}'>
                    <button type='submit' class='btn-supprimer'>Supprimer</button>
                </form>
            </div>
        </div>";
    }

    echo "
        <div class='bas-panier'>
            " . ($remise ? "<p style='color:green'>Remise 10%</p>" : "") . "
            <span class='total-panier'>Total : " . number_format($total, 2) . " €</span>
            <form action='reinitialiser.php'>
                <input class='videz_panier' type='submit' value='Vider le panier'>
            </form>
        </div>
    </div>";

} else {
    echo "<p class='texte'>Votre panier est vide.</p>";
}
?>
</body>
</html>
