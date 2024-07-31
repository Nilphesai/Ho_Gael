-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour sessionchaima
CREATE DATABASE IF NOT EXISTS `sessionchaima` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sessionchaima`;

-- Listage de la structure de table sessionchaima. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessionchaima.categorie : ~4 rows (environ)
INSERT INTO `categorie` (`id`, `nom`) VALUES
	(1, 'programmation'),
	(2, 'bureautique '),
	(3, 'commerce'),
	(4, 'design');

-- Listage de la structure de table sessionchaima. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table sessionchaima.doctrine_migration_versions : ~1 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20240712140446', '2024-07-12 14:05:12', 649);

-- Listage de la structure de table sessionchaima. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessionchaima.formation : ~4 rows (environ)
INSERT INTO `formation` (`id`, `nom`) VALUES
	(1, 'stylisme'),
	(2, 'comptabilité'),
	(3, 'banque'),
	(4, 'CDA');

-- Listage de la structure de table sessionchaima. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessionchaima.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table sessionchaima. module_session
CREATE TABLE IF NOT EXISTS `module_session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int DEFAULT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7B3FEBCDBCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_7B3FEBCDBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessionchaima.module_session : ~8 rows (environ)
INSERT INTO `module_session` (`id`, `categorie_id`, `nom`) VALUES
	(1, 1, 'html/css'),
	(2, 1, 'javascript'),
	(3, 3, 'math'),
	(4, 4, 'dessin '),
	(5, 1, 'python'),
	(6, 3, 'SES'),
	(7, 3, 'economies gestion '),
	(8, 3, 'assurances');

-- Listage de la structure de table sessionchaima. programme
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int DEFAULT NULL,
  `module_id` int DEFAULT NULL,
  `nb_jours` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DDCB9FF613FECDF` (`session_id`),
  KEY `IDX_3DDCB9FFAFC2B591` (`module_id`),
  CONSTRAINT `FK_3DDCB9FF613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_3DDCB9FFAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module_session` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessionchaima.programme : ~10 rows (environ)
INSERT INTO `programme` (`id`, `session_id`, `module_id`, `nb_jours`) VALUES
	(1, 1, 2, 30),
	(2, 3, 4, 13),
	(3, 2, 2, 10),
	(4, 2, 5, 45),
	(5, 11, 3, 40),
	(6, 11, 8, 60),
	(7, 10, 8, 45),
	(8, 10, 3, 10),
	(9, 12, 8, 50),
	(10, 10, 5, 10);

-- Listage de la structure de table sessionchaima. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int DEFAULT NULL,
  `intitule` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `nb_places` int NOT NULL,
  `places_reserve` int NOT NULL,
  `ville` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D45200282E` (`formation_id`),
  CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessionchaima.session : ~12 rows (environ)
INSERT INTO `session` (`id`, `formation_id`, `intitule`, `date_debut`, `date_fin`, `nb_places`, `places_reserve`, `ville`) VALUES
	(1, 4, 'CDA option java', '2024-07-16 09:04:37', '2024-07-16 09:04:37', 140, 5, 'strasborg'),
	(2, 4, 'CDA python', '2024-07-16 10:46:41', '2025-07-16 10:46:44', 160, 30, 'Paris'),
	(3, 1, 'stylisme haute couture', '2024-07-16 11:14:19', '2026-07-16 11:14:21', 50, 9, 'milhouse'),
	(4, 4, 'CDA option PHP', '2024-07-16 14:28:56', '2027-07-16 14:28:57', 70, 9, 'Nice'),
	(5, 2, 'comptapilité Gestion', '2024-07-16 14:30:31', '2026-07-16 14:30:37', 59, 22, 'colmar'),
	(6, 2, 'comptapilité economie', '2025-07-16 14:31:20', '2027-07-16 14:31:30', 110, 15, 'paris'),
	(7, 2, 'comptapilité automne', '2024-07-16 14:33:02', '2025-07-16 14:33:03', 210, 75, 'Lyon'),
	(8, 1, 'stylisme automne', '2024-07-16 14:34:12', '2025-07-16 14:34:13', 45, 12, 'strasbourg'),
	(9, 1, 'stylisme printemps', '2024-07-16 14:34:59', '2029-07-16 14:35:01', 165, 51, 'Metz'),
	(10, 3, 'BNP', '2024-07-16 14:35:56', '2024-07-16 14:35:57', 155, 57, 'Strasbourg'),
	(11, 3, 'CIC', '2024-07-16 14:36:41', '2024-07-16 14:36:42', 450, 143, 'Paris'),
	(12, 3, 'Societe general', '2024-07-16 14:37:19', '2024-07-16 14:37:21', 156, 8, 'sete ');

-- Listage de la structure de table sessionchaima. session_stagiaire
CREATE TABLE IF NOT EXISTS `session_stagiaire` (
  `session_id` int NOT NULL,
  `stagiaire_id` int NOT NULL,
  PRIMARY KEY (`session_id`,`stagiaire_id`),
  KEY `IDX_C80B23B613FECDF` (`session_id`),
  KEY `IDX_C80B23BBBA93DD6` (`stagiaire_id`),
  CONSTRAINT `FK_C80B23B613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C80B23BBBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessionchaima.session_stagiaire : ~5 rows (environ)
INSERT INTO `session_stagiaire` (`session_id`, `stagiaire_id`) VALUES
	(1, 1),
	(2, 1),
	(2, 2),
	(2, 3),
	(10, 2);

-- Listage de la structure de table sessionchaima. stagiaire
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessionchaima.stagiaire : ~3 rows (environ)
INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `date_naissance`, `adresse`, `ville`, `email`, `telephone`) VALUES
	(1, 'garoui', 'chaima', '2024-07-16 09:36:24', 'rue horace', 'strasbourg', 'chaima@exemple.fr', ''),
	(2, 'banour', 'ikram', '2000-07-16 11:10:55', 'route schirmek', 'strasbourg', 'ikram@exemple.fr', NULL),
	(3, 'saidi', 'asma', '2004-07-16 11:11:58', 'lingolsheim', 'paris', 'asma@exemple', NULL);

-- Listage de la structure de table sessionchaima. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessionchaima.utilisateur : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
