/*
SQLyog Ultimate v9.10 
MySQL - 5.5.16-log : Database - cruceo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cruceo` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cruceo`;

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `categorias_cruceros` */

DROP TABLE IF EXISTS `categorias_cruceros`;

CREATE TABLE `categorias_cruceros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `crucero_id` int(11) NOT NULL,
  `precio` double(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categorias_cruceros_categoria` (`categoria_id`),
  KEY `FK_categorias_cruceros_crucero` (`crucero_id`),
  CONSTRAINT `FK_categorias_cruceros_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `FK_categorias_cruceros_crucero` FOREIGN KEY (`crucero_id`) REFERENCES `cruceros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ciudades` */

DROP TABLE IF EXISTS `ciudades`;

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ciudades_cruceros` */

DROP TABLE IF EXISTS `ciudades_cruceros`;

CREATE TABLE `ciudades_cruceros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad_id` int(11) NOT NULL,
  `crucero_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ciudades_cruceros_ciudad` (`ciudad_id`),
  KEY `FK_ciudades_cruceros_crucero` (`crucero_id`),
  CONSTRAINT `FK_ciudades_cruceros_ciudad` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`),
  CONSTRAINT `FK_ciudades_cruceros_crucero` FOREIGN KEY (`crucero_id`) REFERENCES `cruceros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `cruceros` */

DROP TABLE IF EXISTS `cruceros`;

CREATE TABLE `cruceros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `detalles` text,
  `equipamiento` text,
  `itinerario` text,
  `img_itinerario` varchar(255) DEFAULT NULL,
  `img_barco` varchar(255) DEFAULT NULL,
  `fecha_salida` datetime NOT NULL,
  `promocion` varchar(255) DEFAULT NULL,
  `incluido_precio` varchar(255) DEFAULT NULL,
  `no_incluido_precio` varchar(255) DEFAULT NULL,
  `naviera_id` int(11) NOT NULL,
  `zona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cruceros_zona` (`zona_id`),
  KEY `FK_cruceros_naviera` (`naviera_id`),
  CONSTRAINT `FK_cruceros_naviera` FOREIGN KEY (`naviera_id`) REFERENCES `navieras` (`id`),
  CONSTRAINT `FK_cruceros_zona` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `fotos` */

DROP TABLE IF EXISTS `fotos`;

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `crucero_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_fotos_crucero` (`crucero_id`),
  CONSTRAINT `FK_fotos_crucero` FOREIGN KEY (`crucero_id`) REFERENCES `cruceros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `navieras` */

DROP TABLE IF EXISTS `navieras`;

CREATE TABLE `navieras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `zonas` */

DROP TABLE IF EXISTS `zonas`;

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
