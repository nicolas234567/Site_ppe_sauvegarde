<?php
session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

$id_client = $_SESSION['user_id'];

$host     = "localhost";
$user     = "root";
$password = "";
$database = "site_ecommerce";

$connect = mysqli_connect($host, $user, $password, $database);
if (!$connect) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

if (isset($_POST['modele'], $_POST['quantite'])) {
    $modele   = mysqli_real_escape_string($connect, $_POST['modele']);
    $quantite = (int)$_POST['quantite'];

    // Récupère le prix et le blocage depuis le stock
    $res_stock = mysqli_query($connect, "SELECT prix, UNIX_TIMESTAMP(duree_blocage) as blocage_ts, UNIX_TIMESTAMP(NOW()) as now_ts FROM stock WHERE modele = '$modele' LIMIT 1");
    if (!$res_stock || mysqli_num_rows($res_stock) === 0) {
        header('Location: stock_vide.html');
        exit;
    }
    $row_stock = mysqli_fetch_assoc($res_stock);
    $prix = (float)$row_stock['prix'];

    // Vérifie si le produit est réservé
    if (!empty($row_stock['blocage_ts']) && $row_stock['blocage_ts'] > $row_stock['now_ts']) {
        $restant = $row_stock['blocage_ts'] - $row_stock['now_ts'];
        $min = floor($restant / 60);
        $sec = $restant % 60;
        echo "<script>alert('Ce produit est réservé. Temps restant : {$min}min {$sec}s'); history.back();</script>";
        exit;
    }

    // Si déjà dans le panier, on augmente la quantité ; sinon on insère
    $res = mysqli_query($connect, "SELECT modele FROM panier WHERE modele='$modele' AND id_client='$id_client'");
    if ($res && mysqli_num_rows($res) > 0) {
        mysqli_query($connect, "UPDATE panier SET quantite = quantite + $quantite WHERE modele='$modele' AND id_client='$id_client'");
    } else {
        mysqli_query($connect, "INSERT INTO panier (modele, quantite, prix, id_client) VALUES ('$modele', $quantite, $prix, '$id_client')");
    }
}

header('Location: panier.php');
exit;
?>
