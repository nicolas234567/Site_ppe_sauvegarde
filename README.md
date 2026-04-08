# TechShop Paris

Site e-commerce de vente d'équipements informatiques (ordinateurs et périphériques), développé dans le cadre d'un projet PPE.

## Stack technique

- **Front-end** : HTML, CSS
- **Back-end** : PHP (sessions, formulaires, logique métier)
- **Base de données** : MySQL via MySQLi
- **Serveur local** : WampServer

## Fonctionnalités

- Catalogue produits : ordinateurs (Asus, TUF) et périphériques (HyperX, Logitech)
- Inscription et connexion utilisateur avec hashage du mot de passe (bcrypt)
- Gestion de session (connexion / déconnexion)
- Panier : ajout, modification de quantité, suppression d'articles
- Achat et gestion du stock
- Page "À propos de nous"

## Structure des fichiers

```
page_acceuil_site.html   # Page d'accueil
inscription.html/.php    # Formulaire et traitement de l'inscription
connexion.php            # Formulaire de connexion
verif_connexion.php      # Vérification des identifiants
deconnexion.php          # Destruction de session
panier.php               # Gestion du panier
achat.php                # Traitement de l'achat
asus.html / tuf.html     # Pages produit ordinateurs
hyperx.html / logitech.html  # Pages produit périphériques
style.css                # Feuille de style globale
```

## Prérequis

- WampServer (ou équivalent : XAMPP, MAMP)
- PHP >= 7.4
- MySQL

## Installation

1. Cloner le dépôt dans le dossier `www` de WampServer.
2. Créer une base de données nommée `site_ecommerce` dans phpMyAdmin.
3. Importer le schéma SQL (tables `client`, `panier`, etc.).
4. Démarrer WampServer et accéder à `http://localhost/site_ppe/page_acceuil_site.html`.

## Base de données

| Table    | Colonnes principales                                              |
|----------|-------------------------------------------------------------------|
| `client` | id_client, nom_utilisateur, mot_de_passe, nom, prenom, mail, numero |
| `panier` | id_client, modele, quantite, prix                                 |
