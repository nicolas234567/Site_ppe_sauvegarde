<?php
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$database = "site_ecommerce"; 

$connect = mysqli_connect($host, $user, $password, $database);

if (!$connect) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

echo "Connexion réussie !";

//recuperation id client
session_start();

// Vérifie que l'utilisateur est connecté
if (empty($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

// Récupère l'ID du client connecté
$id_client = $_SESSION['user_id'];

echo "ID client : " . htmlspecialchars($id_client);

if (isset($_POST['modele'], $_POST['quantite'])) {
    $button_modele = $_POST['modele'];
    $quantite = $_POST['quantite'];
    echo "Le bouton cliqué a l'ID : " . $button_modele;

    // Sélectionner les données de la table stock pour cet ID
    $sql = "SELECT * FROM stock WHERE modele = '$button_modele'";
    $result = mysqli_query($connect, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        echo "Produit trouvé dans le stock.";
        $modele = $product['modele'];
        $prix = $product['prix'];
    } else {
        header('Location: http://localhost/site_ppe/stock_vide.html');
        exit();
    }

    // Suppression d'un produit de stock 
    $sql = "DELETE FROM stock WHERE modele = '$button_modele'"; 
    if (mysqli_query($connect, $sql)) {
        echo "Produit supprimé du stock avec succès.";
    } else {
        echo "Erreur de suppression : " . $sql . "<br>" . mysqli_error($connect);
    }

    // Insertion d'un produit dans le panier
    $sql = "INSERT INTO panier (modele, quantite, prix, id_client) VALUES ('$modele', '$quantite', '$prix', '$id_client')";
    if (mysqli_query($connect, $sql)) {
        echo "Produit ajouté au panier avec succès.";
    } else {
        echo "Erreur d'insertion : " . $sql . "<br>" . mysqli_error($connect);
    }
}
header('Location: http://localhost/site_ppe/panier.php');
?>
