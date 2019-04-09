-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 29 juil. 2018 à 17:09
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `common-database`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `content_comment` varchar(140) DEFAULT NULL,
  `date_comment` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_comment` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_comment`),
  KEY `fk_comment_user1_idx` (`id_user`),
  KEY `fk_comment_tweet1_idx` (`id_tweet`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_user`, `id_tweet`, `content_comment`, `date_comment`, `delete_comment`) VALUES
(1, 7, 7, 'sisiii gros', '2018-07-29 18:54:29', 0);

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE IF NOT EXISTS `follow` (
  `id_followed` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL,
  `status_follow` tinyint(5) NOT NULL DEFAULT '1',
  KEY `fk_follow_user2_idx` (`id_follower`),
  KEY `fk_follow_user1_idx` (`id_followed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`id_followed`, `id_follower`, `status_follow`) VALUES
(2, 7, 1),
(9, 7, 1),
(8, 7, 1),
(7, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hashtag`
--

DROP TABLE IF EXISTS `hashtag`;
CREATE TABLE IF NOT EXISTS `hashtag` (
  `id_hashtag` int(11) NOT NULL AUTO_INCREMENT,
  `name_hashtag` varchar(255) NOT NULL,
  PRIMARY KEY (`id_hashtag`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `hashtag`
--

INSERT INTO `hashtag` (`id_hashtag`, `name_hashtag`) VALUES
(1, 'wac'),
(2, 'php'),
(3, 'nouille'),
(4, 'bonmarche');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `status_like` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_like`),
  KEY `fk_like_user1_idx` (`id_user`),
  KEY `fk_like_tweet1_idx` (`id_tweet`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id_like`, `id_user`, `id_tweet`, `status_like`) VALUES
(1, 7, 1, 1),
(2, 7, 2, 1),
(3, 9, 5, 1),
(4, 7, 7, 1),
(5, 2, 7, 1),
(6, 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id_media` int(11) NOT NULL AUTO_INCREMENT,
  `id_tweet` int(11) NOT NULL,
  `name_media` varchar(255) DEFAULT NULL,
  `file_media` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_media`),
  KEY `fk_media_tweet_idx` (`id_tweet`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id_media`, `id_tweet`, `name_media`, `file_media`) VALUES
(1, 1, 'img_tweet_1_id_user_7_date_2018_07_29.jpg', 'C:/wamp/www/tweet/controller/img_tweet_1_id_user_7_date_2018_07_29.jpg'),
(2, 2, 'img_tweet_2_id_user_7_date_2018_07_29.jpg', 'C:/wamp/www/tweet/controller/img_tweet_2_id_user_7_date_2018_07_29.jpg'),
(3, 1, 'img_tweet_1_id_user_9_date_2018_07_29.jpg', 'C:/wamp/www/tweet/controller/img_tweet_1_id_user_9_date_2018_07_29.jpg'),
(4, 4, 'img_tweet_4_id_user_9_date_2018_07_29.jpg', 'C:/wamp/www/tweet/controller/img_tweet_4_id_user_9_date_2018_07_29.jpg'),
(5, 5, 'img_tweet_5_id_user_9_date_2018_07_29.jpg', 'C:/wamp/www/tweet/controller/img_tweet_5_id_user_9_date_2018_07_29.jpg'),
(6, 1, 'img_tweet_1_id_user_2_date_2018_07_29.jpg', 'C:/wamp/www/tweet/controller/img_tweet_1_id_user_2_date_2018_07_29.jpg'),
(7, 7, 'img_tweet_7_id_user_2_date_2018_07_29.jpg', 'C:/wamp/www/tweet/controller/img_tweet_7_id_user_2_date_2018_07_29.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_sender` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `content_message` text,
  `date_message` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_message` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_message`),
  KEY `fk_message_user1_idx` (`id_sender`),
  KEY `fk_message_user2_idx` (`id_receiver`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `id_sender`, `id_receiver`, `content_message`, `date_message`, `delete_message`) VALUES
(1, 7, 2, 'ca va ou koi gros', '2018-07-29 18:57:21', 0),
(2, 2, 7, 'bien et toi ?', '2018-07-29 18:57:48', 0);

-- --------------------------------------------------------

--
-- Structure de la table `retweet`
--

