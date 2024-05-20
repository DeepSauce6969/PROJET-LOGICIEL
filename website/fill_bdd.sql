-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 18 mai 2024 à 17:02
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `capteur`
--

CREATE TABLE `capteur` (
  `Id_capteur` int(11) NOT NULL,
  `Id_residence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `capteur`
--

INSERT INTO `capteur` (`Id_capteur`, `Id_residence`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `consommation`
--

CREATE TABLE `consommation` (
  `Id_consommation` int(11) NOT NULL,
  `valeur` float DEFAULT NULL,
  `dateConsomation` datetime DEFAULT NULL,
  `Id_prise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consommation`
--

INSERT INTO `consommation` (`Id_consommation`, `valeur`, `dateConsomation`, `Id_prise`) VALUES
(1, 50, '2024-05-18 15:26:36', 1),
(2, 75, '2024-05-18 15:26:36', 2),
(3, 100, '2024-05-18 15:26:36', 3),
(6, 3, '2023-03-20 19:39:55', 1);

-- --------------------------------------------------------

--
-- Structure de la table `prise`
--

CREATE TABLE `prise` (
  `Id_prise` int(11) NOT NULL,
  `eta` tinyint(1) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `Id_residence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prise`
--

INSERT INTO `prise` (`Id_prise`, `eta`, `nom`, `Id_residence`) VALUES
(1, 1, 'Prise 1', 1),
(2, 0, 'Prise 2', 2),
(3, 1, 'Prise 3', 3),
(4, 1, 'conso instantannée', 1),
(5, 1, 'conso instantannée', 1),
(6, 1, 'conso instantannée', 1),
(7, 1, 'conso instantannée', 1),
(8, 1, 'conso instantannée', 1),
(9, 1, 'conso instantannée', 1),
(10, 1, 'conso instantannée', 1),
(11, 1, 'conso instantannée', 1),
(12, 1, 'conso instantannée', 1),
(13, 1, 'conso instantannée', 1),
(14, 1, 'conso instantannée', 1),
(15, 1, 'conso instantannée', 1),
(16, 1, 'conso instantannée', 1);

-- --------------------------------------------------------

--
-- Structure de la table `residence`
--

CREATE TABLE `residence` (
  `Id_residence` int(11) NOT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `secteur` smallint(6) DEFAULT NULL,
  `pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `residence`
--

INSERT INTO `residence` (`Id_residence`, `adresse`, `ville`, `secteur`, `pseudo`) VALUES
(1, '123 Rue de la Paix', 'Paris', 1, 'utilisateur1'),
(2, '456 Avenue des Champs-Élysées', 'Paris', 2, 'utilisateur2'),
(3, '789 Boulevard Saint-Germain', 'Paris', 3, 'utilisateur3'),
(9, '56 Je sais pas ', 'Fuveau', 13710, 'm.cuynat');

-- --------------------------------------------------------

--
-- Structure de la table `type_d`
--

CREATE TABLE `type_d` (
  `donnee` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_d`
--

INSERT INTO `type_d` (`donnee`) VALUES
('Humidité'),
('Luminosité'),
('Température');

-- --------------------------------------------------------

--
-- Structure de la table `type_d_capteur`
--

CREATE TABLE `type_d_capteur` (
  `Id_capteur` int(11) NOT NULL,
  `donnee` varchar(50) NOT NULL,
  `dateMesure` datetime DEFAULT NULL,
  `valeur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_d_capteur`
--

INSERT INTO `type_d_capteur` (`Id_capteur`, `donnee`, `dateMesure`, `valeur`) VALUES
(1, 'Température', '2024-05-18 15:26:36', 25),
(2, 'Humidité', '2024-05-18 15:26:36', 50),
(3, 'Luminosité', '2024-05-18 15:26:36', 75);

-- --------------------------------------------------------

--
-- Structure de la table `type_u`
--

CREATE TABLE `type_u` (
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_u`
--

INSERT INTO `type_u` (`type`) VALUES
('locataire'),
('proprietaire');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `pseudo` varchar(50) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `mdp` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`pseudo`, `nom`, `prenom`, `mail`, `mdp`, `type`) VALUES
('m.cuynat', 'Maxim', 'CUYNAT', 'max.cuynat2@gmail.com', '1311', 'locataire'),
('utilisateur1', 'Doe', 'John', 'john.doe@example.com', 'motdepasse', 'proprietaire'),
('utilisateur2', 'Smith', 'Jane', 'jane.smith@example.com', 'password', 'locataire'),
('utilisateur3', 'Johnson', 'Bob', 'bob.johnson@example.com', '123456', 'locataire');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `capteur`
--
ALTER TABLE `capteur`
  ADD PRIMARY KEY (`Id_capteur`),
  ADD KEY `Id_residence` (`Id_residence`);

--
-- Index pour la table `consommation`
--
ALTER TABLE `consommation`
  ADD PRIMARY KEY (`Id_consommation`),
  ADD KEY `Id_prise` (`Id_prise`);

--
-- Index pour la table `prise`
--
ALTER TABLE `prise`
  ADD PRIMARY KEY (`Id_prise`),
  ADD KEY `Id_residence` (`Id_residence`);

--
-- Index pour la table `residence`
--
ALTER TABLE `residence`
  ADD PRIMARY KEY (`Id_residence`),
  ADD KEY `pseudo` (`pseudo`);

--
-- Index pour la table `type_d`
--
ALTER TABLE `type_d`
  ADD PRIMARY KEY (`donnee`);

--
-- Index pour la table `type_d_capteur`
--
ALTER TABLE `type_d_capteur`
  ADD PRIMARY KEY (`Id_capteur`,`donnee`),
  ADD KEY `donnee` (`donnee`);

--
-- Index pour la table `type_u`
--
ALTER TABLE `type_u`
  ADD PRIMARY KEY (`type`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`pseudo`),
  ADD KEY `type` (`type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `capteur`
--
ALTER TABLE `capteur`
  MODIFY `Id_capteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `consommation`
--
ALTER TABLE `consommation`
  MODIFY `Id_consommation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `prise`
--
ALTER TABLE `prise`
  MODIFY `Id_prise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `residence`
--
ALTER TABLE `residence`
  MODIFY `Id_residence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `capteur`
--
ALTER TABLE `capteur`
  ADD CONSTRAINT `capteur_ibfk_1` FOREIGN KEY (`Id_residence`) REFERENCES `residence` (`Id_residence`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `consommation`
--
ALTER TABLE `consommation`
  ADD CONSTRAINT `consommation_ibfk_1` FOREIGN KEY (`Id_prise`) REFERENCES `prise` (`Id_prise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `prise`
--
ALTER TABLE `prise`
  ADD CONSTRAINT `prise_ibfk_1` FOREIGN KEY (`Id_residence`) REFERENCES `residence` (`Id_residence`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `residence`
--
ALTER TABLE `residence`
  ADD CONSTRAINT `residence_ibfk_1` FOREIGN KEY (`pseudo`) REFERENCES `utilisateur` (`pseudo`);

--
-- Contraintes pour la table `type_d_capteur`
--
ALTER TABLE `type_d_capteur`
  ADD CONSTRAINT `type_d_capteur_ibfk_1` FOREIGN KEY (`Id_capteur`) REFERENCES `capteur` (`Id_capteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type_d_capteur_ibfk_2` FOREIGN KEY (`donnee`) REFERENCES `type_d` (`donnee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type_u` (`type`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
