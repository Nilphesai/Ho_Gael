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


-- Listage de la structure de la base pour deckedit
CREATE DATABASE IF NOT EXISTS `deckedit` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `deckedit`;

-- Listage de la structure de table deckedit. cards
CREATE TABLE IF NOT EXISTS `cards` (
  `id_card` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `typeCard` varchar(50) NOT NULL,
  `effect` text NOT NULL,
  `attack` int DEFAULT '0',
  `defense` int DEFAULT '0',
  `level` int DEFAULT '0',
  `rank` int DEFAULT '0',
  `rate` int DEFAULT '0',
  `scale` int DEFAULT '0',
  `pendulumEffect` text,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_card`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table deckedit.cards : ~0 rows (environ)
INSERT INTO `cards` (`id_card`, `name`, `typeCard`, `effect`, `attack`, `defense`, `level`, `rank`, `rate`, `scale`, `pendulumEffect`, `image`) VALUES
	(1, 'Dark Magician Girl', 'monstre', 'This card gains 300 ATK for every "Dark Magician" or "Magician of black Chaos" in either player\'s Graveyard.', 2000, 1700, 6, 0, 0, 0, NULL, 'dark_magician_girl.png'),
	(2, 'sages_stone', 'spell', 'if you control a face-up "dark Magician Girl": Special Summon 1 "Dark Magician" from your hant or deck.', 0, 0, 0, 0, 0, 0, NULL, 'sages_stone.jpg'),
	(3, 'Magiciens_combination', 'trap', 'Once per turn, when a card or effect is activated (except during the damage stap):You can tribute 1 "Dark Magician" or 1 "Dark Magicien girl", Special summon 1 "Dark Magician" or 1 "Dark magician girl" from your hand or GY, with a different name from the tributed monster, and if you do, negate that activated effect. If this face-up card is sent from the spell & trap Zone to the GY:You can destroy 1 card on the field.', 0, 0, 0, 0, 0, 0, NULL, 'magicians_combination.jpg');

-- Listage de la structure de table deckedit. contain
CREATE TABLE IF NOT EXISTS `contain` (
  `card_id` int NOT NULL,
  `deck_id` int NOT NULL,
  `qtt` tinyint NOT NULL DEFAULT '1',
  KEY `FK_contain_cards` (`card_id`),
  KEY `FK_contain_deck` (`deck_id`),
  CONSTRAINT `FK_contain_cards` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id_card`),
  CONSTRAINT `FK_contain_deck` FOREIGN KEY (`deck_id`) REFERENCES `deck` (`id_deck`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table deckedit.contain : ~0 rows (environ)

-- Listage de la structure de table deckedit. deck
CREATE TABLE IF NOT EXISTS `deck` (
  `id_deck` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_deck`),
  KEY `FK_deck_user` (`user_id`),
  CONSTRAINT `FK_deck_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table deckedit.deck : ~0 rows (environ)

-- Listage de la structure de table deckedit. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `signDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table deckedit.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `nickName`, `password`, `signDate`, `email`, `role`) VALUES
	(1, 'Dieu', '123456', '2024-07-02 13:35:08', 'Dieu@gmail.fr', 'Admin'),
	(2, 'vagabond', '654321', '2024-07-02 13:36:14', 'vagabon@hotmail.com', 'membre'),
	(3, 'etranger', 'azerty', '2024-07-02 13:36:46', 'etranger@hootlook.fr', 'membre');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
