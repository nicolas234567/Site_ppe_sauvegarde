<?php

session_start();

$host = "localhost"; 
$user = "root"; 
$password = ""; 
$database = "site_ecommerce"; 

$connect = mysqli_connect($host, $user, $password, $database);

if (!$connect) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

$username = $_POST['username'];
$mdp = $_POST['mdp'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$numero = $_POST['numero'];

//verification que les champs ne soit pas vides
if (!empty($username) && !empty($mdp) && !empty($nom) && !empty($prenom) && !empty($mail) && !empty($numero)) {

//verification de si le nom d'utilisateur est deja utiliser
$checkUser = "SELECT * FROM client WHERE nom_utilisateur = '$username'";
    $result = mysqli_query($connect, $checkUser);

    if (mysqli_num_rows($result) > 0) {
        // Le nom d'utilisateur existe déjà
        echo "<script>
                alert('Ce nom d’utilisateur est déjà utilisé !');
                window.location.href = 'inscription.html';
              </script>";
        exit;
    }
//execution de linscription
$sql = "INSERT INTO client (id_client, nom_utilisateur, mot_de_passe, nom, prenom, mail, numero) VALUES (NULL , '$username', '$mdp', '$nom', '$prenom', '$mail', '$numero')";
if (mysqli_query($connect, $sql)) {
    $_SESSION['compte_creer'] = "Votre compte a bien été crée";
    header('Location: http://localhost/site_ppe/connexion.php');
    exit;
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
}
}
else{
    echo "<script>
            alert('Veuillez remplir tous les champs pour vous inscrire !');
            window.location.href = 'inscription.html';
          </script>";
}
?>
