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


-- Listage de la structure de la base pour symfonysession
CREATE DATABASE IF NOT EXISTS `symfonysession` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `symfonysession`;

-- Listage de la structure de table symfonysession. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.categorie : ~3 rows (environ)
INSERT INTO `categorie` (`id`, `nom`) VALUES
	(1, 'Programmation'),
	(2, 'soins dentaire'),
	(3, 'bureautique');

-- Listage de la structure de table symfonysession. formateur
CREATE TABLE IF NOT EXISTS `formateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.formateur : ~3 rows (environ)
INSERT INTO `formateur` (`id`, `nom`) VALUES
	(1, 'Mickael MURMANN'),
	(2, 'Pascal BLAISE'),
	(3, 'Maya BEE');

-- Listage de la structure de table symfonysession. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.formation : ~3 rows (environ)
INSERT INTO `formation` (`id`, `nom`) VALUES
	(1, 'Developpeur web'),
	(2, 'Assistant dentaire'),
	(3, 'Secretaire');

-- Listage de la structure de table symfonysession. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table symfonysession. module
CREATE TABLE IF NOT EXISTS `module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int NOT NULL,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C242628BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_C242628BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.module : ~6 rows (environ)
INSERT INTO `module` (`id`, `categorie_id`, `libelle`) VALUES
	(1, 1, 'PHP'),
	(2, 1, 'HTML'),
	(3, 3, 'Word'),
	(4, 2, 'outillage dentaire'),
	(5, 3, 'excel'),
	(6, 1, 'CSS');

-- Listage de la structure de table symfonysession. programme
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `module_id` int NOT NULL,
  `session_id` int NOT NULL,
  `nb_jours` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DDCB9FFAFC2B591` (`module_id`),
  KEY `IDX_3DDCB9FF613FECDF` (`session_id`),
  CONSTRAINT `FK_3DDCB9FF613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_3DDCB9FFAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.programme : ~6 rows (environ)
INSERT INTO `programme` (`id`, `module_id`, `session_id`, `nb_jours`) VALUES
	(1, 1, 1, 2),
	(2, 2, 2, 1),
	(3, 6, 2, 2),
	(4, 4, 3, 2),
	(5, 3, 4, 1),
	(6, 5, 4, 1);

-- Listage de la structure de table symfonysession. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formateur_id` int NOT NULL,
  `formation_id` int NOT NULL,
  `intitule` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nb_place` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D4155D8F51` (`formateur_id`),
  KEY `IDX_D044D5D45200282E` (`formation_id`),
  CONSTRAINT `FK_D044D5D4155D8F51` FOREIGN KEY (`formateur_id`) REFERENCES `formateur` (`id`),
  CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.session : ~4 rows (environ)
INSERT INTO `session` (`id`, `formateur_id`, `formation_id`, `intitule`, `date_debut`, `date_fin`, `nb_place`) VALUES
	(1, 1, 1, 'Orienté objet', '2024-07-19', '2024-07-22', 10),
	(2, 1, 1, 'Front end', '2024-07-23', '2024-07-25', 10),
	(3, 2, 2, 'Assistance dentaire', '2024-07-23', '2024-07-25', 10),
	(4, 3, 3, 'Bureautique', '2024-07-26', '2024-07-28', 2);

-- Listage de la structure de table symfonysession. session_stagiaire
CREATE TABLE IF NOT EXISTS `session_stagiaire` (
  `session_id` int NOT NULL,
  `stagiaire_id` int NOT NULL,
  PRIMARY KEY (`session_id`,`stagiaire_id`),
  KEY `IDX_C80B23B613FECDF` (`session_id`),
  KEY `IDX_C80B23BBBA93DD6` (`stagiaire_id`),
  CONSTRAINT `FK_C80B23B613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C80B23BBBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.session_stagiaire : ~5 rows (environ)
INSERT INTO `session_stagiaire` (`session_id`, `stagiaire_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 2),
	(4, 1),
	(4, 3);

-- Listage de la structure de table symfonysession. stagiaire
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.stagiaire : ~3 rows (environ)
INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `email`, `telephone`) VALUES
	(1, 'HO', 'Gaël', 'Homme', '1996-12-30', 'gh@mail.com', 1666666666),
	(2, 'STAGIIEUR', 'Exemp', 'Homme', '1999-07-23', 'stagieur@mail.com', 1234567891),
	(3, 'FERN', 'Frieren', 'Femme', '1950-01-01', 'Frieren@mail.com', 1894561322);

-- Listage de la structure de table symfonysession. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysession.user : ~2 rows (environ)
INSERT INTO `user` (`id`, `pseudo`, `email`, `roles`, `password`, `is_verified`) VALUES
	(1, 'Admin', 'Admin@admin.com', '["ROLE_ADMIN"]', '$2y$13$G7eJ83WbM3Uoot/yiMFTuuJAsITlucX/Sihi1h13HP6Sgl1Gepd6S', 1),
	(2, 'test', 'test@text.fr', '[]', '$2y$13$YBz8MAlHTSq.NVWVklfI3upNMdiWuDWmLbRbE2fnpojqv6PtRZiNK', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
