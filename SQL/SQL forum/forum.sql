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


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.categorie : ~3 rows (environ)
INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
	(1, 'Serveur'),
	(2, 'Principal'),
	(3, 'Archive');

-- Listage de la structure de table forum. message
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sujet_id` int NOT NULL DEFAULT '0',
  `visiteur_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_message`),
  KEY `FK_message_sujet` (`sujet_id`),
  KEY `FK_message_visiteur` (`visiteur_id`),
  CONSTRAINT `FK_message_sujet` FOREIGN KEY (`sujet_id`) REFERENCES `sujet` (`id_sujet`),
  CONSTRAINT `FK_message_visiteur` FOREIGN KEY (`visiteur_id`) REFERENCES `visiteur` (`id_visiteur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.message : ~4 rows (environ)
INSERT INTO `message` (`id_message`, `texte`, `dateCreation`, `sujet_id`, `visiteur_id`) VALUES
	(1, 'Les poivrons rouge sont meilleurs que les vert !', '2024-07-02 13:40:06', 2, 3),
	(2, 'Non, les poivrons vert sont meilleurs !', '2024-07-02 13:40:44', 2, 2),
	(3, 'Les règles ici : et j\'ai pas de pavé pour des règles existantes, donc supposé qu\'elles sont ici, ok ?', '2024-07-02 13:41:33', 1, 1),
	(4, 'Contenue non écrit parce que malvenu de l\'écrire...', '2024-07-02 13:42:22', 3, 3);

-- Listage de la structure de table forum. sujet
CREATE TABLE IF NOT EXISTS `sujet` (
  `id_sujet` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ouvert` tinyint(1) NOT NULL DEFAULT '0',
  `categorie_id` int NOT NULL,
  `visiteur_id` int NOT NULL,
  PRIMARY KEY (`id_sujet`),
  KEY `FK_sujet_categorie` (`categorie_id`),
  KEY `FK_sujet_visiteur` (`visiteur_id`),
  CONSTRAINT `FK_sujet_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`),
  CONSTRAINT `FK_sujet_visiteur` FOREIGN KEY (`visiteur_id`) REFERENCES `visiteur` (`id_visiteur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.sujet : ~3 rows (environ)
INSERT INTO `sujet` (`id_sujet`, `titre`, `dateCreation`, `ouvert`, `categorie_id`, `visiteur_id`) VALUES
	(1, 'Reglement', '2024-07-02 13:37:37', 1, 1, 1),
	(2, 'Poivron', '2024-07-02 13:38:20', 0, 2, 2),
	(3, 'xxx', '2024-07-02 13:39:00', 1, 3, 3);

-- Listage de la structure de table forum. visiteur
CREATE TABLE IF NOT EXISTS `visiteur` (
  `id_visiteur` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL DEFAULT '',
  `role` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_visiteur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.visiteur : ~3 rows (environ)
INSERT INTO `visiteur` (`id_visiteur`, `pseudo`, `motDePasse`, `dateInscription`, `email`, `role`) VALUES
	(1, 'Dieu', '123456', '2024-07-02 13:35:08', 'Dieu@gmail.fr', 'Admin'),
	(2, 'vagabond', '654321', '2024-07-02 13:36:14', 'vagabon@hotmail.com', 'membre'),
	(3, 'etranger', 'azerty', '2024-07-02 13:36:46', 'etranger@hootlook.fr', 'membre');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
