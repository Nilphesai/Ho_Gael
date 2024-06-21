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


-- Listage de la structure de la base pour recipe
CREATE DATABASE IF NOT EXISTS `recipe` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `recipe`;

-- Listage de la structure de table recipe. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) COLLATE utf8mb4_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table recipe.category : ~3 rows (environ)
INSERT INTO `category` (`id_category`, `category_name`) VALUES
	(1, 'entree'),
	(2, 'plat'),
	(3, 'dessert');

-- Listage de la structure de table recipe. ingredient
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id_ingredient` int NOT NULL AUTO_INCREMENT,
  `ingredient_name` varchar(100) COLLATE utf8mb4_bin NOT NULL DEFAULT '0',
  `unity` varchar(100) COLLATE utf8mb4_bin NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  PRIMARY KEY (`id_ingredient`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table recipe.ingredient : ~23 rows (environ)
INSERT INTO `ingredient` (`id_ingredient`, `ingredient_name`, `unity`, `price`) VALUES
	(1, 'Pâtes', 'g', 0.008),
	(2, 'Steak haché', 'unité', 1.2),
	(3, 'Tomate', 'unité', 1),
	(4, 'Riz', 'g', 0.008),
	(5, 'Oeuf', 'unité', 0.6),
	(6, 'Jambon', 'unité', 0.8),
	(7, 'Petit pois', 'g', 0.005),
	(8, 'Pomme', 'unité', 1),
	(9, 'Poire', 'unité', 1),
	(10, 'Raisin', 'unité', 1),
	(11, 'Foie gras', 'g', 0.01),
	(12, 'Pain', 'unité', 1),
	(13, 'Mayonaise', 'L', 1),
	(14, 'Salade', 'g', 0.005),
	(15, 'Oignon', 'unité', 0.5),
	(16, 'Fromage', 'g', 0.003),
	(17, 'Poulet', 'g', 0.01),
	(18, 'Pickels', 'g', 0.003),
	(19, 'Ketchup', 'J', 1),
	(20, 'Poisson', 'g', 0.01),
	(21, 'Vinaigre', 'g', 0.02),
	(22, 'Lait', 'L', 1.4),
	(23, 'Chocolat', 'g', 0.01);

-- Listage de la structure de table recipe. recipe
CREATE TABLE IF NOT EXISTS `recipe` (
  `id_recipe` int NOT NULL AUTO_INCREMENT,
  `recipe_name` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `preparation_time` int NOT NULL DEFAULT '0',
  `instructions` text COLLATE utf8mb4_bin,
  `id_category` int NOT NULL,
  PRIMARY KEY (`id_recipe`),
  KEY `id_category` (`id_category`),
  CONSTRAINT `FK_recipe_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table recipe.recipe : ~10 rows (environ)
INSERT INTO `recipe` (`id_recipe`, `recipe_name`, `preparation_time`, `instructions`, `id_category`) VALUES
	(1, 'Pâtes à la bolognese', 20, 'cuires des pates dans une casserolles d\'eau bouillantes, cuire en parallele la sauces tomates et la viande haché, puis servez avec un lit de fromage rapé', 2),
	(2, 'Riz cantonnais', 30, 'cuire le riz dans une casserolle d\'eau avec un couvercle, une fois à ébullition, mettre à feu moyens pendant 20 min, en parallele couper le janbon en dé et battre les oeufs, cuire l\'oeuf en omelette tout en le séparant en petite parie pendant la cuissons, une fois cuite, rajouté le riz, puis le jambon et les petit pois cuire jusqu\'à ce que le jambon soit chaud', 2),
	(3, 'Salade de fruit', 5, 'prenez des fruits frais (dans cette recettte, pomme, poire et raisin) les mettre dans un bol et servir', 3),
	(4, 'Foie gras', 5, 'prenez un morceau de foie gras avec du pain, c\'est délicieux !', 1),
	(5, 'Oeuf à la mayonaise', 8, 'cuires des oeufs dur, enlevez la coquille, puis couper la en deux dans le sens de la longueur, rajouté la moyonaise', 1),
	(6, 'Salade scesar', 10, 'ajouté dans un bol, la salade, oignon, pain, fromage et morceau de poulet, mélangé et servez !', 2),
	(7, 'Hamburger', 20, 'cuire le steak haché avec une cuissons à votre convenant, coupé des tranche d\'oignons, et placé le steack haché, les oignons, les pickels la sauce ketchup entre deux tranche de pain burger', 2),
	(8, 'Sushi', 10, 'cuire le riz, préparer le poisson, faire le vinaigre pour sushi, mélanger avec le riz cuit, puis mettez une tranche de poissons dessus', 2),
	(9, 'Sandwitch', 10, 'mettez le jambon, la salade et les tomates entre 2 tranche de pain beurré', 2),
	(10, 'Chocolat chaud', 2, 'réchauffé le lait, versez dans une tasse, puis ajouter la pouddre de cacao', 3);

-- Listage de la structure de table recipe. recipe_ingredients
CREATE TABLE IF NOT EXISTS `recipe_ingredients` (
  `quantity` float NOT NULL,
  `id_ingredient` int NOT NULL,
  `id_recipe` int NOT NULL,
  KEY `id_ingredient` (`id_ingredient`),
  KEY `id_recipe` (`id_recipe`),
  CONSTRAINT `FK_recipe_ingredients_ingredient` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredient` (`id_ingredient`),
  CONSTRAINT `FK_recipe_ingredients_recipe` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id_recipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table recipe.recipe_ingredients : ~35 rows (environ)
INSERT INTO `recipe_ingredients` (`quantity`, `id_ingredient`, `id_recipe`) VALUES
	(50, 23, 10),
	(0.1, 22, 10),
	(100, 11, 4),
	(1, 12, 4),
	(1, 12, 7),
	(1, 2, 7),
	(20, 14, 7),
	(10, 18, 7),
	(20, 3, 7),
	(0.01, 19, 7),
	(0.01, 13, 5),
	(2, 5, 5),
	(150, 1, 1),
	(1, 2, 1),
	(6, 3, 1),
	(200, 4, 2),
	(50, 6, 2),
	(2, 5, 2),
	(100, 7, 2),
	(1, 8, 3),
	(1, 9, 3),
	(1, 10, 3),
	(200, 14, 6),
	(0.5, 12, 6),
	(50, 16, 6),
	(1, 15, 6),
	(100, 17, 6),
	(1, 12, 9),
	(100, 6, 9),
	(50, 14, 9),
	(1, 3, 9),
	(100, 4, 8),
	(80, 20, 8),
	(0.02, 21, 8),
	(20, 16, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
