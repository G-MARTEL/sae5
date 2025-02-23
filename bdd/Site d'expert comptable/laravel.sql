-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : lun. 17 fév. 2025 à 13:24
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
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `accounts`
--

INSERT INTO `accounts` (`account_id`, `first_name`, `last_name`, `phone`, `postal_address`, `code_address`, `city`, `picture`, `email`, `password`, `creation_date`) VALUES
(1, 'Admin', 'Admin', '06 00 00 00 00', 'Admin', 'Admin', 'Admin', '', 'admin@gmail.com', 'password', '2024-10-22 12:30:09');

-- --------------------------------------------------------

--
-- Structure de la table `actions_type`
--

CREATE TABLE `actions_type` (
  `action_type_id` int(11) NOT NULL,
  `action_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `actions_type`
--

INSERT INTO `actions_type` (`action_type_id`, `action_name`) VALUES
(0, 'UPDATE'),
(1, 'DELETE');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `FK_employee_id` int(11) DEFAULT NULL,
  `FK_account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contentdocuments`
--

CREATE TABLE `contentdocuments` (
  `contentdocument_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8_unicode_ci NOT NULL,
  `FK_createdocument_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contracts`
--

CREATE TABLE `contracts` (
  `contract_id` bigint(20) NOT NULL,
  `numero_contract` int(11) NOT NULL,
  `FK_service_id` int(11) NOT NULL,
  `FK_client_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `FK_employee_id` int(11) NOT NULL,
  `FK_client_id` int(11) NOT NULL,
  `is_active` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `createdocuments`
--

CREATE TABLE `createdocuments` (
  `createdocument_id` int(11) NOT NULL,
  `FK_employee_id` int(11) NOT NULL,
  `FK_client_id` int(11) NOT NULL,
  `facture` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FK_client_id` int(11) NOT NULL,
  `document` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `FK_function_id` int(11) NOT NULL,
  `FK_account_id` int(11) NOT NULL,
  `isactif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`employee_id`, `FK_function_id`, `FK_account_id`, `isactif`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `functions`
--

CREATE TABLE `functions` (
  `function_id` int(11) NOT NULL,
  `function_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `functions`
--

INSERT INTO `functions` (`function_id`, `function_name`) VALUES
(1, 'Admin'),
(2, 'Directeur'),
(3, 'Directeur adjoint'),
(4, 'Assistant'),
(5, 'Comptable');

-- --------------------------------------------------------

--
-- Structure de la table `log_accounts`
--

CREATE TABLE `log_accounts` (
  `log_account_id` int(11) NOT NULL,
  `FK_account_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edited_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_action_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `log_clients`
--

CREATE TABLE `log_clients` (
  `log_client_id` int(11) NOT NULL,
  `FK_client_id` int(11) DEFAULT NULL,
  `FK_account_id` int(11) DEFAULT NULL,
  `FK_employee_id` int(11) DEFAULT NULL,
  `edited_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_action_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `log_employees`
--

CREATE TABLE `log_employees` (
  `log_employee_id` int(11) NOT NULL,
  `FK_employee_id` int(11) DEFAULT NULL,
  `FK_account_id` int(11) DEFAULT NULL,
  `FK_function_id` int(11) DEFAULT NULL,
  `edited_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_action_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `log_reviews`
--

CREATE TABLE `log_reviews` (
  `log_review_id` int(11) NOT NULL,
  `FK_review_id` int(11) NOT NULL,
  `FK_account_id` int(11) DEFAULT NULL,
  `review` text COLLATE utf8_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `edited_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_action_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `FK_sender_id` int(11) NOT NULL,
  `FK_recipient_id` int(11) NOT NULL,
  `FK_conversation_id` int(11) NOT NULL,
  `FK_message_content_id` int(11) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message_contents`
--

CREATE TABLE `message_contents` (
  `message_content_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FK_account_id_recipient` int(11) NOT NULL,
  `FK_account_id_sender` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plannings`
--

CREATE TABLE `plannings` (
  `planning` int(11) NOT NULL,
  `start_time_event` time NOT NULL,
  `end_time_event` time NOT NULL,
  `Date` date NOT NULL,
  `event_type` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FK_employees` int(11) DEFAULT NULL,
  `FK_client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `quotes_request`
--

CREATE TABLE `quotes_request` (
  `quote_request_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_of_service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `FK_account_id` int(11) NOT NULL,
  `review` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `advantage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `situations` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `site_informations`
--

CREATE TABLE `site_informations` (
  `site_information_id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instagram_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `site_informations`
--

INSERT INTO `site_informations` (`site_information_id`, `company_name`, `logo`, `linkedin_link`, `facebook_link`, `instagram_link`) VALUES
(1, 'Avycompta', 'logo.png', 'linkedin.com/avycompta', 'facebook.com/avycompta', 'instagram.com/avycompta');

-- --------------------------------------------------------

--
-- Structure de la table `team_services`
--

CREATE TABLE `team_services` (
  `team_service_id` int(11) NOT NULL,
  `FK_service_id` int(11) NOT NULL,
  `FK_employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Index pour la table `actions_type`
--
ALTER TABLE `actions_type`
  ADD PRIMARY KEY (`action_type_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `FK_account_client` (`FK_account_id`),
  ADD KEY `FK_employee_client` (`FK_employee_id`);

--
-- Index pour la table `contentdocuments`
--
ALTER TABLE `contentdocuments`
  ADD PRIMARY KEY (`contentdocument_id`),
  ADD KEY `FK_contentdocument_createdocument` (`FK_createdocument_id`);

--
-- Index pour la table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `FK_contracts_client` (`FK_client_id`),
  ADD KEY `FK_contracts_service` (`FK_service_id`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`),
  ADD KEY `Conversation_FK_client` (`FK_client_id`),
  ADD KEY `Conversation_FK_employee` (`FK_employee_id`);

--
-- Index pour la table `createdocuments`
--
ALTER TABLE `createdocuments`
  ADD PRIMARY KEY (`createdocument_id`),
  ADD KEY `FK_createdocument_client` (`FK_client_id`),
  ADD KEY `FK_createdocument_employee` (`FK_employee_id`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `document_client` (`FK_client_id`);

--
-- Index pour la table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `FK_account_employees` (`FK_account_id`),
  ADD KEY `FK_function_employees` (`FK_function_id`);

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
  ADD KEY `FK_account_log` (`FK_account_id`),
  ADD KEY `FK_action_type_account` (`FK_action_type_id`);

--
-- Index pour la table `log_clients`
--
ALTER TABLE `log_clients`
  ADD PRIMARY KEY (`log_client_id`),
  ADD KEY `FK_account_log_clients` (`FK_account_id`),
  ADD KEY `FK_action_type_log_clients` (`FK_action_type_id`),
  ADD KEY `FK_client_log` (`FK_client_id`),
  ADD KEY `FK_employee_client_log` (`FK_employee_id`);

--
-- Index pour la table `log_employees`
--
ALTER TABLE `log_employees`
  ADD PRIMARY KEY (`log_employee_id`),
  ADD KEY `FK_account_log_employees` (`FK_account_id`),
  ADD KEY `FK_action_type_log_employees` (`FK_action_type_id`),
  ADD KEY `FK_employees_log` (`FK_employee_id`),
  ADD KEY `FK_function_log_employees` (`FK_function_id`);

--
-- Index pour la table `log_reviews`
--
ALTER TABLE `log_reviews`
  ADD PRIMARY KEY (`log_review_id`),
  ADD KEY `FK_account_log_review` (`FK_account_id`),
  ADD KEY `FK_action_type_log_review` (`FK_action_type`),
  ADD KEY `FK_review_log` (`FK_review_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `FK_message_conversation` (`FK_conversation_id`),
  ADD KEY `FK_message_message_content` (`FK_message_content_id`),
  ADD KEY `FK_message_account_recipient` (`FK_recipient_id`),
  ADD KEY `FK_message_account_sender` (`FK_sender_id`);

--
-- Index pour la table `message_contents`
--
ALTER TABLE `message_contents`
  ADD PRIMARY KEY (`message_content_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `FK_notification_account_sender` (`FK_account_id_sender`),
  ADD KEY `FK_notification_account_receipent` (`FK_account_id_recipient`);

--
-- Index pour la table `plannings`
--
ALTER TABLE `plannings`
  ADD PRIMARY KEY (`planning`),
  ADD KEY `FK_plannings_clients` (`FK_client_id`),
  ADD KEY `FK_planning_employees` (`FK_employees`);

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
  ADD KEY `FK_account_reviews` (`FK_account_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Index pour la table `site_informations`
--
ALTER TABLE `site_informations`
  ADD PRIMARY KEY (`site_information_id`);

--
-- Index pour la table `team_services`
--
ALTER TABLE `team_services`
  ADD PRIMARY KEY (`team_service_id`),
  ADD KEY `FK_team_services_employee` (`FK_employee_id`),
  ADD KEY `FK_team_service_service` (`FK_service_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `actions_type`
--
ALTER TABLE `actions_type`
  MODIFY `action_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contentdocuments`
--
ALTER TABLE `contentdocuments`
  MODIFY `contentdocument_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contract_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `createdocuments`
--
ALTER TABLE `createdocuments`
  MODIFY `createdocument_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `functions`
--
ALTER TABLE `functions`
  MODIFY `function_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `log_accounts`
--
ALTER TABLE `log_accounts`
  MODIFY `log_account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `log_clients`
--
ALTER TABLE `log_clients`
  MODIFY `log_client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `log_employees`
--
ALTER TABLE `log_employees`
  MODIFY `log_employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `log_reviews`
--
ALTER TABLE `log_reviews`
  MODIFY `log_review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message_contents`
--
ALTER TABLE `message_contents`
  MODIFY `message_content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `plannings`
--
ALTER TABLE `plannings`
  MODIFY `planning` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `site_informations`
--
ALTER TABLE `site_informations`
  MODIFY `site_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `team_services`
--
ALTER TABLE `team_services`
  MODIFY `team_service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `FK_account_client` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `FK_employee_client` FOREIGN KEY (`FK_employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Contraintes pour la table `contentdocuments`
--
ALTER TABLE `contentdocuments`
  ADD CONSTRAINT `FK_contentdocument_createdocument` FOREIGN KEY (`FK_createdocument_id`) REFERENCES `createdocuments` (`createdocument_id`);

--
-- Contraintes pour la table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `FK_contracts_client` FOREIGN KEY (`FK_client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `FK_contracts_service` FOREIGN KEY (`FK_service_id`) REFERENCES `services` (`service_id`);

--
-- Contraintes pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `Conversation_FK_client` FOREIGN KEY (`FK_client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `Conversation_FK_employee` FOREIGN KEY (`FK_employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Contraintes pour la table `createdocuments`
--
ALTER TABLE `createdocuments`
  ADD CONSTRAINT `FK_createdocument_client` FOREIGN KEY (`FK_client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `FK_createdocument_employee` FOREIGN KEY (`FK_employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Contraintes pour la table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `document_client` FOREIGN KEY (`FK_client_id`) REFERENCES `clients` (`client_id`);

--
-- Contraintes pour la table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `FK_account_employees` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `FK_function_employees` FOREIGN KEY (`FK_function_id`) REFERENCES `functions` (`function_id`);

--
-- Contraintes pour la table `log_accounts`
--
ALTER TABLE `log_accounts`
  ADD CONSTRAINT `FK_account_log` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `FK_action_type_account` FOREIGN KEY (`FK_action_type_id`) REFERENCES `actions_type` (`action_type_id`);

--
-- Contraintes pour la table `log_clients`
--
ALTER TABLE `log_clients`
  ADD CONSTRAINT `FK_account_log_clients` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `FK_action_type_log_clients` FOREIGN KEY (`FK_action_type_id`) REFERENCES `actions_type` (`action_type_id`),
  ADD CONSTRAINT `FK_client_log` FOREIGN KEY (`FK_client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `FK_employee_client_log` FOREIGN KEY (`FK_employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Contraintes pour la table `log_employees`
--
ALTER TABLE `log_employees`
  ADD CONSTRAINT `FK_account_log_employees` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `FK_action_type_log_employees` FOREIGN KEY (`FK_action_type_id`) REFERENCES `actions_type` (`action_type_id`),
  ADD CONSTRAINT `FK_employees_log` FOREIGN KEY (`FK_employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `FK_function_log_employees` FOREIGN KEY (`FK_function_id`) REFERENCES `functions` (`function_id`);

--
-- Contraintes pour la table `log_reviews`
--
ALTER TABLE `log_reviews`
  ADD CONSTRAINT `FK_account_log_review` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `FK_action_type_log_review` FOREIGN KEY (`FK_action_type`) REFERENCES `actions_type` (`action_type_id`),
  ADD CONSTRAINT `FK_review_log` FOREIGN KEY (`FK_review_id`) REFERENCES `reviews` (`review_id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_message_account_recipient` FOREIGN KEY (`FK_recipient_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `FK_message_account_sender` FOREIGN KEY (`FK_sender_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `FK_message_conversation` FOREIGN KEY (`FK_conversation_id`) REFERENCES `conversations` (`conversation_id`),
  ADD CONSTRAINT `FK_message_message_content` FOREIGN KEY (`FK_message_content_id`) REFERENCES `message_contents` (`message_content_id`);

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `FK_notification_account_receipent` FOREIGN KEY (`FK_account_id_recipient`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `FK_notification_account_sender` FOREIGN KEY (`FK_account_id_sender`) REFERENCES `accounts` (`account_id`);

--
-- Contraintes pour la table `plannings`
--
ALTER TABLE `plannings`
  ADD CONSTRAINT `FK_planning_employees` FOREIGN KEY (`FK_employees`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `FK_plannings_clients` FOREIGN KEY (`FK_client_id`) REFERENCES `clients` (`client_id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_account_reviews` FOREIGN KEY (`FK_account_id`) REFERENCES `accounts` (`account_id`);

--
-- Contraintes pour la table `team_services`
--
ALTER TABLE `team_services`
  ADD CONSTRAINT `FK_team_service_service` FOREIGN KEY (`FK_service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `FK_team_services_employee` FOREIGN KEY (`FK_employee_id`) REFERENCES `employees` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
