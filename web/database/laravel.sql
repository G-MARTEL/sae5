-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : ven. 11 oct. 2024 à 11:46
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
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `postal_address` varchar(255) NOT NULL,
  `code_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `actions_type`
--

CREATE TABLE `actions_type` (
  `action_type_id` int(11) NOT NULL,
  `action_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `functions`
--

CREATE TABLE `functions` (
  `function_id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `log_accounts`
--

CREATE TABLE `log_accounts` (
  `log_account_id` int(11) NOT NULL,
  `FK_account_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `postal_address` varchar(255) DEFAULT NULL,
  `code_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `edited_date` date NOT NULL,
  `FK_action_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `log_reviews`
--

CREATE TABLE `log_reviews` (
  `log_review_id` int(11) NOT NULL,
  `FK_review_id` int(11) NOT NULL,
  `FK_account_id` int(11) NOT NULL,
  `review` text,
  `status` int(11) DEFAULT NULL,
  `edited_date` date NOT NULL,
  `FK_action_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `log_site_contents`
--

CREATE TABLE `log_site_contents` (
  `log_site_content_id` int(11) NOT NULL,
  `FK_site content_id` int(11) NOT NULL,
  `FK_page_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `edited_date` date NOT NULL,
  `FK_action_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `log_team_members`
--

CREATE TABLE `log_team_members` (
  `log_team_member_id` int(11) NOT NULL,
  `FK_team_member_id` int(11) NOT NULL,
  `FK_function_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `edited_date` date NOT NULL,
  `FK_action_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `quotes_request`
--

CREATE TABLE `quotes_request` (
  `quote_request_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type_of_service` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `FK_account_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `site_contents`
--

CREATE TABLE `site_contents` (
  `site_content_id` int(11) NOT NULL,
  `FK_page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `site_informations`
--

CREATE TABLE `site_informations` (
  `site_information_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `linkedin_link` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `instagram_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `team_members`
--

CREATE TABLE `team_members` (
  `team_member_id` int(11) NOT NULL,
  `FK_function_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Index pour la table `actions_type`
--
ALTER TABLE `actions_type`
  ADD PRIMARY KEY (`action_type_id`);

--
-- Index pour la table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`function_id`);

--
-- Index pour la table `log_accounts`
--
ALTER TABLE `log_accounts`
  ADD PRIMARY KEY (`log_account_id`),
  ADD KEY `fk_log_accounts_account` (`FK_account_id`),
  ADD KEY `fk_log_accounts_action_type` (`FK_action_type`);

--
-- Index pour la table `log_reviews`
--
ALTER TABLE `log_reviews`
  ADD PRIMARY KEY (`log_review_id`),
  ADD KEY `fk_log_review_review` (`FK_review_id`),
  ADD KEY `fk_log_review_account` (`FK_account_id`),
  ADD KEY `fk_log_review_action_type` (`FK_action_type`);

--
-- Index pour la table `log_site_contents`
--
ALTER TABLE `log_site_contents`
  ADD PRIMARY KEY (`log_site_content_id`),
  ADD KEY `fk_log_site_contents_site_contents` (`FK_site content_id`),
  ADD KEY `fk_log_site_contents_pages` (`FK_page_id`),
  ADD KEY `fk_log_site_contents_action_type` (`FK_action_type`);

--
-- Index pour la table `log_team_members`
--
ALTER TABLE `log_team_members`
  ADD PRIMARY KEY (`log_team_member_id`),
  ADD KEY `fk_log_team_members_team_members` (`FK_team_member_id`),
  ADD KEY `fk_log_team_members_function` (`FK_function_id`),
  ADD KEY `fk_log_team_members_action_type` (`FK_action_type`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Index pour la table `quotes_request`
--
ALTER TABLE `quotes_request`
  ADD PRIMARY KEY (`quote_request_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_reviews_accounts` (`FK_account_id`);

--
-- Index pour la table `site_contents`
--
ALTER TABLE `site_contents`
  ADD PRIMARY KEY (`site_content_id`),
  ADD KEY `fk_site_contents_pages` (`FK_page_id`);

--
-- Index pour la table `site_informations`
--
ALTER TABLE `site_informations`
  ADD PRIMARY KEY (`site_information_id`);

--
-- Index pour la table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`team_member_id`),
  ADD KEY `fk_team_members_functions` (`FK_function_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `actions_type`
--
ALTER TABLE `actions_type`
  MODIFY `action_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `functions`
--
ALTER TABLE `functions`
  MODIFY `function_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `log_accounts`
--
ALTER TABLE `log_accounts`
  MODIFY `log_account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `log_reviews`
--
ALTER TABLE `log_reviews`
  MODIFY `log_review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `log_site_contents`
--
ALTER TABLE `log_site_contents`
  MODIFY `log_site_content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `log_team_members`
--
ALTER TABLE `log_team_members`
  MODIFY `log_team_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `quotes_request`
--
ALTER TABLE `quotes_request`
  MODIFY `quote_request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `site_contents`
--
ALTER TABLE `site_contents`
  MODIFY `site_content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `site_informations`
--
ALTER TABLE `site_informations`
  MODIFY `site_information_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `team_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `log_accounts`
--
ALTER TABLE `log_accounts`
  ADD CONSTRAINT `fk_log_accounts_account` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `fk_log_accounts_action_type` FOREIGN KEY (`FK_action_type`) REFERENCES `actions_type` (`action_type_id`);

--
-- Contraintes pour la table `log_reviews`
--
ALTER TABLE `log_reviews`
  ADD CONSTRAINT `fk_log_review_account` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `fk_log_review_action_type` FOREIGN KEY (`FK_action_type`) REFERENCES `actions_type` (`action_type_id`),
  ADD CONSTRAINT `fk_log_review_review` FOREIGN KEY (`FK_review_id`) REFERENCES `reviews` (`review_id`);

--
-- Contraintes pour la table `log_site_contents`
--
ALTER TABLE `log_site_contents`
  ADD CONSTRAINT `fk_log_site_contents_action_type` FOREIGN KEY (`FK_action_type`) REFERENCES `actions_type` (`action_type_id`),
  ADD CONSTRAINT `fk_log_site_contents_pages` FOREIGN KEY (`FK_page_id`) REFERENCES `pages` (`page_id`),
  ADD CONSTRAINT `fk_log_site_contents_site_contents` FOREIGN KEY (`FK_site content_id`) REFERENCES `site_contents` (`site_content_id`);

--
-- Contraintes pour la table `log_team_members`
--
ALTER TABLE `log_team_members`
  ADD CONSTRAINT `fk_log_team_members_action_type` FOREIGN KEY (`FK_action_type`) REFERENCES `actions_type` (`action_type_id`),
  ADD CONSTRAINT `fk_log_team_members_function` FOREIGN KEY (`FK_function_id`) REFERENCES `functions` (`function_id`),
  ADD CONSTRAINT `fk_log_team_members_team_members` FOREIGN KEY (`FK_team_member_id`) REFERENCES `team_members` (`team_member_id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_accounts` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`);

--
-- Contraintes pour la table `site_contents`
--
ALTER TABLE `site_contents`
  ADD CONSTRAINT `fk_site_contents_pages` FOREIGN KEY (`FK_page_id`) REFERENCES `pages` (`page_id`);

--
-- Contraintes pour la table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `fk_team_members_functions` FOREIGN KEY (`FK_function_id`) REFERENCES `functions` (`function_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;