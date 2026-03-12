-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 12 mars 2026 à 11:15
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
  `mot_de_passe` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `numero` int NOT NULL,
  `id_client` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`nom_utilisateur`, `mot_de_passe`, `nom`, `prenom`, `mail`, `numero`, `id_client`) VALUES
('1', '1', '1', '1', '1', 1, 2),
('2', '2', '2', '2', '2', 2, 4),
('test', 'Testppe1mdp!', '3', '3', '3', 3, 5),
('nic', '1234', 'c', 'cc', 'c', 0, 6),
('6', '6', '6', '6', '6', 6, 7),
('7', '7', '7', '7', '7', 7, 8),
('8', '8', '78', '78', '8', 8, 9),
('75', '75', '75', '57', '57', 57, 10),
('n', 'n', 'n', 'n', 'n', 0, 11),
('g', 'g', 'g', 'g', 'g', 0, 12),
('t', 't', 't', 't', 't', 0, 13),
('lm', 'lm', 'm', 'm', 'm', 0, 14),
('23', '23', '165', '51+', '1+', 15, 15),
('nkj', 'jln', 'oh', 'jbo', 'oi', 0, 16),
('nhui', 'vibj', 'viyl', 'ou', 'igyll', 0, 17),
('jkl', 'mj', '5', '5', '5', 5, 18),
(',l', ';,', ';', ';', ';', 0, 19),
('jk', 'kk', 'lll', 'jkb', 'jbkj', 0, 20),
('kbj', 'kjb', '11', '1', '1', 1, 21),
('b;', 'j', 'n', 'n', 'n', 0, 22),
('vjhhkbmlnmn', 'hvlbkmj', 'jlnk', 'kjl!n', 'bnml', 0, 23),
(';k:', 'bkjml', 'bimoj', ' hk', 'lbkmj', 0, 24),
('jhjkjk', 'J', 'hjkljjk', 'hjkhjkjk', 'ljjkkjlb', 0, 25),
('biumo', 'blim', 'Nes', 'Nes', 'svdv.edu', 6, 26),
('gsgd', 'Nicolas1414.14sgsg', 'Test', 'Test', 'ggegge.edu', 6, 27),
('esh', 'hsjy', 'shrj', 'hjsf', 'jstd', 0, 28),
('ztzqehsrts', 'qhtsrhr', 'qehdq', 'hqrthqrt', 'qhsrh', 0, 29),
('efzqethsrynae', 'eggqehts', 'qhrsths', 'hrshrsh', 'shhbgf', 0, 30),
('zgqethsdtufjuyhrqe', 'qrsjtdkuysqyursjtyk', 'rrstkduyliuk', 'qrstkudyl', 'qurstkdyl', 0, 31),
('fgeqsg', 'gqrgdsgs', 'gdqfgfqdf', 'gqdfqg', 'gqgdfgqd', 0, 32),
('zqgteqdg', 'qgfdqqgfd', 'qgdgfqdfg', 'qdgqdfgqd', 'gqdgqdf', 0, 33),
('tyzretyd', 'ysryjtu', 'qhrstj', 'qhtrsy', 'qhrtsn', 0, 34),
('tERQTRH', 'zteyshtr', 'qhet', 'gqethq', 'hqtrsgrs', 0, 35),
('dgfdsgztre', 'gfdfq', 'gfqdgqd', 'gdfgqd', 'gqfgqdd', 0, 36),
('sgqsfq', 'qdgqgd', 'gqsdgqsdg', 'gqdqgsdg', 'dgqdqggd', 0, 37),
('ter', 'terte', 'tert', 'tere', 'ter', 0, 38),
('zrzrz', 'erzzer', 'rezrz', 'rezrz', 'rezrz', 0, 39),
('ezaze', 'zeaea', 'ezae', 'ezae', 'eazaez', 0, 40),
('zeaazeae', 'ezaazezaze', 'eazea', 'ezaea', 'eazeazeaze', 0, 41);

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
('asus', 5, '700€', 2),
('tuf', 1, '1300€', 4),
('logitech g502', 1, '50€', 4),
('logitech g502', 3, '50€', 2);

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
(2, 'tuf', 100, '1300€'),
(4, 'hyper X cloud 2', 100, '100€');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
