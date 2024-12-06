-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db-supervision
-- Généré le : mer. 04 déc. 2024 à 14:27
-- Version du serveur : 5.7.22
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `machines`
--

CREATE TABLE `machines` (
  `machine_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `max_storage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `machines`
--

INSERT INTO `machines` (`machine_id`, `name`, `max_storage`) VALUES
(1, 'PC1', 600),
(2, 'PC2', 500),
(3, 'Routeur', 400);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `FK_machine_id` int(11) NOT NULL,
  `ping` tinyint(1) DEFAULT NULL,
  `storage` int(11) DEFAULT NULL,
  `ram` int(11) DEFAULT NULL,
  `cpu` int(11) DEFAULT NULL,
  `FK_notification_type_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `notifications_type`
--

CREATE TABLE `notifications_type` (
  `notification_type_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notifications_type`
--

INSERT INTO `notifications_type` (`notification_type_id`, `type`) VALUES
(1, 'Avertissement'),
(2, 'Alerte');

-- --------------------------------------------------------

--
-- Structure de la table `ressources`
--

CREATE TABLE `ressources` (
  `ressource_id` int(11) NOT NULL,
  `FK_machine_id` int(11) NOT NULL,
  `ping` tinyint(1) DEFAULT NULL,
  `storage` int(11) DEFAULT NULL,
  `ram` int(11) DEFAULT NULL,
  `cpu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ressources_hist`
--

CREATE TABLE `ressources_hist` (
  `resource_hist_id` int(11) NOT NULL,
  `FK_resource_id` int(11) NOT NULL,
  `FK_machine_id` int(11) NOT NULL,
  `ping` tinyint(1) DEFAULT NULL,
  `storage` int(11) DEFAULT NULL,
  `ram` int(11) DEFAULT NULL,
  `cpu` int(11) DEFAULT NULL,
  `save_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`machine_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `notification_machine` (`FK_machine_id`),
  ADD KEY `notification_notif_type` (`FK_notification_type_id`);

--
-- Index pour la table `notifications_type`
--
ALTER TABLE `notifications_type`
  ADD PRIMARY KEY (`notification_type_id`);

--
-- Index pour la table `ressources`
--
ALTER TABLE `ressources`
  ADD PRIMARY KEY (`ressource_id`),
  ADD KEY `FK_ressources_machines` (`FK_machine_id`);

--
-- Index pour la table `ressources_hist`
--
ALTER TABLE `ressources_hist`
  ADD PRIMARY KEY (`resource_hist_id`),
  ADD KEY `FK_machines_ressources_hist` (`FK_machine_id`),
  ADD KEY `FK_ressources_ressources_hist` (`FK_resource_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `machines`
--
ALTER TABLE `machines`
  MODIFY `machine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications_type`
--
ALTER TABLE `notifications_type`
  MODIFY `notification_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ressources`
--
ALTER TABLE `ressources`
  MODIFY `ressource_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ressources_hist`
--
ALTER TABLE `ressources_hist`
  MODIFY `resource_hist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notification_machine` FOREIGN KEY (`FK_machine_id`) REFERENCES `machines` (`machine_id`),
  ADD CONSTRAINT `notification_notif_type` FOREIGN KEY (`FK_notification_type_id`) REFERENCES `notifications_type` (`notification_type_id`);

--
-- Contraintes pour la table `ressources`
--
ALTER TABLE `ressources`
  ADD CONSTRAINT `FK_ressources_machines` FOREIGN KEY (`FK_machine_id`) REFERENCES `machines` (`machine_id`);

--
-- Contraintes pour la table `ressources_hist`
--
ALTER TABLE `ressources_hist`
  ADD CONSTRAINT `FK_machines_ressources_hist` FOREIGN KEY (`FK_machine_id`) REFERENCES `machines` (`machine_id`),
  ADD CONSTRAINT `FK_ressources_ressources_hist` FOREIGN KEY (`FK_resource_id`) REFERENCES `ressources` (`ressource_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
