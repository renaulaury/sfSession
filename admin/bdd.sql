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


-- Listage de la structure de la base pour sfsessionlily
CREATE DATABASE IF NOT EXISTS `sfsessionlily` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sfsessionlily`;

-- Listage de la structure de table sfsessionlily. category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle_category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessionlily.category : ~5 rows (environ)
REPLACE INTO `category` (`id`, `libelle_category`) VALUES
	(1, 'Bureautique'),
	(2, 'Informatique'),
	(4, 'Design'),
	(5, 'Electronique'),
	(6, 'Comptabilité');

-- Listage de la structure de table sfsessionlily. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table sfsessionlily.doctrine_migration_versions : ~1 rows (environ)
REPLACE INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20250120130936', '2025-01-20 13:10:08', 589);

-- Listage de la structure de table sfsessionlily. intern
CREATE TABLE IF NOT EXISTS `intern` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_intern` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `sex` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessionlily.intern : ~4 rows (environ)
REPLACE INTO `intern` (`id`, `name_intern`, `firstname`, `date_birth`, `sex`, `city`, `email`, `phone`) VALUES
	(1, 'Renau', 'Laury', '1988-03-14', 'F', 'Chalons', 'lily@gmail.fr', '0707070707'),
	(2, 'Vautier', 'Elise', '2025-01-26', 'F', 'Strasbourg', 'elise@gmail.fr', '0707070707'),
	(3, 'Ruffo', 'Yofer', '1985-10-25', 'M', 'Strasbourg', 'yofer@gmail.fr', '0707070700707'),
	(4, 'Boenapfel', 'Damien', '1994-04-25', 'M', 'Strasbourg', 'dboenapfel@gmail.fr', '07070707007');

-- Listage de la structure de table sfsessionlily. messenger_messages
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

-- Listage des données de la table sfsessionlily.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table sfsessionlily. module
CREATE TABLE IF NOT EXISTS `module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `libelle_module` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C24262812469DE2` (`category_id`),
  CONSTRAINT `FK_C24262812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessionlily.module : ~9 rows (environ)
REPLACE INTO `module` (`id`, `category_id`, `libelle_module`) VALUES
	(1, 1, 'Excel'),
	(2, 1, 'Word'),
	(3, 1, 'Powerpoint'),
	(4, 2, 'MCD-MLD'),
	(5, 2, 'PHP'),
	(6, 2, 'HTML'),
	(7, 2, 'CSS'),
	(8, 2, 'Figma'),
	(9, 2, 'JS');

-- Listage de la structure de table sfsessionlily. program
CREATE TABLE IF NOT EXISTS `program` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int DEFAULT NULL,
  `module_id` int DEFAULT NULL,
  `nb_day` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92ED7784613FECDF` (`session_id`),
  KEY `IDX_92ED7784AFC2B591` (`module_id`),
  CONSTRAINT `FK_92ED7784613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_92ED7784AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessionlily.program : ~9 rows (environ)
REPLACE INTO `program` (`id`, `session_id`, `module_id`, `nb_day`) VALUES
	(1, 1, 5, 10),
	(2, 3, 3, 5),
	(3, 2, 1, 5),
	(4, 1, 5, 5),
	(5, 2, 7, 1),
	(6, 3, 7, 1),
	(7, 2, 7, 3),
	(8, 3, 8, 2),
	(9, 3, 7, 2);

-- Listage de la structure de table sfsessionlily. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `training_id` int DEFAULT NULL,
  `trainer_id` int DEFAULT NULL,
  `libelle_session` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_place` int NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D4BEFD98D1` (`training_id`),
  KEY `IDX_D044D5D4FB08EDF6` (`trainer_id`),
  CONSTRAINT `FK_D044D5D4BEFD98D1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`),
  CONSTRAINT `FK_D044D5D4FB08EDF6` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessionlily.session : ~3 rows (environ)
REPLACE INTO `session` (`id`, `training_id`, `trainer_id`, `libelle_session`, `nb_place`, `date_begin`, `date_end`) VALUES
	(1, 2, 4, 'Introduction à PHP', 10, '2025-01-27', '2025-01-31'),
	(2, 1, 3, 'Tableaux croisés dynamiques', 15, '2025-02-01', '2025-01-15'),
	(3, 1, 2, 'Gestion de powerpoint', 3, '2025-02-03', '2025-02-07');

-- Listage de la structure de table sfsessionlily. session_intern
CREATE TABLE IF NOT EXISTS `session_intern` (
  `session_id` int NOT NULL,
  `intern_id` int NOT NULL,
  PRIMARY KEY (`session_id`,`intern_id`),
  KEY `IDX_CA12556F613FECDF` (`session_id`),
  KEY `IDX_CA12556F525DD4B4` (`intern_id`),
  CONSTRAINT `FK_CA12556F525DD4B4` FOREIGN KEY (`intern_id`) REFERENCES `intern` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CA12556F613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessionlily.session_intern : ~5 rows (environ)
REPLACE INTO `session_intern` (`session_id`, `intern_id`) VALUES
	(1, 1),
	(2, 2),
	(3, 1),
	(3, 3),
	(3, 4);

-- Listage de la structure de table sfsessionlily. trainer
CREATE TABLE IF NOT EXISTS `trainer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_trainer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessionlily.trainer : ~4 rows (environ)
REPLACE INTO `trainer` (`id`, `name_trainer`, `firstname`, `email`) VALUES
	(1, 'Bear', 'Teddy', 'tbear@gmail.fr'),
	(2, 'Qsé', 'Tou', 'tqsé@gmail.fr'),
	(3, 'Gramme', 'Anna', 'agramme@gmail.fr'),
	(4, 'Résse', 'Yves', 'yresse@gmail.fr');

-- Listage de la structure de table sfsessionlily. training
CREATE TABLE IF NOT EXISTS `training` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle_training` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessionlily.training : ~4 rows (environ)
REPLACE INTO `training` (`id`, `libelle_training`) VALUES
	(1, 'Assistant adm'),
	(2, 'Développeur web'),
	(3, 'Comptable'),
	(4, 'Assistant dentaire');

-- Listage de la structure de table sfsessionlily. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessionlily.user : ~2 rows (environ)
REPLACE INTO `user` (`id`, `nickname`, `email`, `roles`, `password`) VALUES
	(3, NULL, 'root@gmail.com', '[]', '$2y$13$nyas23qpFwN5jxR1W1GNf.2ranC.zdWdyxrKdaLv/.CiSRAiJN7MO'),
	(4, NULL, 'lisou@gmail.com', '[]', '$2y$13$d8LaFUnAGst.zo7Jw.nw6.oTUtUaKZx8JFHTMThTNkwsdGAK7d5pG');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
