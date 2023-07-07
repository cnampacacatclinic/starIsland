-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 07 juil. 2023 à 10:48
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
  `comment_text` varchar(120) DEFAULT NULL,
  `publish_date_comment` date DEFAULT NULL,
  `nickname_comment` varchar(20) DEFAULT NULL,
  `id_media` bigint(20) DEFAULT NULL,
  `activated` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `rating_comment`, `comment_text`, `publish_date_comment`, `nickname_comment`, `id_media`, `activated`) VALUES
(1, 5, 'C\'est super ! Merci pour ces excellents moments. Je suis conquise !', '2023-06-08', 'Ninon', 7, 1),
(2, 5, 'Très bien. Un bon moment, une bonne ambiance. Je reste fidèle et ce n\'est pas pour rien.', '2023-06-25', 'Pierre', 8, 1),
(3, 5, 'Du bon boulot. Quelle joie de jouer avec vous après une rude semaine !', '2023-06-21', 'Maurice', 9, 1),
(4, 5, 'Très satisfait. Toujours content. Vos êtes les meilleurs ! Vraiment, c\'est sincère.', '2023-06-19', 'Carlos', 10, 1),
(5, 4, 'Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!', '2023-06-04', 'Pseudo', 8, 1),
(6, 1, 'J\'ai pas du tout aimé ! X(', '2023-07-03', 'Ambre', 9, 0),
(7, 1, 'Bonjour entreprise.\r\nJe vous propose mon service afin prospe', '2023-07-04', 'Vous', 8, 1),
(17, 0, 'Très bien. Un bon moment, une bonne ambiance. Je reste fidèle et ce n\'est pas pour rien. Très satisfait. Toujours conten', '2023-07-06', 'gdgdfgdf', 8, 0);

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

