-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 04 juin 2023 à 21:17
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `star_island`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(20) NOT NULL,
  `rating_comment` int(11) DEFAULT NULL,
  `comment_text` text DEFAULT NULL,
  `publish_date_comment` date DEFAULT NULL,
  `nickname_comment` varchar(20) DEFAULT NULL,
  `id_media` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

CREATE TABLE `content` (
  `id_content` bigint(20) NOT NULL,
  `title_content` varchar(20) DEFAULT NULL,
  `description_content` text DEFAULT NULL,
  `id_page` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id_event` bigint(20) NOT NULL,
  `start_date_event` datetime DEFAULT NULL,
  `end_date_event` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_content`
--

CREATE TABLE `event_content` (
  `id_event_content` int(20) NOT NULL,
  `id_event` bigint(20) NOT NULL,
  `id_content` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_media`
--

CREATE TABLE `event_media` (
  `id_event_media` int(20) NOT NULL,
  `id_media` bigint(20) NOT NULL,
  `id_event` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id_media` bigint(20) NOT NULL,
  `title_media` varchar(20) DEFAULT NULL,
  `name_media` varchar(255) DEFAULT NULL,
  `id_page` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_media_type`
--

CREATE TABLE `media_media_type` (
  `id_media_media_type` int(20) NOT NULL,
  `id_media` bigint(20) NOT NULL,
  `id_media_type` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media_type`
--

CREATE TABLE `media_type` (
  `id_media_type` int(20) NOT NULL,
  `title_media_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id_page` int(20) NOT NULL,
  `title_page` varchar(20) DEFAULT NULL,
  `id_content` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id_team` int(20) NOT NULL,
  `role_team` varchar(20) DEFAULT NULL,
  `nickname_team` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `team_media`
--

CREATE TABLE `team_media` (
  `id_team_media` int(20) NOT NULL,
  `id_media` bigint(20) NOT NULL,
  `id_team` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  `password_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email_user`, `password_user`) VALUES
(1, 'cathy@icloud.com', '$2y$10$q/cSdA2w7XCBOZ8.ahaxR.scgfjrq7RRLHfppPR8abRkrHfjoNa0i');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_media` (`id_media`);

--
-- Index pour la table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id_content`),
  ADD KEY `page_id_pages` (`id_page`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `event_content`
--
ALTER TABLE `event_content`
  ADD PRIMARY KEY (`id_event_content`),
  ADD KEY `id_content` (`id_content`),
  ADD KEY `id_event` (`id_event`);

--
-- Index pour la table `event_media`
--
ALTER TABLE `event_media`
  ADD PRIMARY KEY (`id_event_media`),
  ADD KEY `id_event` (`id_event`),
  ADD KEY `id_media` (`id_media`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id_media`);

--
-- Index pour la table `media_media_type`
--
ALTER TABLE `media_media_type`
  ADD PRIMARY KEY (`id_media_media_type`),
  ADD KEY `fk_media_type_01` (`id_media_type`),
  ADD KEY `id_media` (`id_media`);

--
-- Index pour la table `media_type`
--
ALTER TABLE `media_type`
  ADD PRIMARY KEY (`id_media_type`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`),
  ADD KEY `id_content` (`id_content`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id_team`);

--
-- Index pour la table `team_media`
--
ALTER TABLE `team_media`
  ADD PRIMARY KEY (`id_team_media`),
  ADD KEY `id_media` (`id_media`),
  ADD KEY `id_team` (`id_team`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `content`
--
ALTER TABLE `content`
  MODIFY `id_content` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `event_content`
--
ALTER TABLE `event_content`
  MODIFY `id_event_content` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `event_media`
--
ALTER TABLE `event_media`
  MODIFY `id_event_media` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `media_media_type`
--
ALTER TABLE `media_media_type`
  MODIFY `id_media_media_type` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `media_type`
--
ALTER TABLE `media_type`
  MODIFY `id_media_type` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id_team` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `team_media`
--
ALTER TABLE `team_media`
  MODIFY `id_team_media` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_media_02` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `fk_page_01` FOREIGN KEY (`id_page`) REFERENCES `page` (`id_page`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `event_content`
--
ALTER TABLE `event_content`
  ADD CONSTRAINT `fk_content_01` FOREIGN KEY (`id_content`) REFERENCES `content` (`id_content`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_enent_01` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `event_media`
--
ALTER TABLE `event_media`
  ADD CONSTRAINT `fk_event_02` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_media_01` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `media_media_type`
--
ALTER TABLE `media_media_type`
  ADD CONSTRAINT `fk_media_03` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`),
  ADD CONSTRAINT `fk_media_type_01` FOREIGN KEY (`id_media_type`) REFERENCES `media_media_type` (`id_media_media_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `fk_content_04` FOREIGN KEY (`id_content`) REFERENCES `content` (`id_content`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `team_media`
--
ALTER TABLE `team_media`
  ADD CONSTRAINT `fk_media_05` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`),
  ADD CONSTRAINT `fk_team_01` FOREIGN KEY (`id_team`) REFERENCES `team` (`id_team`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
