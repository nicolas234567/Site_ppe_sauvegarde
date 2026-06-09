<?php
// session_start() DOIT être avant tout HTML, sinon les cookies de session ne peuvent pas être envoyés
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
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
    <nav class="bouton_centré">
        <ol>
            <li><a href="ordinateur.html">Ordinateur</a></li>
            <li><a href="péripherique.html">Péripherique</a></li>
            <li><a href="a propos de nous.html">A propos de nous</a></li>
            <li><a href="panier.php">Panier</a></li>
            <li><a href="reservation.php">Réservation</a></li>
            <li><a href="rapport.php">Rapport</a></li>
        </ol>
    </nav>

    <h1 class="texte">Connexion</h1>
    <h2 class="texte">Si vous avez été redirigé ici, connectez-vous ou créez un compte</h2>

    <?php if (isset($_SESSION['erreur_connexion'])): ?>
        <h2 class="texte" style="color:red;"><?= $_SESSION['erreur_connexion'] ?></h2>
        <?php unset($_SESSION['erreur_connexion']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['compte_creer'])): ?>
        <h2 class="texte" style="color:green;"><?= $_SESSION['compte_creer'] ?></h2>
        <?php unset($_SESSION['compte_creer']); ?>
    <?php endif; ?>

    <form method="post" action="verif_connexion.php" class="form-container">
        <input type="text"     placeholder="Nom d'utilisateur" class="form1" name="username">
        <input type="password" placeholder="Mot de passe"      class="form1" name="mdp">
        <button type="submit" class="form1">Se connecter</button>
    </form>

    <h2 class="texte"><a href="inscription.html">Pas encore de compte ? S'inscrire</a></h2>
</body>
</html>
