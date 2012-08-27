/*
SQLyog Ultimate v9.63 
MySQL - 5.5.23-log : Database - cruceo
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

/*Table structure for table `agencias` */

DROP TABLE IF EXISTS `agencias`;

CREATE TABLE `agencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `barcos` */

DROP TABLE IF EXISTS `barcos`;

CREATE TABLE `barcos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` tinytext,
  `velocidad` varchar(255) DEFAULT NULL,
  `manga` varchar(255) DEFAULT NULL,
  `eslora` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_barcos_categorias` (`categoria_id`),
  CONSTRAINT `FK_barcos_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ciudades` */

DROP TABLE IF EXISTS `ciudades`;

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `pais` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
  CONSTRAINT `FK_ciudades_cruceros_crucero` FOREIGN KEY (`crucero_id`) REFERENCES `cruceros` (`id`) ON DELETE CASCADE
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
  `fecha_salida` date NOT NULL,
  `duracion` int(3) DEFAULT NULL,
  `promocion` varchar(255) DEFAULT NULL,
  `incluido_precio` varchar(255) DEFAULT NULL,
  `no_incluido_precio` varchar(255) DEFAULT NULL,
  `naviera_id` int(11) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `barco_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cruceros_zona` (`zona_id`),
  KEY `FK_cruceros_naviera` (`naviera_id`),
  KEY `FK_cruceros_barcos` (`barco_id`),
  CONSTRAINT `FK_cruceros_barcos` FOREIGN KEY (`barco_id`) REFERENCES `barcos` (`id`),
  CONSTRAINT `FK_cruceros_naviera` FOREIGN KEY (`naviera_id`) REFERENCES `navieras` (`id`),
  CONSTRAINT `FK_cruceros_zona` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `fotos` */

DROP TABLE IF EXISTS `fotos`;

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `barco_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_fotos_crucero` (`barco_id`),
  CONSTRAINT `FK_fotos_barco` FOREIGN KEY (`barco_id`) REFERENCES `barcos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `navieras` */

DROP TABLE IF EXISTS `navieras`;

CREATE TABLE `navieras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `precios` */

DROP TABLE IF EXISTS `precios`;

CREATE TABLE `precios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipologia_id` int(11) NOT NULL,
  `crucero_id` int(11) NOT NULL,
  `agencia_id` int(11) NOT NULL,
  `precio` double(8,2) NOT NULL,
  `url` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categorias_cruceros_categoria` (`tipologia_id`),
  KEY `FK_categorias_cruceros_crucero` (`crucero_id`),
  KEY `FK_precios_agencias` (`agencia_id`),
  CONSTRAINT `FK_categorias_cruceros_crucero` FOREIGN KEY (`crucero_id`) REFERENCES `cruceros` (`id`),
  CONSTRAINT `FK_precios_agencias` FOREIGN KEY (`agencia_id`) REFERENCES `agencias` (`id`),
  CONSTRAINT `FK_precios_tipologias` FOREIGN KEY (`tipologia_id`) REFERENCES `tipologias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tipologias` */

DROP TABLE IF EXISTS `tipologias`;

CREATE TABLE `tipologias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(100) NOT NULL,
  `pass` varchar(40) DEFAULT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido1` varchar(200) NOT NULL,
  `apellido2` varchar(200) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `usuarios_back` */

DROP TABLE IF EXISTS `usuarios_back`;

CREATE TABLE `usuarios_back` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5D5B1E7FF85E0677` (`username`),
  UNIQUE KEY `UNIQ_5D5B1E7FE7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `zonas` */

DROP TABLE IF EXISTS `zonas`;

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
