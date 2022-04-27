-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.38-83.0 - Percona Server (GPL), Release 83.0, Revision dc97471bd40
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.5.0.5273
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_test
CREATE DATABASE IF NOT EXISTS `db_test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_test`;

-- Dumping structure for table db_test.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping structure for table db_test.customer_group
CREATE TABLE IF NOT EXISTS `customer_group` (
  `cg_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `customer_group` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_test.customer_group: ~2 rows (approximately)
DELETE FROM `customer_group`;
/*!40000 ALTER TABLE `customer_group` DISABLE KEYS */;
INSERT INTO `customer_group` (`cg_id`, `customer_group`) VALUES
	(1, 'Retail'),
	(2, 'Wholesale');
/*!40000 ALTER TABLE `customer_group` ENABLE KEYS */;

-- Dumping structure for table db_test.price
CREATE TABLE IF NOT EXISTS `price` (
  `price_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `product_id` smallint(6) DEFAULT NULL,
  `cg_id` smallint(6) DEFAULT NULL,
  `price` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`price_id`),
  UNIQUE KEY `product_id_cg_id` (`product_id`,`cg_id`),
  KEY `customer_group_id` (`cg_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- Dumping data for table db_test.price: ~10 rows (approximately)
DELETE FROM `price`;
/*!40000 ALTER TABLE `price` DISABLE KEYS */;
INSERT INTO `price` (`price_id`, `product_id`, `cg_id`, `price`) VALUES
	(1, 1, 1, 150),
	(2, 1, 2, 120),
	(3, 2, 1, 50),
	(4, 2, 2, 40),
	(5, 3, 1, 300),
	(6, 3, 2, 280),
	(7, 4, 1, 25),
	(8, 4, 2, 20),
	(9, 5, 1, 15),
	(10, 5, 2, 12);
/*!40000 ALTER TABLE `price` ENABLE KEYS */;

-- Dumping structure for table db_test.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table db_test.products: ~5 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`product_id`, `product_name`) VALUES
	(1, 'Keyboard'),
	(2, 'Mouse'),
	(3, 'Monitor'),
	(4, 'Charger'),
	(5, 'Flashdisk');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
