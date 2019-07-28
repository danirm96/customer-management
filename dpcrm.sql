-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para dpcrm
CREATE DATABASE IF NOT EXISTS `dpcrm` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dpcrm`;

-- Volcando estructura para tabla dpcrm.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `address` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `cp` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `city` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `nif` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `country` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `phone` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `mail` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla dpcrm.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `customer` varchar(50) DEFAULT NULL,
  `rate` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla dpcrm.rel_invoices
CREATE TABLE IF NOT EXISTS `rel_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idInvoice` int(11) DEFAULT NULL,
  `detail` varchar(255) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla dpcrm.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `pass` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `email` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `phone` varchar(255) CHARACTER SET utf8 DEFAULT '0',
  `address` varchar(255) CHARACTER SET utf8 DEFAULT '0',
  `city` varchar(255) CHARACTER SET utf8 DEFAULT '0',
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nif` varchar(255) CHARACTER SET utf8 DEFAULT '0',
  `fullName` varchar(255) CHARACTER SET utf8 DEFAULT '0',
  `cp` varchar(255) CHARACTER SET utf8 DEFAULT '0',
  `numberInv` int(5) unsigned zerofill DEFAULT NULL,
  `yearInv` int(1) DEFAULT NULL,
  `prefixInv` char(8) CHARACTER SET utf8 DEFAULT NULL,
  `rate` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
