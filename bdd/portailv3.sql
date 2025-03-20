-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 20 mars 2025 à 15:01
-- Version du serveur : 8.3.0
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `portail`
--
CREATE DATABASE IF NOT EXISTS `portail` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `portail`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$Xu9GNDkcBP5Aa4shcuXaXe8qFIJrh9nIpeRFh.yw7qCSqyFm.z9pC');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Supérieur'),
(2, 'Secondaire'),
(3, 'Primaire');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `lastname`, `firstname`, `email`, `message`, `date`) VALUES
(1, 'Berti', 'Jordan', 'berti@epse.be', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2025-03-20 15:34:24'),
(3, 'Berti', 'Jordan', 'jordan@epse.be', 'un petit message de test\r\nun retour à la ligne', '2025-03-20 15:57:47');

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

DROP TABLE IF EXISTS `etablissements`;
CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `introduction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `categorie` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `nom`, `description`, `introduction`, `image`, `categorie`) VALUES
(1, 'Etablissement 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, scelerisque pretium ex congue in. Phasellus quis dolor ac arcu dignissim tempus. Pellentesque eget libero sem. Quisque sagittis vel tellus vel congue. Ut quis malesuada magna. Maecenas id diam vestibulum, tempor tellus non, dapibus velit. Mauris pellentesque viverra erat ac congue. Proin vel elementum sapien. Donec vitae nibh velit.\r\n\r\nSed egestas leo eu nulla porttitor, nec dignissim velit ullamcorper. Aliquam rhoncus sem sit amet mauris vehicula mollis. Integer ultricies arcu at lectus condimentum cursus. Mauris velit turpis, mattis eget facilisis vitae, vestibulum non nisl. Maecenas facilisis metus luctus, volutpat turpis vel, tristique lacus. Morbi molestie ac mi at elementum. Pellentesque vel libero malesuada ex consectetur rutrum ut eget arcu. Ut sed sollicitudin mi. Vivamus euismod sapien at consectetur blandit. Etiam nec tristique nulla. Nullam in sem ac dui pulvinar sodales. Morbi congue sit amet magna id porttitor. Donec in dignissim dolor. Nunc et magna nec dui volutpat facilisis nec sodales orci. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, ', 'image.jpg', 1),
(4, 'Etablissement 3', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, scelerisque pretium ex congue in. Phasellus quis dolor ac arcu dignissim tempus. Pellentesque eget libero sem. Quisque sagittis vel tellus vel congue. Ut quis malesuada magna. Maecenas id diam vestibulum, tempor tellus non, dapibus velit. Mauris pellentesque viverra erat ac congue. Proin vel elementum sapien. Donec vitae nibh velit.\r\n\r\nSed egestas leo eu nulla porttitor, nec dignissim velit ullamcorper. Aliquam rhoncus sem sit amet mauris vehicula mollis. Integer ultricies arcu at lectus condimentum cursus. Mauris velit turpis, mattis eget facilisis vitae, vestibulum non nisl. Maecenas facilisis metus luctus, volutpat turpis vel, tristique lacus. Morbi molestie ac mi at elementum. Pellentesque vel libero malesuada ex consectetur rutrum ut eget arcu. Ut sed sollicitudin mi. Vivamus euismod sapien at consectetur blandit. Etiam nec tristique nulla. Nullam in sem ac dui pulvinar sodales. Morbi congue sit amet magna id porttitor. Donec in dignissim dolor. Nunc et magna nec dui volutpat facilisis nec sodales orci. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, ', 'image.jpg', 1),
(5, 'Etablissement 4', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, scelerisque pretium ex congue in. Phasellus quis dolor ac arcu dignissim tempus. Pellentesque eget libero sem. Quisque sagittis vel tellus vel congue. Ut quis malesuada magna. Maecenas id diam vestibulum, tempor tellus non, dapibus velit. Mauris pellentesque viverra erat ac congue. Proin vel elementum sapien. Donec vitae nibh velit.\r\n\r\nSed egestas leo eu nulla porttitor, nec dignissim velit ullamcorper. Aliquam rhoncus sem sit amet mauris vehicula mollis. Integer ultricies arcu at lectus condimentum cursus. Mauris velit turpis, mattis eget facilisis vitae, vestibulum non nisl. Maecenas facilisis metus luctus, volutpat turpis vel, tristique lacus. Morbi molestie ac mi at elementum. Pellentesque vel libero malesuada ex consectetur rutrum ut eget arcu. Ut sed sollicitudin mi. Vivamus euismod sapien at consectetur blandit. Etiam nec tristique nulla. Nullam in sem ac dui pulvinar sodales. Morbi congue sit amet magna id porttitor. Donec in dignissim dolor. Nunc et magna nec dui volutpat facilisis nec sodales orci. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, ', 'image.jpg', 2),
(6, 'Etablissement 5', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, scelerisque pretium ex congue in. Phasellus quis dolor ac arcu dignissim tempus. Pellentesque eget libero sem. Quisque sagittis vel tellus vel congue. Ut quis malesuada magna. Maecenas id diam vestibulum, tempor tellus non, dapibus velit. Mauris pellentesque viverra erat ac congue. Proin vel elementum sapien. Donec vitae nibh velit.\r\n\r\nSed egestas leo eu nulla porttitor, nec dignissim velit ullamcorper. Aliquam rhoncus sem sit amet mauris vehicula mollis. Integer ultricies arcu at lectus condimentum cursus. Mauris velit turpis, mattis eget facilisis vitae, vestibulum non nisl. Maecenas facilisis metus luctus, volutpat turpis vel, tristique lacus. Morbi molestie ac mi at elementum. Pellentesque vel libero malesuada ex consectetur rutrum ut eget arcu. Ut sed sollicitudin mi. Vivamus euismod sapien at consectetur blandit. Etiam nec tristique nulla. Nullam in sem ac dui pulvinar sodales. Morbi congue sit amet magna id porttitor. Donec in dignissim dolor. Nunc et magna nec dui volutpat facilisis nec sodales orci. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, ', 'image.jpg', 1),
(7, 'test avec image', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'une petite introduction', '1317091091diablo.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fichier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_etablissement` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `fichier`, `id_etablissement`) VALUES
(1, 'image2.jpg', 1),
(2, 'image2.jpg', 1),
(11, '1446538724179383185729681.6571c0f843cea.jpg', 15),
(10, '10802514tonale2.jpg', 15),
(9, '1234105939Alfa-Romeo-Tonale-Concept-01.jpg', 15),
(12, '1378042143tonale2.jpg', 16),
(13, '1867528185tonale3.jpeg', 16),
(14, '2046693993design-header.jpg', 16);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
