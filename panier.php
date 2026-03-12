<?php
session_start();

// Vérifie que l'utilisateur est connecté
if (empty($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

// Récupère l'ID du client connecté
$id_client = $_SESSION['user_id'];
$username_client = $_SESSION['username'];

echo "Nom de Compte : " . htmlspecialchars($username_client);
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
    <h1 class="texte">Voici votre panier</h1>
    <nav class="bouton_centré">
        <ol>
          <li><a href="ordinateur.html">Ordinateur</a></li>
          <li><a href="péripherique.html">Péripherique</a></li>
          <li><a href="a propos de nous.html">A propos de nous</a></li>
          <li><a href="panier.php">Panier</a></li>
        </ol>
      </nav>
      <?php
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$database = "site_ecommerce"; 

$connect = mysqli_connect($host, $user, $password, $database);

if (!$connect) {
    die("Échec de la connexion : " . mysqli_connect_error());
}


//Ajout au panier
$sql = "SELECT * FROM panier WHERE id_client='$id_client'";
$result = mysqli_query($connect, $sql);
if ($result) {
    echo "<div class='panier'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='item'>";
        echo "<p><strong>Modèle :</strong> " . $row['modele'] . "</p>";
        echo "<p><strong>Quantité :</strong> " . $row['quantite'] . "</p>";
        echo "<p><strong>Prix :</strong> " . $row['prix'] . "</p>";
        echo "</div>";}
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
}
//Calcul du total
$total = 0;
mysqli_data_seek($result, 0);

while ($row = mysqli_fetch_assoc($result)) {
    $prix = floatval($row['prix']);
    $quantite = (int)$row['quantite'];
    $total += $prix * $quantite;
}

echo "<h2>Total du panier : " . $total . " €</h2>"
?>
    <div>
      <form action="reinitialiser.php">
        <input class="videz_panier" type="submit" value="videz le panier" id="input_panier">
    </form>
    </div>
</body>
</html>