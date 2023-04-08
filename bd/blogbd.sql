-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 08 mai 2021 à 17:04
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blogbd`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(255) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(20) NOT NULL,
  `id_categorie` int(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `text`, `date`, `id_categorie`, `username`) VALUES
(12, 'dd', 'dd', '2021-05-06', 1, 'dd'),
(13, 'tt', '121', '2021-05-08', 2, 'Bizien Adam'),
(14, 'raoul', 'vs gsdhgjhs< qsgh sqgdsq kskqjg hdsqhjsqg hjsqg hjsqg sq \r\nqs hjs qghsqgs gqhqgs jqs jqsjh qsdgsqgjhqsghdg qjhdqsjhqsgjh\r\nsq qsgsqg sqghjsgd hsqghkj dgsqkg dkhsqgkjhgksqg jhqsghjsgdhjs\r\ns qhqsgjsqhghsjgsjqgsqjhgsqkdksdgsq vdhgqsvdgh sqvdqsv dvsqgdvsq\r\nsqh sqghsqgqgqshjdgjhqs gsqdgsq sqkqskhdsqhihdisbqdbbsqhsqd', '2021-05-08', 4, 'willeur');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(255) NOT NULL,
  `id_ar` int(255) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

CREATE TABLE `personnes` (
  `id` int(10) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `naissance` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `datedein` varchar(15) NOT NULL,
  `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personnes`
--

INSERT INTO `personnes` (`id`, `nom`, `prenom`, `naissance`, `email`, `pseudo`, `datedein`, `mdp`) VALUES
(60, 'bizien', 'adam', '2001-09-03', 'bizienadam@outlook.com', 'willeur', '2021-05-06 00:4', 'root'),
(61, 'chraiba', 'fatna', '2001-09-03', 'chraibafatna@outlook.com', 'ooo', '2021-05-06 00:5', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnes`
--
ALTER TABLE `personnes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `personnes`
--
ALTER TABLE `personnes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