CREATE TABLE `content` (
  `id_content` bigint(20) NOT NULL,
  `title_content` varchar(100) DEFAULT NULL,
  `description_content` text DEFAULT NULL,
  `id_page` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `content`
--

INSERT INTO `content` (`id_content`, `title_content`, `description_content`, `id_page`) VALUES
(4, 'BIENVENUE SUR STAR\'ISLAND', 'Notre serveur permet de jouer à GTA 5, développé par Rockstar. C\'est un jeu vidéo de simulation de crime en monde ouvert. Disponible en mode freetoplay, il offre une expérience de jeu gratuite à une vaste communauté de joueurs. Les joueurs ont la possibilité d\'incarner des personnages impliqués dans des activités de gang, de jouer le rôle de policiers ou de participer à des scénarios qui leur permettront une fantastique évasion.<br>\r\n                Le jeu est distrayant grâce à sa liberté d\'action et sa capacité à créer des histoires uniques grâce à son mode de jeu de rôle (RP) très populaire.<br>\r\n                Sur notre serveur nous proposons également des événements réguliers, vous pourrez travailler dans la police ou participer à des braquages. Ici les joueurs peuvent coopérer pour réaliser des missions complexes et lucratives. Les joueurs vont plonger dans un monde virtuel riche et interactif.<br>\r\n                <a target=\"_blank\" title=\"Top serveur\" href=\"https://top-serveurs.net/gta/starsisland\">N\'hésitez pas à voter pour nous sur Top Serveur !</a>', 1),
(5, 'V.I.P.', 'Lorem ipsum dolor sit, reprehenderit quam inventore quas nulla repellendus facilis tenetur iste laboriosam! Repudiandae, neque.<br>\r\n                Reprehenderit quam inventore quas nulla repellendus facilis tenetur iste laboriosam! Repudiandae, neque.<br>\r\n                Lorem ipsum dolor sit, reprehenderit quam inventore quas nulla repellendus facilis tenetur iste laboriosam! Repudiandae, neque.\r\n            ', 5),
(6, 'V.I.P.', 'Lorem ipsum dolor sit, reprehenderit quam inventore quas nulla repellendus facilis tenetur iste laboriosam! Repudiandae, neque.<br>\r\n                Reprehenderit quam inventore quas nulla repellendus facilis tenetur iste laboriosam! Repudiandae, neque.<br>\r\n                Lorem ipsum dolor sit, reprehenderit quam inventore quas nulla repellendus facilis tenetur iste laboriosam! Repudiandae, neque.', 5),
(7, 'Titre de l\'event', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.<br>\r\n      Error quisquam neque, provident expedita excepturi reprehenderit nihil doloremque illo assumenda vitae.<br>\r\n      Est totam delectus natus exercitationem possimus, inventore dolorum? Lorem ipsum dolor sit amet consectetur adipisicing elit.<br>\r\n      Illo assumenda vitae est totam delectus natus exercitationem possimus?', 4),
(10, 'cc', 'c', 7),
(11, 'CC', 'c', 8),
(12, 'dd', 'd', 9),
(19, 'dsfsdfsd', 'fsdfsfsf', 4),
(20, '', '', 4),
(21, '', '', 4),
(22, '', '', 4),
(23, 'oooo', 'mmmmm', 4),
(24, '', '', 4),
(25, 'fdfds', '', 4),
(26, '', '', 4),
(27, '', '', 4),
(28, '', '', 4),
(29, '', '', 4),
(30, '', '', 4),
(31, '', '', 4),
(32, '', '', 4),
(33, '', '', 4),
(34, 'trr', 'trtrtrtrt', 4),
(35, '', '', 4),
(36, 'rzerzerzerz', '', 4),
(37, '', 'vvvv', 4),
(38, 'rrrrr', 'rrrrrrrrrrrr', 4),
(39, 'jhggj', 'jhgjhgjgh', 4),
(40, 'o', 'o', 4),
(41, 'tttt', 'tttttt', 4),
(42, 'yyy', 'yyyyyy', 4),
(43, 'ooooo', 'oooooooooo', 4),
(44, 'aaaa', 'yyyyyy', 4),
(45, '444', '4444444', 4),
(46, 'ppp', 'oooooooo', 4);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id_event` bigint(20) NOT NULL,
  `start_date_event` datetime DEFAULT NULL,
  `end_date_event` datetime DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id_event`, `start_date_event`, `end_date_event`, `activated`) VALUES
(1, '2023-06-26 19:47:35', '2024-06-26 19:47:35', 1),
(4, '2023-07-13 00:00:00', '2023-07-26 00:00:00', 1),
(5, '2023-07-21 00:00:00', '2023-07-29 00:00:00', 1),
(6, '2023-07-27 00:00:00', '2023-07-31 00:00:00', 1),
(7, '2023-07-16 00:00:00', '2023-07-31 00:00:00', 1),
(8, '2023-07-30 00:00:00', '2023-08-31 00:00:00', 1),
(9, '2023-07-29 00:00:00', '2023-07-13 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `event_content`
--

CREATE TABLE `event_content` (
  `id_event_content` bigint(20) NOT NULL,
  `id_event` bigint(20) NOT NULL,
  `id_content` bigint(20) NOT NULL,
  `id_media` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `event_content`
--

INSERT INTO `event_content` (`id_event_content`, `id_event`, `id_content`, `id_media`) VALUES
(1, 1, 7, 13),
(2, 4, 19, 89),
(9, 8, 44, 114),
(10, 9, 45, 115),
(11, 9, 46, 116);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id_media` bigint(20) NOT NULL,
  `title_media` varchar(20) DEFAULT NULL,
  `name_media` varchar(255) DEFAULT NULL,
  `id_page` int(100) DEFAULT NULL,
  `id_media_type` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id_media`, `title_media`, `name_media`, `id_page`, `id_media_type`) VALUES
(1, 'youtube', 'https://youtube.com', 2, 1),
(2, 'facebook', 'https://facebook.com', 2, 1),
(3, 'twitch', 'https://twitch.fr', 2, 1),
(4, 'instagram', 'https://instragram.com', 2, 1),
(5, 'twitter', 'https://twitter.com', 2, 1),
(6, 'discord', 'https://discord.com', 2, 1),
(7, 'avatar', 'avatar-4.png', 3, 2),
(8, 'avatar', 'avatar-3.png', 3, 2),
(9, 'avatar', 'avatar-2.png', 3, 2),
(10, 'avatar', 'avatar-1.png', 3, 2),
(11, 'imgEvent1', 'Perso1-removebg-preview.png', 5, 3),
(12, 'imgEvent2', 'Perso2-removebg-preview.png', 5, 3),
(13, 'predation', 'predation.png', 4, 3),
(14, 'instragram', 'http://127.0.0.1/', 2, 1),
(15, 'twitter', 'http://127.0.0.1/', 2, 1),
(33, 'facebook', 'http://henri.ok', 2, 1),
(36, 'twitter', 'https://autre.ion', 2, 1),
(38, 'discord', 'https://fsd.fd', 2, 1),
(46, 'Portrait de Lune mem', '64a3ec407c8b804_07_2023_11_54_08avatar-9.png', 2, 2),
(47, 'Portrait de Creation', '64a3ed8d460b404_07_2023_11_59_41avatar-4.png', 2, 2),
(48, 'Portrait de yvette m', '64a3ee9802dff04_07_2023_12_04_0864a3e40d296e504_07_2023_11_19_09avatar-9.png', 2, 2),
(49, 'Portrait de Rose mem', '64a3ef922756204_07_2023_12_08_18avatar-9.png', 2, 2),
(50, 'Portrait de test mem', '64a3eff6290d504_07_2023_12_09_58avatar-4.png', 2, 2),
(51, 'Portrait de rzere me', '64a3f0c899da004_07_2023_12_13_2864a3ddb0a610804_07_2023_10_52_00avatar-7.png', 2, 2),
(52, 'Portrait de Creation', '64a3f16a7dd7d04_07_2023_12_16_10avatar-2.png', 2, 2),
(53, 'Portrait de Rose mem', '64a3f2d39eb2704_07_2023_12_22_1164a3ef922756204_07_2023_12_08_18avatar-9.png', 2, 2),
(54, 'autre', 'https://klmkm.lm', 2, 1),
(55, 'autre', 'https://fsfsdf.lm', 2, 1),
(56, 'youtube', 'https://sfjldfjlsm.lm', 2, 1),
(57, 'youtube', 'https://gdgdf.lm', 2, 1),
(58, 'Portrait de Georgett', '64a3f6924a16e04_07_2023_12_38_1064a3ef922756204_07_2023_12_08_18avatar-9.png', 2, 2),
(60, 'Portrait de Rose mem', '64a3f71842b2504_07_2023_12_40_2464a3f16a7dd7d04_07_2023_12_16_10avatar-2.png', 2, 2),
(70, 'photo gallerie 1', 'Loading1.png', 6, 4),
(71, 'photo gallerie 2', 'Loading2.png', 6, 4),
(72, 'plongeur', 'Loading3.png', 6, 4),
(73, 'arbres', 'Loading4.png', 6, 4),
(78, 'nous', '64a566c59ee9b05_07_2023_14_49_0920230425_153615.jpg', 6, 4),
(79, 'nous', '64a566e17906105_07_2023_14_49_37Capture d’écran 2023-05-12 160534.png', 6, 4),
(88, 'reeree', '64a57d1735b9a05_07_2023_16_24_2320230425_153615.jpg', 6, 4),
(89, 'Photo de l\'event', 'teaser.jpg', 4, 3),
(113, 'Photo de l\'event', '64a7cb3a804e507_07_2023_10_22_1820230425_153619.jpg', 4, 3),
(114, 'Photo de l\'event', '64a7cb8a30ae107_07_2023_10_23_3820230425_153619.jpg', 4, 3),
(115, 'Photo de l\'event', '64a7d07477d0d07_07_2023_10_44_3620230425_153615.jpg', 4, 3),
(116, 'Photo de l\'event', '64a7d13841e8807_07_2023_10_47_5220230425_153619.jpg', 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `media_type`
--

CREATE TABLE `media_type` (
  `id_media_type` bigint(20) NOT NULL,
  `title_media_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `media_type`
--

INSERT INTO `media_type` (`id_media_type`, `title_media_type`) VALUES
(1, 'reseauSocial'),
(2, 'avatar'),
(3, 'img'),
(4, 'gallerie');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id_page` int(20) NOT NULL,
  `title_page` varchar(20) DEFAULT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id_page`, `title_page`, `url`) VALUES
(1, 'accueil', 'home'),
(2, 'team', 'team'),
(3, 'avis', 'comment'),
(4, 'event', 'event'),
(5, 'vip', 'vip'),
(6, 'album-gallerie', 'album-gallerie'),
(7, 'page7', ''),
(8, 'page8', ''),
(9, 'page9', ''),
(10, 'page10', ''),
(12, 'page12', ''),
(13, 'page13', ''),
(14, 'page14', ''),
(15, 'page15', '');

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id_team` int(20) NOT NULL,
  `role_team` varchar(20) DEFAULT NULL,
  `nickname_team` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`id_team`, `role_team`, `nickname_team`) VALUES
(1, 'Admin', 'George'),
(2, 'Admin', 'Camille'),
(3, 'Helpers', 'Paul'),
(4, 'Helpers', 'Pierre'),
(5, 'Helpers', 'Rachid'),
(6, 'Develloppeur', 'Ninon'),
(7, 'Develloppeur', 'Sabrina'),
(8, 'Develloppeur', 'Samira '),
(9, 'Develloppeur', 'David'),
(10, 'Develloppeur', 'Abdul'),
(11, 'Mappers', 'Corine '),
(12, 'Staff/Modos', 'Carlos '),
(13, 'Staff/Modos', 'Mathieu '),
(14, 'Staff/Modos', 'Laurent'),
(15, 'Mappers', 'Rose'),
(34, 'Staff/Modos', 'test'),
(35, 'Admin', 'rzere'),
(37, 'Staff/Modos', 'Georgettte');

-- --------------------------------------------------------

--
-- Structure de la table `team_media`
--

CREATE TABLE `team_media` (
  `id_team_media` int(20) NOT NULL,
  `id_media` bigint(20) NOT NULL,
  `id_team` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(38, 9, 14),
(53, 29, 32),
(55, 30, 34),
(56, 32, 35),
(57, 26, 36),
(58, 26, 37),
(59, 33, 38),
(60, 33, 39),
(61, 33, 40),
(62, 33, 41),
(70, 50, 34),
(71, 51, 35),
(74, 55, 35),
(75, 55, 10),
(76, 56, 36),
(77, 57, 37),
(78, 58, 37),
(80, 60, 15),
(81, 61, 36);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) NOT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  `password_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email_user`, `password_user`) VALUES
(1, 'B@rbieD0ll.com', '$2y$10$5g//IyCFOFUZ3YCQm3IJlul4a57q.f1KPfPjwq2.yhnybI8Nu0aAa');

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
  ADD KEY `id_event` (`id_event`),
  ADD KEY `id_media` (`id_media`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id_media`),
  ADD KEY `id_media_type` (`id_media_type`),
  ADD KEY `id_page` (`id_page`);

--
-- Index pour la table `media_type`
--
ALTER TABLE `media_type`
  ADD PRIMARY KEY (`id_media_type`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`);

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
  MODIFY `id_comment` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `content`
--
ALTER TABLE `content`
  MODIFY `id_content` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `event_content`
--
ALTER TABLE `event_content`
  MODIFY `id_event_content` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT pour la table `media_type`
--
ALTER TABLE `media_type`
  MODIFY `id_media_type` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id_team` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `team_media`
--
ALTER TABLE `team_media`
  MODIFY `id_team_media` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_media_02` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`);

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `fk_page_01` FOREIGN KEY (`id_page`) REFERENCES `page` (`id_page`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `event_content`
--
ALTER TABLE `event_content`
  ADD CONSTRAINT `fk_content_02` FOREIGN KEY (`id_content`) REFERENCES `content` (`id_content`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_02` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_media_08` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_media_type` FOREIGN KEY (`id_media_type`) REFERENCES `media_type` (`id_media_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_page_2` FOREIGN KEY (`id_page`) REFERENCES `page` (`id_page`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
