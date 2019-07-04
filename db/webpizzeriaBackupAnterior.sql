/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.42 : Database - webpizzeria
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`webpizzeria` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `webpizzeria`;

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `int` int(11) NOT NULL AUTO_INCREMENT,
  `nro_caja` int(10) DEFAULT NULL,
  `idEmpleAper` int(11) DEFAULT NULL,
  `idEmpleCie` int(11) DEFAULT NULL,
  `fechaAper` datetime DEFAULT NULL,
  `fechaCie` datetime DEFAULT NULL,
  `Apertura` int(30) DEFAULT NULL,
  `ciere` int(30) DEFAULT NULL,
  `obs` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`int`),
  KEY `caja_ibfk_1` (`idEmpleAper`),
  KEY `caja_ibfk_2` (`idEmpleCie`),
  CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`idEmpleAper`) REFERENCES `empleado` (`id`),
  CONSTRAINT `caja_ibfk_2` FOREIGN KEY (`idEmpleCie`) REFERENCES `empleado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `caja` */

insert  into `caja`(`int`,`nro_caja`,`idEmpleAper`,`idEmpleCie`,`fechaAper`,`fechaCie`,`Apertura`,`ciere`,`obs`) values (2,1,1,NULL,'2019-05-19 00:00:00',NULL,200000,NULL,NULL),(17,6,5,NULL,'2019-05-20 00:19:11',NULL,5000000,NULL,NULL),(18,1,1,NULL,'2019-05-20 00:23:53',NULL,500000,NULL,NULL);

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `categoria` */

insert  into `categoria`(`id`,`categoria`) values (6,'POSTRES'),(7,'BEBIDAS'),(8,'PIZZA');

/*Table structure for table `ciudad` */

DROP TABLE IF EXISTS `ciudad`;

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(30) DEFAULT NULL,
  `departamento` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `ciudad` */

insert  into `ciudad`(`id`,`ciudad`,`departamento`) values (1,'BELEN','CONCEPCION'),(8,'LORETO','CONCEPCION'),(14,'VALLEMI','CONCEPCION'),(15,'SAN CARLOS','CONCEPCION'),(16,'YVAPOVO','CONCEPCION'),(17,'HORQUETA','CONCEPCION'),(20,'PEDRO JUAN CABALLERO','AMAMBAY'),(21,'BELLA VISTA','BOQUERON'),(22,'CONCEPCION','CONCEPCION');

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruc` varchar(10) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ciudad` (`ciudad`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `cliente` */

insert  into `cliente`(`id`,`ruc`,`nombre`,`telefono`,`direccion`,`email`,`ciudad`) values (1,'4358744','sandro',1231231,'tenite akapero','5654asda@gmail.com',1),(2,'21321','RUPERTO',2147483647,'ASDFJAÑSDFJÑ','ASD1FA5SD@MGLAKJ',22);

/*Table structure for table `compraproduc` */

DROP TABLE IF EXISTS `compraproduc`;

CREATE TABLE `compraproduc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nro_compra` int(11) DEFAULT NULL,
  `nro_factura` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `tipodeCompra` varchar(20) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `producto` int(11) DEFAULT NULL,
  `cant` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `iva` float DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `totalcompra` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proveedor` (`proveedor`),
  KEY `producto` (`producto`),
  CONSTRAINT `compraproduc_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`id`),
  CONSTRAINT `compraproduc_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

/*Data for the table `compraproduc` */

/*Table structure for table `empleado` */

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
  `foto` longblob,
  `ci` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `fechanaci` date DEFAULT NULL,
  `nacionalidad` varchar(30) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `barrio` varchar(30) DEFAULT NULL,
  `telefono` int(9) NOT NULL,
  `cargo` varchar(30) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario` (`usuario`),
  KEY `ciudad` (`ciudad`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`),
  CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `empleado` */

