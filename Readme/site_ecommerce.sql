-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 08 avr. 2026 à 09:13
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site_ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `numero` int NOT NULL,
  `id_client` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`nom_utilisateur`, `mot_de_passe`, `nom`, `prenom`, `mail`, `numero`, `id_client`) VALUES
('testcompte', '$2y$10$Yekb1xnHCj44KV.gALdJhOsOTkWzV0VJnjdMj.78X1rj3mk6yu5z6', 'Test', 'Test', 'test@gmail.com', 6, 52);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `modele` varchar(50) NOT NULL,
  `quantite` int NOT NULL,
  `prix` varchar(50) DEFAULT NULL,
  `id_client` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`modele`, `quantite`, `prix`, `id_client`) VALUES
('tuf', 1, '1300€', 4),
('logitech g502', 1, '50€', 4);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_produit` int NOT NULL,
  `modele` varchar(50) DEFAULT NULL,
  `quantite` int NOT NULL,
  `prix` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id_produit`, `modele`, `quantite`, `prix`) VALUES
(1, 'asus', 100, '700€'),
(2, 'tuf', 100, '1300€'),
(3, 'logitech g502', 100, '50€'),
(4, 'hyper X cloud 2', 100, '100€');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
