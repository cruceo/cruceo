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

/*Table structure for table `agencias` */

DROP TABLE IF EXISTS `agencias`;

CREATE TABLE `agencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `agencias` */

insert  into `agencias`(`id`,`nombre`) values (2,'Chducvuw');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `barcos` */

insert  into `barcos`(`id`,`nombre`,`descripcion`,`velocidad`,`manga`,`eslora`,`categoria_id`) values (2,'ewdn','fheow','ofwore','oifw','ofwhre',NULL),(3,'el barco con fotos','dwhfiu','12','12','rfeoi',2),(4,'con tre fotos','cqeirb','dewo','cw','dewd',2),(9,'con dos fotos','fcnwiq','12','12','rfeoi',2);

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`nombre`) values (2,'Categoriassss');

/*Table structure for table `ciudades` */

DROP TABLE IF EXISTS `ciudades`;

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `pais` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `ciudades` */

insert  into `ciudades`(`id`,`nombre`,`pais`) values (2,'Barcelona3','ES'),(3,'Madrid','ES'),(4,'malaga','ES');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `ciudades_cruceros` */

insert  into `ciudades_cruceros`(`id`,`ciudad_id`,`crucero_id`) values (3,3,3),(4,4,3),(5,2,4),(6,3,4),(7,4,7),(8,2,8),(9,3,8),(10,2,9),(11,4,9);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `cruceros` */

insert  into `cruceros`(`id`,`nombre`,`detalles`,`equipamiento`,`itinerario`,`img_itinerario`,`fecha_salida`,`duracion`,`promocion`,`incluido_precio`,`no_incluido_precio`,`naviera_id`,`zona_id`,`barco_id`) values (1,'Primer crucero','cwocj','efwe','wefdwe','4f8a0a2ab7492.png','2012-09-05',333,'dewfre','fref','frefrf',5,1,2),(3,'Con foto','detalles','equi','iti','4f8a0a2ab7492.png','2007-01-01',12,'efwwfwe','fwefrwe','fregqre',5,1,2),(4,'otro','fiwqu','rgfib','fiebif','4f8a0a2ab7492.png','2007-01-01',3,'fduhiv','khfbk','fvqiu',5,1,2),(7,'rgwre','ferhgf','iufrewfiu','cwreg','4f89b3b5ab6cd.png','2007-01-01',34,'frewfw','dweuifh','frweghi',5,1,2),(8,'prueba 1 del norte ///','cqwoij','voqfrbvuoi','jbcwj','4f8a12917fccf.png','2015-06-09',34,'fbwiobf','bvf','oib',5,1,2),(9,'Final','sin setter','frieqwofn','iovf','4f8a3024788b2.png','2017-02-02',23,'dwoifn','cowrgno','ofvqnwrgo',5,1,2);

/*Table structure for table `fechas` */

DROP TABLE IF EXISTS `fechas`;

CREATE TABLE `fechas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fechas` */

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `fotos` */

insert  into `fotos`(`id`,`ruta`,`titulo`,`barco_id`) values (1,'4f8b0544be0e0.png','primer2',9),(2,'4f8b0544bf326.png','segundo2',9);

/*Table structure for table `navieras` */

DROP TABLE IF EXISTS `navieras`;

CREATE TABLE `navieras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `navieras` */

insert  into `navieras`(`id`,`nombre`) values (5,'Naviera');

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
  CONSTRAINT `FK_categorias_cruceros_crucero` FOREIGN KEY (`crucero_id`) REFERENCES `cruceros` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_precios_agencias` FOREIGN KEY (`agencia_id`) REFERENCES `agencias` (`id`),
  CONSTRAINT `FK_precios_tipologias` FOREIGN KEY (`tipologia_id`) REFERENCES `tipologias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `precios` */

insert  into `precios`(`id`,`tipologia_id`,`crucero_id`,`agencia_id`,`precio`,`url`,`fecha`) values (1,4,1,2,3434.00,'www.google,es','2013-03-03'),(2,4,1,2,3535.00,'uerhf8reu','2010-03-03'),(4,4,3,2,56.00,'wrefewf','2007-01-01'),(5,4,4,2,44.00,'jjj','2007-02-01'),(6,4,7,2,4.00,'rw3fih','2007-01-01'),(7,4,8,2,56.00,'jfcwroibvf','2007-02-01'),(8,4,8,2,57.00,'foo','2013-08-21'),(9,4,9,2,1234.00,'frewfre','2016-03-03');

/*Table structure for table `tipologias` */

DROP TABLE IF EXISTS `tipologias`;

CREATE TABLE `tipologias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tipologias` */

insert  into `tipologias`(`id`,`nombre`) values (4,'prueba tipo');

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

/*Data for the table `usuarios` */

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

/*Data for the table `usuarios_back` */

insert  into `usuarios_back`(`id`,`username`,`salt`,`password`,`email`,`is_active`) values (1,'xaz','p4wk6ic71sgcwgs48sk0kc0c4c008gg','a8f909dabc7f9893f9d6c1c119997960f06874e4','javier.dag@gmail.com',1);

/*Table structure for table `zonas` */

DROP TABLE IF EXISTS `zonas`;

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `zonas` */

insert  into `zonas`(`id`,`nombre`) values (1,'zona 1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
