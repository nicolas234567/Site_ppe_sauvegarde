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

session_start();
$id_client = $_SESSION['user_id'];


$sql = "DELETE FROM stock";
if (mysqli_query($connect, $sql)) {
    echo "Bien reinitialisé";
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
}

$sql = "DELETE FROM panier WHERE id_client='$id_client'";
if (mysqli_query($connect, $sql)) {
    echo "Bien reinitialisé";
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
}

$sql = "INSERT INTO stock (id_produit, modele, quantite, prix) VALUES ('1', 'asus', '100', '700€')";
if (mysqli_query($connect, $sql)) {
    echo "Nouveau enregistrement créé avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
}
$sql = "INSERT INTO stock (id_produit, modele, quantite, prix) VALUES ('2', 'tuf', '100', '1300€')";
if (mysqli_query($connect, $sql)) {
    echo "Nouveau enregistrement créé avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
}

$sql = "INSERT INTO stock (id_produit, modele, quantite, prix) VALUES ('3', 'logitech g502', '100', '50€')";
if (mysqli_query($connect, $sql)) {
    echo "Nouveau enregistrement créé avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
}
$sql = "INSERT INTO stock (id_produit, modele, quantite, prix) VALUES ('4', 'hyper X cloud 2', '100', '100€')";
if (mysqli_query($connect, $sql)) {
    echo "Nouveau enregistrement créé avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
}

header("Location: http://localhost/site_ppe/panier.php");
?>