insert  into `empleado`(`id`,`usuario`,`foto`,`ci`,`nombre`,`apellido`,`fechanaci`,`nacionalidad`,`ciudad`,`barrio`,`telefono`,`cargo`,`direccion`) values (1,1,NULL,4358744,'Sandro Roberto','Castillo Delgado','1988-01-30','paraguaya',22,'Itacurubi',985201942,'Gerente','Tte. Cabrera C/ don bosco'),(4,7,NULL,12132132,'nombre','apellido','0000-00-00','nacionalidad',1,'barrio',0,'$cargo','$dire'),(5,9,NULL,12132132,'Calabera','Deshuesada','0000-00-00','nacionalidad',1,'barrio',21321,'cargo','dire'),(6,11,NULL,12132132,'nombre','apellido','0000-00-00','nacionalidad',1,'barrio',21321,'cargo','dire'),(7,12,NULL,12132132,'nombre','apellido','0000-00-00','nacionalidad',1,'barrio',21321,'cargo','dire'),(8,10,NULL,12132132,'nombre','apellido','0000-00-00','nacionalidad',1,'barrio',21321,'cargo','dire'),(9,8,NULL,12132132,'nombre','apellido','0000-00-00','nacionalidad',1,'barrio',21321,'cargo','dire');

/*Table structure for table `facturacabecera` */

DROP TABLE IF EXISTS `facturacabecera`;

CREATE TABLE `facturacabecera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suc` int(3) DEFAULT NULL,
  `caja` int(11) DEFAULT NULL,
  `nro_fac` int(7) DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `mesa` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `caja` (`caja`),
  KEY `cliente` (`cliente`),
  KEY `mesa` (`mesa`),
  CONSTRAINT `facturacabecera_ibfk_1` FOREIGN KEY (`caja`) REFERENCES `caja` (`int`),
  CONSTRAINT `facturacabecera_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `facturacabecera_ibfk_3` FOREIGN KEY (`mesa`) REFERENCES `mesa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `facturacabecera` */

/*Table structure for table `facturadetalle` */

DROP TABLE IF EXISTS `facturadetalle`;

