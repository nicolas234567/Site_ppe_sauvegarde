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
    <h1 class="texte">Nouveau ? Inscrivez Vous :</h1>
    <nav class="bouton_centré">
      <ol>
        <li><a href="ordinateur.html">Ordinateur</a></li>
        <li><a href="péripherique.html">Péripherique</a></li>
        <li><a href="a propos de nous.html">A propos de nous</a></li>
        <li><a href="panier.php">Panier</a></li>
      </ol>
      </nav>
      <h2 class="texte">Si vous avez été redirigé sur cette page veuillez vous connectez ou créer un compte</h2>
        <!-- Vérification de si un cookie a été utiliser pour passer une info -->
        <?php
          session_start();
            //vérif erreur connexion
            if (isset($_SESSION['erreur_connexion'])): ?>
                <h2 class="texte" style="color:red;"><?= $_SESSION['erreur_connexion']; ?></h2>
                <?php unset($_SESSION['erreur_connexion']); ?>
            <?php endif; ?>
            <!-- Validation nouvelle inscription -->
            <?php if (isset($_SESSION['compte_creer'])): ?>
                <h2 class="texte" style="color:green;"><?= $_SESSION['compte_creer']; ?></h2>
                <?php unset($_SESSION['compte_creer']); ?>
          <?php endif; ?>
      <form method="post" action="verif_connexion.php" class="texte">
        <input type="text" placeholder="nom d'utilisateur"name="username">
        <input type="text" placeholder="mot de passe" name="mdp">
        <input type="submit">
      </form>
      <h2 class="texte"><a href="inscription.html">Inscription</a></h2>
</body>
</html>