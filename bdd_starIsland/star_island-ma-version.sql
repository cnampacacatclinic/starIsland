-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 26 juin 2023 à 16:56
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 7.4.30

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `rating_comment`, `comment_text`, `publish_date_comment`, `nickname_comment`, `id_media`) VALUES
(1, 5, 'C\'est super ! Merci pour ces excellents moments. Je suis conquise !', '2023-06-08', 'Ninon', 7),
(2, 5, 'Très bien. Un bon moment, une bonne ambiance. Je reste fidèle et ce n\'est pas pour rien.', '2023-06-25', 'Pierre', 8),
(3, 5, 'Du bon boulot. Quelle joie de jouer avec vous après une rude semaine !', '2023-06-21', 'Maurice', 9),
(4, 5, 'Très satisfait. Toujours content. Vos êtes les meilleurs ! Vraiment, c\'est sincère.', '2023-06-19', 'Carlos', 10),
(5, 4, 'Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!', '2023-06-04', 'Pseudo', 8);

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

CREATE TABLE `content` (
  `id_content` bigint(20) NOT NULL,
  `title_content` varchar(20) DEFAULT NULL,
  `description_content` text DEFAULT NULL,
  `id_page` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `content`
--

INSERT INTO `content` (`id_content`, `title_content`, `description_content`, `id_page`) VALUES
(4, 'accueil', 'fdsfsd', 1),
(5, 'team', '', 2),
(6, 'avis', 'f', 3),
(7, 'event', NULL, 4),
(8, 'rezr', 'fsdf', 5),
(9, 'bb', 'b', 6),
(10, 'cc', 'c', 7),
(11, 'CC', 'c', 8),
(12, 'dd', 'd', 9),
(13, 'gg', 'g', 10),
(14, 'uu', 'tyt', 11),
(15, 'yy', 'y', 12),
(16, 'kk', 'k', 13),
(17, 'ii', 'i', 14),
(18, 'oo', 'o', 15);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id_event` bigint(20) NOT NULL,
  `start_date_event` datetime DEFAULT NULL,
  `end_date_event` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `event_content`
--

CREATE TABLE `event_content` (
  `id_event_content` int(20) NOT NULL,
  `id_event` bigint(20) NOT NULL,
  `id_content` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `event_media`
--

CREATE TABLE `event_media` (
  `id_event_media` int(20) NOT NULL,
  `id_media` bigint(20) NOT NULL,
  `id_event` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id_media` bigint(20) NOT NULL,
  `title_media` varchar(20) DEFAULT NULL,
  `name_media` varchar(255) DEFAULT NULL,
  `id_page` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id_media`, `title_media`, `name_media`, `id_page`) VALUES
(1, 'youtube', 'https://youtube.com', 2),
(2, 'facebook', 'https://facebook.com', 2),
(3, 'twitch', 'https://twitch.fr', 2),
(4, 'instagram', 'https://instragram.com', 2),
(5, 'twitter', 'https://twitter.com', 2),
(6, 'discord', 'https://discord.com', 2),
(7, 'avatar', 'avatar-4.png', 3),
(8, 'avatar', 'avatar-3.png', 3),
(9, 'avatar', 'avatar-2.png', 3),
(10, 'avatar', 'avatar-1.png', 3);

-- --------------------------------------------------------

--
-- Structure de la table `media_media_type`
--

CREATE TABLE `media_media_type` (
  `id_media_media_type` int(20) NOT NULL,
  `id_media` bigint(20) NOT NULL,
  `id_media_type` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `media_media_type`
--

INSERT INTO `media_media_type` (`id_media_media_type`, `id_media`, `id_media_type`) VALUES
(3, 10, 2),
(4, 9, 2),
(5, 8, 2),
(6, 7, 2),
(7, 1, 1),
(8, 2, 1),
(9, 3, 1),
(10, 4, 1),
(11, 5, 1),
(12, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `media_type`
--

CREATE TABLE `media_type` (
  `id_media_type` int(20) NOT NULL,
  `title_media_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `media_type`
--

INSERT INTO `media_type` (`id_media_type`, `title_media_type`) VALUES
(1, 'reseauSocial'),
(2, 'avatar'),
(3, 'autre1'),
(4, 'autre2');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id_page` int(20) NOT NULL,
  `title_page` varchar(20) DEFAULT NULL,
  `id_content` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id_page`, `title_page`, `id_content`) VALUES
(1, 'accueil', 4),
(2, 'team', 5),
(3, 'avis', 6),
(4, 'event', 7),
(5, 'page5', 8),
(6, 'page6', 9),
(7, 'page7', 10),
(8, 'page8', 11),
(9, 'page9', 12),
(10, 'page10', 13),
(11, 'page11', 14),
(12, 'page12', 15),
(13, 'page13', 16),
(14, 'page14', 17),
(15, 'page15', 18);

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id_team` int(20) NOT NULL,
  `role_team` varchar(20) DEFAULT NULL,
  `nickname_team` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`id_team`, `role_team`, `nickname_team`) VALUES
(1, 'Admin', 'Gregory'),
(2, 'Admin', 'Camille'),
(3, 'Helpers', 'Paul'),
(4, 'Helpers', 'Pierre'),
(5, 'Helpers', 'Rachid'),
(6, 'Dévelloppeur', 'Ninon'),
(7, 'Dévelloppeur', 'Sabrina'),
(8, 'Dévelloppeur', 'Samira '),
(9, 'Dévelloppeur', 'David'),
(10, 'Dévelloppeur', 'Abdul'),
(11, 'Mappers', 'Corine '),
(12, 'Staff/Modos', 'Carlos '),
(13, 'Staff/Modos', 'Mathieu '),
(14, 'Staff/Modos', 'Laurent');

-- --------------------------------------------------------

--
-- Structure de la table `team_media`
--

CREATE TABLE `team_media` (
  `id_team_media` int(20) NOT NULL,
  `id_media` bigint(20) NOT NULL,
  `id_team` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `team_media`
--

INSERT INTO `team_media` (`id_team_media`, `id_media`, `id_team`) VALUES
(1, 6, 1),
(2, 5, 5),
(3, 6, 5),
(4, 3, 5),
(5, 4, 5),
(6, 2, 5),
(7, 1, 5),
(8, 5, 14),
(9, 3, 12),
(10, 4, 3),
(11, 2, 4),
(12, 2, 11),
(13, 2, 2),
(14, 6, 7),
(15, 6, 6),
(16, 2, 6),
(17, 4, 6),
(18, 3, 6),
(19, 2, 9),
(20, 1, 9),
(21, 3, 9),
(22, 1, 1),
(23, 2, 14),
(24, 5, 12),
(25, 10, 1),
(26, 9, 2),
(27, 8, 3),
(28, 7, 4),
(29, 10, 5),
(30, 9, 6),
(31, 8, 7),
(32, 7, 8),
(33, 10, 9),
(34, 7, 10),
(35, 9, 11),
(36, 8, 12),
(37, 8, 13),
(38, 9, 14);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  `password_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id_comment` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `content`
--
ALTER TABLE `content`
  MODIFY `id_content` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id_media` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `media_media_type`
--
ALTER TABLE `media_media_type`
  MODIFY `id_media_media_type` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `media_type`
--
ALTER TABLE `media_type`
  MODIFY `id_media_type` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id_team` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `team_media`
--
ALTER TABLE `team_media`
  MODIFY `id_team_media` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  ADD CONSTRAINT `fk_media_type_01` FOREIGN KEY (`id_media_type`) REFERENCES `media_type` (`id_media_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