CREATE TABLE `facturadetalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factura_cab` int(11) DEFAULT NULL,
  `producto` int(11) DEFAULT NULL,
  `sabores` int(11) DEFAULT NULL,
  `tipoVenta` varchar(20) DEFAULT NULL,
  `cant` int(11) DEFAULT NULL,
  `precioUni` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `iva` float DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factura_cab` (`factura_cab`),
  KEY `producto` (`producto`),
  KEY `sabores` (`sabores`),
  CONSTRAINT `facturadetalle_ibfk_1` FOREIGN KEY (`factura_cab`) REFERENCES `facturacabecera` (`id`),
  CONSTRAINT `facturadetalle_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `producto` (`id`),
  CONSTRAINT `facturadetalle_ibfk_3` FOREIGN KEY (`sabores`) REFERENCES `sabores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `facturadetalle` */

/*Table structure for table `historial` */

DROP TABLE IF EXISTS `historial`;

CREATE TABLE `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fhconexion` timestamp NULL DEFAULT NULL,
  `fhdesconexion` timestamp NULL DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `nivel` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

/*Data for the table `historial` */

insert  into `historial`(`id`,`fhconexion`,`fhdesconexion`,`usuario`,`nivel`) values (123,'2019-05-10 00:47:50','2019-05-10 00:47:50','ADMIN','ADMINISTRADOR'),(124,'2019-05-10 00:50:57',NULL,'SKULL','ADMINISTRADOR'),(125,'2019-05-10 00:54:57','0000-00-00 00:00:00','ADMIN','ADMINISTRADOR'),(126,'2019-05-10 01:04:12',NULL,'ADMIN','ADMINISTRADOR'),(127,'2019-05-10 01:06:56',NULL,'PEDRITO','ADMINISTRADOR'),(128,'2019-05-10 01:07:41',NULL,'ADMIN','ADMINISTRADOR'),(129,'2019-05-10 08:52:59',NULL,'ADMIN','ADMINISTRADOR'),(130,'2019-05-10 09:54:51',NULL,'ADMIN','ADMINISTRADOR'),(131,'2019-05-10 10:09:33',NULL,'ADMIN','ADMINISTRADOR'),(132,'2019-05-10 10:14:55',NULL,'ADMIN','ADMINISTRADOR'),(133,'2019-05-11 19:00:16',NULL,'ADMIN','ADMINISTRADOR'),(134,'2019-05-11 19:00:25',NULL,'ADMIN','ADMINISTRADOR'),(135,'2019-05-11 19:00:47',NULL,'ADMIN','ADMINISTRADOR'),(136,'2019-05-11 19:01:04',NULL,'ADMIN','ADMINISTRADOR'),(137,'2019-05-11 19:01:26',NULL,'ADMIN','ADMINISTRADOR'),(138,'2019-05-11 19:04:19',NULL,'ADMIN','ADMINISTRADOR'),(139,'2019-05-11 21:57:12',NULL,'ADMIN','ADMINISTRADOR'),(140,'2019-05-12 23:16:56',NULL,'ADMIN','ADMINISTRADOR'),(141,'2019-05-12 23:24:49',NULL,'ADMIN','ADMINISTRADOR'),(142,'2019-05-14 13:18:37',NULL,'ADMIN','ADMINISTRADOR'),(143,'2019-05-14 20:33:33',NULL,'ADMIN','ADMINISTRADOR'),(144,'2019-05-18 20:34:38',NULL,'ADMIN','ADMINISTRADOR'),(145,'2019-05-19 18:13:55',NULL,'ADMIN','ADMINISTRADOR'),(146,'2019-05-19 18:14:57',NULL,'lunacanela','ADMINISTRADOR'),(147,'2019-05-19 18:17:25',NULL,'ADMIN','ADMINISTRADOR'),(148,'2019-05-19 19:36:24',NULL,'ADMIN','ADMINISTRADOR'),(149,'2019-05-19 20:45:06',NULL,'calabera','USUARIO'),(150,'2019-05-19 20:46:00',NULL,'SKULL','ADMINISTRADOR'),(151,'2019-05-19 20:46:33',NULL,'ADMIN','ADMINISTRADOR'),(152,'2019-05-19 23:53:30',NULL,'SKULL','ADMINISTRADOR'),(153,'2019-05-20 00:23:41',NULL,'ADMIN','ADMINISTRADOR'),(154,'2019-05-20 22:35:02',NULL,'ADMIN','ADMINISTRADOR');

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `marca` */

/*Table structure for table `mesa` */

DROP TABLE IF EXISTS `mesa`;

CREATE TABLE `mesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `ubicacion` varchar(50) DEFAULT NULL,
  `sillas` int(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `mesa` */

insert  into `mesa`(`id`,`descripcion`,`ubicacion`,`sillas`) values (5,'MESA REDONDA','EN EL CENTRO\r\n\r\n',8),(8,'MESA REDONDA','ALKSJDFñLK',2),(9,'SDFASDFA','ASDFASDFA',2),(11,'DSDF','ASDF',8);

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `marca` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `tamano` int(11) DEFAULT NULL,
  `stock` int(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria` (`categoria`),
  KEY `tamano` (`tamano`),
  KEY `marca` (`marca`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`tamano`) REFERENCES `tamano` (`id`),
  CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `producto` */

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruc` varchar(10) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `proveedor` */

insert  into `proveedor`(`id`,`ruc`,`nombre`,`telefono`,`direccion`,`ciudad`) values (1,'465465','SANDRO CASTILLO',985201942,'TTE. CABRERA CASI DON BOSCO',15);

/*Table structure for table `sabores` */

DROP TABLE IF EXISTS `sabores`;

CREATE TABLE `sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sabores` varchar(40) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `sabores` */

insert  into `sabores`(`id`,`sabores`,`descripcion`) values (2,'QUESO','COBIERTA CON RELLENO');

/*Table structure for table `tamano` */

DROP TABLE IF EXISTS `tamano`;

CREATE TABLE `tamano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tamano` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tamano` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nivel` varchar(15) NOT NULL,
  `estado` varchar(8) DEFAULT 'inactivo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`usuario`,`pass`,`nivel`,`estado`) values (1,'ADMIN','202cb962ac59075b964b07152d234b70','ADMINISTRADOR','activo'),(7,'JULIA','202cb962ac59075b964b07152d234b70','USUARIO','inactivo'),(8,'PEDRITO','202cb962ac59075b964b07152d234b70','ADMINISTRADOR','inactivo'),(9,'SKULL','202cb962ac59075b964b07152d234b70','ADMINISTRADOR','inactivo'),(10,'ING.INFO','bcbe3365e6ac95ea2c0343a2395834dd','ADMINISTRADOR','inactivo'),(11,'calabera','202cb962ac59075b964b07152d234b70','USUARIO','inactivo'),(12,'lunacanela','046ecac2f9e4e6fcaecb3fa829ba5d4a','ADMINISTRADOR','inactivo');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
