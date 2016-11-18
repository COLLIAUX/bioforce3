-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 04 Novembre 2016 à 16:41
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bioforce3`
--
CREATE DATABASE IF NOT EXISTS `bioforce3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bioforce3`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `idCategorie` int(11) NOT NULL,
  `libCategorie` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Catégories de produits';

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`idCategorie`, `libCategorie`) VALUES
(1, 'Légumes'),
(2, 'Fruits');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `idClient` int(11) NOT NULL,
  `nomClient` varchar(30) NOT NULL,
  `prenomClient` varchar(50) NOT NULL,
  `adresseClient` varchar(100) NOT NULL,
  `cpClient` varchar(5) NOT NULL,
  `villeClient` varchar(50) NOT NULL,
  `emailClient` varchar(50) NOT NULL,
  `PassClient` varchar(62) NOT NULL,
  `token` varchar(32) NOT NULL,
  `lost` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table Clients';

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`idClient`, `nomClient`, `prenomClient`, `adresseClient`, `cpClient`, `villeClient`, `emailClient`, `PassClient`, `token`, `lost`) VALUES
(2, 'VAN DAMME', 'Jean-Claude', 'rue Freud', '75000', 'PARIS', 'philosophe@aware.com', '$2y$10$nO9ah9XueukJU/SRcSI8X.oJtvdDnAQzgBeLqPlrjduKWvBPwi8Ka', '', ''),
(3, 'NORRIS', 'Chuck', 'rue de l''Eglise', '78610', 'LE PERRAY EN YVELINES', 'ophois34@gmail.com', '$2y$10$Bct40k9kxi3crv4MEIdS.uiQNAjApsb8NQQZdtPyHJhTYE9PZdcPO', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE `panier` (
  `idClient` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `datePanier` date NOT NULL,
  `qteProduit` int(11) NOT NULL,
  `validePanier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`idClient`, `idProduit`, `datePanier`, `qteProduit`, `validePanier`) VALUES
(3, 6, '2016-11-04', 4, 0),
(3, 5, '2016-11-04', 5, 0),
(3, 2, '2016-11-04', 2, 0),
(3, 1, '2016-11-04', 2, 0);

--
-- Déclencheurs `panier`
--
DROP TRIGGER IF EXISTS `ajoutPanier`;
DELIMITER $$
CREATE TRIGGER `ajoutPanier` BEFORE INSERT ON `panier` FOR EACH ROW BEGIN
    SET NEW.datePanier = NOW();
    SET NEW.validePanier = 0;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE `produits` (
  `idProduit` int(11) NOT NULL,
  `libProduit` varchar(25) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `descProduit` text NOT NULL,
  `photoProduit` varchar(100) NOT NULL,
  `prixProduit` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Produits à vendre';

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`idProduit`, `libProduit`, `idCategorie`, `descProduit`, `photoProduit`, `prixProduit`) VALUES
(1, 'Pommes de terre', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia, risus ultricies euismod consectetur, mauris nisi facilisis turpis, semper luctus erat lacus vel metus. Quisque orci ligula, aliquet sed mauris nec, laoreet imperdiet nibh. Nam fringilla sagittis dui, et ultricies velit elementum sit amet. Proin molestie mauris nec vehicula egestas. ', 'patates.jpg', '10.50'),
(2, 'Fraises', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia, risus ultricies euismod consectetur, mauris nisi facilisis turpis, semper luctus erat lacus vel metus. Quisque orci ligula, aliquet sed mauris nec, laoreet imperdiet nibh. Nam fringilla sagittis dui, et ultricies velit elementum sit amet. Proin molestie mauris nec vehicula egestas. Fusce convallis vestibulum lectus, ac sodales felis sagittis a. Nullam auctor et dolor vitae aliquam. Aliquam at risus facilisis, convallis diam eu, vehicula lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla commodo diam ac dui congue molestie. Mauris tincidunt vehicula ligula. ', 'fraises.jpg', '18.30'),
(5, 'poireaux', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia, risus ultricies euismod consectetur, mauris nisi facilisis turpis, semper luctus erat lacus vel metus. Quisque orci ligula, aliquet sed mauris nec, laoreet imperdiet nibh. Nam fringilla sagittis dui, et ultricies velit elementum sit amet. Proin molestie mauris nec vehicula egestas. Fusce convallis vestibulum lectus, ac sodales felis sagittis a. Nullam auctor et dolor vitae aliquam. Aliquam at risus facilisis, convallis diam eu, vehicula lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; ', 'poireaux.jpg', '3.30'),
(6, 'carottes', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia, risus ultricies euismod consectetur, mauris nisi facilisis turpis, semper luctus erat lacus vel metus. Quisque orci ligula, aliquet sed mauris nec, laoreet imperdiet nibh. Nam fringilla sagittis dui, et ultricies velit elementum sit amet. Proin molestie mauris nec vehicula egestas. Fusce convallis vestibulum lectus, ac sodales felis sagittis a. Nullam auctor et dolor vitae aliquam. ', 'carottes.jpg', '3.20'),
(7, 'navets', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia, risus ultricies euismod consectetur, mauris nisi facilisis turpis, semper luctus erat lacus vel metus. Quisque orci ligula, aliquet sed mauris nec, laoreet imperdiet nibh. Nam fringilla sagittis dui, et ultricies velit elementum sit amet. Proin molestie mauris nec vehicula egestas. Fusce convallis vestibulum lectus, ac sodales felis sagittis a. Nullam auctor et dolor vitae aliquam. Aliquam at risus facilisis, convallis diam eu, vehicula lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla commodo diam ac dui congue molestie. Mauris tincidunt vehicula ligula. ', 'navets.jpg', '3.40'),
(8, 'pommes', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia, risus ultricies euismod consectetur, mauris nisi facilisis turpis, semper luctus erat lacus vel metus. Quisque orci ligula, aliquet sed mauris nec, laoreet imperdiet nibh. Nam fringilla sagittis dui, et ultricies velit elementum sit amet. Proin molestie mauris nec vehicula egestas. Fusce convallis vestibulum lectus, ac sodales felis sagittis a. Nullam auctor et dolor vitae aliquam.', 'pommesfruit.jpg', '3.10'),
(9, 'poires', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia, risus ultricies euismod consectetur, mauris nisi facilisis turpis, semper luctus erat lacus vel metus. Quisque orci ligula, aliquet sed mauris nec, laoreet imperdiet nibh. Nam fringilla sagittis dui, et ultricies velit elementum sit amet.', 'poires.jpg', '3.00'),
(10, 'bananes', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia, risus ultricies euismod consectetur, mauris nisi facilisis turpis, semper luctus erat lacus vel metus. Quisque orci ligula, aliquet sed mauris nec, laoreet imperdiet nibh.', 'bananes.jpg', '1.50');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`idClient`),
  ADD UNIQUE KEY `emailClient` (`emailClient`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD KEY `clientProduit` (`idClient`,`idProduit`),
  ADD KEY `idProduit` (`idProduit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `categorie` (`idCategorie`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `clients` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categories` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