DROP TABLE IF EXISTS `retweet`;
CREATE TABLE IF NOT EXISTS `retweet` (
  `id_retweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `date_retweet` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_retweet` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_retweet`),
  KEY `fk_retweet_user1_idx` (`id_user`),
  KEY `fk_retweet_tweet1_idx` (`id_tweet`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `retweet`
--

INSERT INTO `retweet` (`id_retweet`, `id_user`, `id_tweet`, `date_retweet`, `delete_retweet`) VALUES
(1, 2, 2, '2018-07-29 19:00:24', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

DROP TABLE IF EXISTS `tweet`;
CREATE TABLE IF NOT EXISTS `tweet` (
  `id_tweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `content_tweet` varchar(140) DEFAULT NULL,
  `date_tweet` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_tweet` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tweet`),
  KEY `fk_tweet_user1_idx` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tweet`
--

INSERT INTO `tweet` (`id_tweet`, `id_user`, `content_tweet`, `date_tweet`, `delete_tweet`) VALUES
(2, 7, 'cours php #wac #php', '2018-07-29 18:47:47', 0),
(3, 9, 'je vends des nouilles #nouille #bonmarche', '2018-07-29 18:48:55', 0),
(4, 9, '', '2018-07-29 18:49:09', 0),
(5, 9, 'je vends des nouilles !!', '2018-07-29 18:49:46', 0),
(6, 2, 'cours de capoeira', '2018-07-29 18:50:51', 0),
(7, 2, '', '2018-07-29 18:50:58', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tweet_to_tag`
--

DROP TABLE IF EXISTS `tweet_to_tag`;
CREATE TABLE IF NOT EXISTS `tweet_to_tag` (
  `id_tweet` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `status_ttt` int(11) NOT NULL DEFAULT '1',
  KEY `id_tweet` (`id_tweet`),
  KEY `id_tag` (`id_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tweet_to_tag`
--

INSERT INTO `tweet_to_tag` (`id_tweet`, `id_tag`, `status_ttt`) VALUES
(2, 1, 0),
(2, 2, 0),
(3, 3, 0),
(3, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `theme` varchar(255) NOT NULL DEFAULT '#1da1f2',
  `register_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `firstname`, `lastname`, `password`, `avatar`, `theme`, `register_date`, `status`) VALUES
(1, 'nas', 'mohamed-nassim@epitech.eu', 'mohamed nassim', 'benatou', '178c9cf7bdd47ac64ea7be6f7ce9455d13834b84', 'img_id_user_1_date_2018_07_29.jpg', '#1da1f2', '2018-07-29 18:37:05', 1),
(2, 'joe', 'joaquim.gameiro@epitech.eu', 'joaquim', 'gameiro', '178c9cf7bdd47ac64ea7be6f7ce9455d13834b84', 'img_id_user_2_date_2018_07_29.jpg', '#1da1f2', '2018-07-29 18:38:05', 1),
(3, 'mahdi', 'mahdi.camara@epitech.eu', 'mahdi', 'camara', '178c9cf7bdd47ac64ea7be6f7ce9455d13834b84', 'img_id_user_3_date_2018_07_29.jpg', '#1da1f2', '2018-07-29 18:39:16', 1),
(4, 'adams', 'adama.sanogo@epitech.eu', 'adama', 'sanogo', '178c9cf7bdd47ac64ea7be6f7ce9455d13834b84', 'img_id_user_4_date_2018_07_29.jpg', '#1da1f2', '2018-07-29 18:40:19', 1),
(5, 'dylan', 'dylan1.lobjois@epitech.eu', 'dylan', 'lobjois', '178c9cf7bdd47ac64ea7be6f7ce9455d13834b84', 'img_id_user_5_date_2018_07_29.jpg', '#1da1f2', '2018-07-29 18:41:02', 1),
(6, 'christophe', 'christophe.debese@epitech.eu', 'christophe', 'debese', '178c9cf7bdd47ac64ea7be6f7ce9455d13834b84', 'img_id_user_6_date_2018_07_29.jpg', '#1da1f2', '2018-07-29 18:41:56', 1),
(7, 'lorcann', 'lorcann.rauzduel@epitech.eu', 'lorcann', 'rauzduel', '178c9cf7bdd47ac64ea7be6f7ce9455d13834b84', 'img_id_user_7_date_2018_07_29.jpg', '#1da1f2', '2018-07-29 18:42:58', 1),
(8, 'romain', 'romain.leduc@epitech.eu', 'romain', 'leduc', 'fb4a2ba5922e13dee348cb9cfb59cb18d8136432', 'img_id_user_8_date_2018_07_29.jpg', '#1da1f2', '2018-07-29 18:43:51', 1),
(9, 'tanguy', 'tanguy.huynh@epitech.eu', 'tanguy', 'huynh', '178c9cf7bdd47ac64ea7be6f7ce9455d13834b84', 'img_id_user_9_date_2018_07_29.jpg', '#1da1f2', '2018-07-29 18:44:51', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
