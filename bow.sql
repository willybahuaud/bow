-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 14 Juin 2013 à 07:10
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bow`
--

-- --------------------------------------------------------

--
-- Structure de la table `logon`
--

CREATE TABLE IF NOT EXISTS `logon` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `useremail` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `userlevel` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `test_users`
--

CREATE TABLE IF NOT EXISTS `test_users` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id utilisateur',
  `name` varchar(80) NOT NULL COMMENT 'login utilisateur',
  `passwd` varchar(250) NOT NULL COMMENT 'mot de passe',
  `nicename` varchar(250) NOT NULL COMMENT 'peut être plusieurs mots',
  `firstname` varchar(80) NOT NULL COMMENT 'prénom',
  `lastname` varchar(80) NOT NULL COMMENT 'nom de famille',
  `email` text NOT NULL COMMENT 'email utilisateur',
  `passwd_recup` varchar(250) NOT NULL COMMENT 'phrase d''indice pour retrouver mot de passe',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='la table pour stocker les infos des utilisateurs' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
