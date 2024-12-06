-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 28 nov. 2024 à 11:49
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

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
-- Structure de la table `etablissements`
--

DROP TABLE IF EXISTS `etablissements`;
CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `introduction` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `nom`, `description`, `introduction`, `image`) VALUES
(1, 'Etablissement 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, scelerisque pretium ex congue in. Phasellus quis dolor ac arcu dignissim tempus. Pellentesque eget libero sem. Quisque sagittis vel tellus vel congue. Ut quis malesuada magna. Maecenas id diam vestibulum, tempor tellus non, dapibus velit. Mauris pellentesque viverra erat ac congue. Proin vel elementum sapien. Donec vitae nibh velit.\r\n\r\nSed egestas leo eu nulla porttitor, nec dignissim velit ullamcorper. Aliquam rhoncus sem sit amet mauris vehicula mollis. Integer ultricies arcu at lectus condimentum cursus. Mauris velit turpis, mattis eget facilisis vitae, vestibulum non nisl. Maecenas facilisis metus luctus, volutpat turpis vel, tristique lacus. Morbi molestie ac mi at elementum. Pellentesque vel libero malesuada ex consectetur rutrum ut eget arcu. Ut sed sollicitudin mi. Vivamus euismod sapien at consectetur blandit. Etiam nec tristique nulla. Nullam in sem ac dui pulvinar sodales. Morbi congue sit amet magna id porttitor. Donec in dignissim dolor. Nunc et magna nec dui volutpat facilisis nec sodales orci. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, ', 'image.jpg'),
(2, 'Etablissement 2', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, scelerisque pretium ex congue in. Phasellus quis dolor ac arcu dignissim tempus. Pellentesque eget libero sem. Quisque sagittis vel tellus vel congue. Ut quis malesuada magna. Maecenas id diam vestibulum, tempor tellus non, dapibus velit. Mauris pellentesque viverra erat ac congue. Proin vel elementum sapien. Donec vitae nibh velit.\r\n\r\nSed egestas leo eu nulla porttitor, nec dignissim velit ullamcorper. Aliquam rhoncus sem sit amet mauris vehicula mollis. Integer ultricies arcu at lectus condimentum cursus. Mauris velit turpis, mattis eget facilisis vitae, vestibulum non nisl. Maecenas facilisis metus luctus, volutpat turpis vel, tristique lacus. Morbi molestie ac mi at elementum. Pellentesque vel libero malesuada ex consectetur rutrum ut eget arcu. Ut sed sollicitudin mi. Vivamus euismod sapien at consectetur blandit. Etiam nec tristique nulla. Nullam in sem ac dui pulvinar sodales. Morbi congue sit amet magna id porttitor. Donec in dignissim dolor. Nunc et magna nec dui volutpat facilisis nec sodales orci. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, ', 'image.jpg'),
(4, 'Etablissement 3', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, scelerisque pretium ex congue in. Phasellus quis dolor ac arcu dignissim tempus. Pellentesque eget libero sem. Quisque sagittis vel tellus vel congue. Ut quis malesuada magna. Maecenas id diam vestibulum, tempor tellus non, dapibus velit. Mauris pellentesque viverra erat ac congue. Proin vel elementum sapien. Donec vitae nibh velit.\r\n\r\nSed egestas leo eu nulla porttitor, nec dignissim velit ullamcorper. Aliquam rhoncus sem sit amet mauris vehicula mollis. Integer ultricies arcu at lectus condimentum cursus. Mauris velit turpis, mattis eget facilisis vitae, vestibulum non nisl. Maecenas facilisis metus luctus, volutpat turpis vel, tristique lacus. Morbi molestie ac mi at elementum. Pellentesque vel libero malesuada ex consectetur rutrum ut eget arcu. Ut sed sollicitudin mi. Vivamus euismod sapien at consectetur blandit. Etiam nec tristique nulla. Nullam in sem ac dui pulvinar sodales. Morbi congue sit amet magna id porttitor. Donec in dignissim dolor. Nunc et magna nec dui volutpat facilisis nec sodales orci. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, ', 'image.jpg'),
(5, 'Etablissement 4', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, scelerisque pretium ex congue in. Phasellus quis dolor ac arcu dignissim tempus. Pellentesque eget libero sem. Quisque sagittis vel tellus vel congue. Ut quis malesuada magna. Maecenas id diam vestibulum, tempor tellus non, dapibus velit. Mauris pellentesque viverra erat ac congue. Proin vel elementum sapien. Donec vitae nibh velit.\r\n\r\nSed egestas leo eu nulla porttitor, nec dignissim velit ullamcorper. Aliquam rhoncus sem sit amet mauris vehicula mollis. Integer ultricies arcu at lectus condimentum cursus. Mauris velit turpis, mattis eget facilisis vitae, vestibulum non nisl. Maecenas facilisis metus luctus, volutpat turpis vel, tristique lacus. Morbi molestie ac mi at elementum. Pellentesque vel libero malesuada ex consectetur rutrum ut eget arcu. Ut sed sollicitudin mi. Vivamus euismod sapien at consectetur blandit. Etiam nec tristique nulla. Nullam in sem ac dui pulvinar sodales. Morbi congue sit amet magna id porttitor. Donec in dignissim dolor. Nunc et magna nec dui volutpat facilisis nec sodales orci. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, ', 'image.jpg'),
(6, 'Etablissement 5', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, scelerisque pretium ex congue in. Phasellus quis dolor ac arcu dignissim tempus. Pellentesque eget libero sem. Quisque sagittis vel tellus vel congue. Ut quis malesuada magna. Maecenas id diam vestibulum, tempor tellus non, dapibus velit. Mauris pellentesque viverra erat ac congue. Proin vel elementum sapien. Donec vitae nibh velit.\r\n\r\nSed egestas leo eu nulla porttitor, nec dignissim velit ullamcorper. Aliquam rhoncus sem sit amet mauris vehicula mollis. Integer ultricies arcu at lectus condimentum cursus. Mauris velit turpis, mattis eget facilisis vitae, vestibulum non nisl. Maecenas facilisis metus luctus, volutpat turpis vel, tristique lacus. Morbi molestie ac mi at elementum. Pellentesque vel libero malesuada ex consectetur rutrum ut eget arcu. Ut sed sollicitudin mi. Vivamus euismod sapien at consectetur blandit. Etiam nec tristique nulla. Nullam in sem ac dui pulvinar sodales. Morbi congue sit amet magna id porttitor. Donec in dignissim dolor. Nunc et magna nec dui volutpat facilisis nec sodales orci. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan ipsum non eros efficitur, quis bibendum felis bibendum. In vitae porttitor neque. Nam blandit, velit id iaculis ullamcorper, lacus mi interdum risus, a euismod turpis enim sit amet lectus. Maecenas sagittis eros non aliquam finibus. Suspendisse aliquam metus nisi, ', 'image.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
