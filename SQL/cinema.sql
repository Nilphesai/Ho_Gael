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


-- Listage de la structure de la base pour cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema`;

-- Listage de la structure de table cinema. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_acteur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.acteur : ~0 rows (environ)

-- Listage de la structure de table cinema. categoriser
CREATE TABLE IF NOT EXISTS `categoriser` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  KEY `id_film` (`id_film`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `FK_categoriser_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_categoriser_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.categoriser : ~0 rows (environ)

-- Listage de la structure de table cinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `duree` int NOT NULL DEFAULT '0',
  `synopsis` text,
  `note` float NOT NULL,
  `affiche` varchar(255) NOT NULL,
  `annee_sortie` year NOT NULL,
  `id_realisateur` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.film : ~0 rows (environ)

-- Listage de la structure de table cinema. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL,
  `libelle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.genre : ~0 rows (environ)

-- Listage de la structure de table cinema. jouer
CREATE TABLE IF NOT EXISTS `jouer` (
  `id_film` int NOT NULL,
  `id_role` int NOT NULL,
  `id_acteur` int NOT NULL,
  KEY `id_film` (`id_film`),
  KEY `id_role` (`id_role`),
  KEY `id_acteur` (`id_acteur`),
  CONSTRAINT `FK_jouer_acteur` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK_jouer_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_jouer_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.jouer : ~0 rows (environ)

-- Listage de la structure de table cinema. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL,
  `nom` varchar(255) NOT NULL DEFAULT '',
  `prenom` varchar(255) NOT NULL DEFAULT '',
  `sexe` varchar(50) NOT NULL DEFAULT '',
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.personne : ~0 rows (environ)

-- Listage de la structure de table cinema. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_realisateur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.realisateur : ~0 rows (environ)

-- Listage de la structure de table cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL,
  `nom` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.role : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
