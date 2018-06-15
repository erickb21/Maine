-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 15 juin 2018 à 22:48
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `meme`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categories` int(255) NOT NULL AUTO_INCREMENT,
  `cat_libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categories`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categories`, `cat_libelle`) VALUES
(1, 'Cartoon'),
(2, 'Movie'),
(3, 'Documentary'),
(4, 'Horror');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id_images` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ima_category` int(255) NOT NULL,
  `ima_title` varchar(255) NOT NULL,
  `ima_url` varchar(255) NOT NULL,
  `ima_date` varchar(255) NOT NULL,
  PRIMARY KEY (`id_images`),
  UNIQUE KEY `id_images_UNIQUE` (`id_images`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id_images`, `ima_category`, `ima_title`, `ima_url`, `ima_date`) VALUES
(1, 1, 'Mocking Spongebob', 'img/meme/mocking_spongebob.png', '1528462915'),
(2, 1, 'Batman Slapping Robin', 'img/meme/batman_slapping_robin.png', '1528549315'),
(3, 3, 'Ancient Aliens', 'img/meme/ancient_aliens.png', '1528635715'),
(4, 1, 'Futurama Fry', 'img/meme/futurama_fry.png', '1528722115'),
(5, 2, 'Leonardo Dicaprio Cheers', 'img/meme/leonardo_dicaprio_cheers.png', '1528808515'),
(6, 1, 'Mickey Mouse', 'https://i.imgflip.com/omxl3.jpg', '1528894915'),
(7, 2, 'Creepy Condescending Wonka', '	\r\nimg/meme/creepy_condescending_wonka.png', '1528722115');

-- --------------------------------------------------------

--
-- Structure de la table `memes`
--

DROP TABLE IF EXISTS `memes`;
CREATE TABLE IF NOT EXISTS `memes` (
  `id_memes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mem_title` varchar(255) NOT NULL,
  `mem_description` longtext NOT NULL,
  `mem_text` varchar(255) NOT NULL,
  `mem_blob` blob NOT NULL,
  `mem_date_creation` varchar(255) NOT NULL,
  `mem_date_update` varchar(255) NOT NULL,
  PRIMARY KEY (`id_memes`),
  UNIQUE KEY `id_memes_UNIQUE` (`id_memes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
