<?php
// === FICHIER : inscription.php ===

session_start();

$host     = "localhost";
$user     = "root";
$password = "";
$database = "site_ecommerce";

$connect = mysqli_connect($host, $user, $password, $database);
if (!$connect) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

$username = $_POST['username'];
$mdp      = $_POST['mdp'];
$nom      = $_POST['nom'];
$prenom   = $_POST['prenom'];
$mail     = $_POST['mail'];
$numero   = $_POST['numero'];

// Vérification que les champs ne soient pas vides
if (!empty($username) && !empty($mdp) && !empty($nom) && !empty($prenom) && !empty($mail) && !empty($numero)) {

    // Vérification si le nom d'utilisateur est déjà utilisé
    $checkUser = "SELECT * FROM client WHERE nom_utilisateur = '$username'";
    $result = mysqli_query($connect, $checkUser);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Ce nom d\'utilisateur est déjà utilisé !');
                window.location.href = 'inscription.html';
              </script>";
        exit;
    }

    // Hashage du mot de passe — jamais stocker en clair
    $mdp_hache = password_hash($mdp, PASSWORD_BCRYPT);

    // Insertion avec le mot de passe hashé
    $sql = "INSERT INTO client (id_client, nom_utilisateur, mot_de_passe, nom, prenom, mail, numero)
            VALUES (NULL, '$username', '$mdp_hache', '$nom', '$prenom', '$mail', '$numero')";

    if (mysqli_query($connect, $sql)) {
        $_SESSION['compte_creer'] = "Votre compte a bien été créé";
        header('Location: connexion.php');
        exit;
    } else {
        echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
    }

} else {
    echo "<script>
            alert('Veuillez remplir tous les champs pour vous inscrire !');
            window.location.href = 'inscription.html';
          </script>";
}
?>
