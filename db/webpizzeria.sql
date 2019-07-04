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

/*Table structure for table `bebidastamano` */

DROP TABLE IF EXISTS `bebidastamano`;

CREATE TABLE `bebidastamano` (
  `id` int(11) NOT NULL,
  `tamano` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bebidastamano` */

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nro_caja` int(10) DEFAULT NULL,
  `idEmpleAper` int(11) DEFAULT NULL,
  `idEmpleCie` int(11) DEFAULT NULL,
  `fechaAper` datetime DEFAULT NULL,
  `fechaCie` datetime DEFAULT NULL,
  `Apertura` int(30) DEFAULT NULL,
  `ciere` int(30) DEFAULT NULL,
  `obs` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `caja_ibfk_1` (`idEmpleAper`),
  KEY `caja_ibfk_2` (`idEmpleCie`),
  CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`idEmpleAper`) REFERENCES `empleado` (`id`),
  CONSTRAINT `caja_ibfk_2` FOREIGN KEY (`idEmpleCie`) REFERENCES `empleado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `caja` */

insert  into `caja`(`id`,`nro_caja`,`idEmpleAper`,`idEmpleCie`,`fechaAper`,`fechaCie`,`Apertura`,`ciere`,`obs`) values (1,4,1,1,'2019-05-19 00:00:00','2019-05-26 01:37:10',200000,300000,NULL),(17,6,5,5,'2019-05-20 00:19:11','2019-05-26 01:39:06',5000000,5000000,NULL),(18,3,1,8,'2019-05-20 00:23:53','2019-05-26 01:27:23',500000,1500000,NULL),(19,1,1,4,'2019-05-22 23:31:24','2019-05-26 01:28:06',200000,250000,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `cliente` */

insert  into `cliente`(`id`,`ruc`,`nombre`,`telefono`,`direccion`,`email`,`ciudad`) values (1,'4358744','SANDRO DELGADO',1231231,'TENITE AKAPEROSDJFÑALKSDF','5654ASDA@GMAIL.COM',1),(2,'1212132-1','RODOLFO MENGUARE',32132212,'TTE AKAPERO','ASFDADS@GMAIL.COM',22),(3,'1235465-5','PEDRO SUARES',985201942,'TTE. CABRERA CASI DON BOSCO','TTE. CABRERA CASI DO',22),(4,'4354654','SANDRO CASTILLO',985201942,'TTE. CABRERA CASI DON BOSCO','TTE. CABRERA CASI DO',1),(5,'1212132-7','FULGENCIO YEGROS',321324564,'NUESTRA SEñORA DE LA CAPITAL','NUESTRA SEñORA DE LA',16),(6,'2135465461','ASUCENA RAMIREZ',21321654,'CORDILLERA DEL CHACO','CORDILLERA DEL CHACO',15);

/*Table structure for table `compraproduc` */

DROP TABLE IF EXISTS `compraproduc`;

CREATE TABLE `compraproduc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nro_factura` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `tipodeCompra` varchar(20) DEFAULT NULL,
  `producto` int(11) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=ascii;

/*Data for the table `compraproduc` */

insert  into `compraproduc`(`id`,`nro_factura`,`fecha`,`proveedor`,`tipodeCompra`,`producto`,`descripcion`,`cant`,`precio`,`iva`,`descuento`,`totalcompra`) values (1,1,'2019-05-21 01:36:35',1,'CONTADO',1,'3 pack de Gaseosa de litro',36,3000,300,0,108000);

/*Table structure for table `detalle_factura` */

DROP TABLE IF EXISTS `detalle_factura`;

CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `numero_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `numero_cotizacion` (`numero_factura`,`id_producto`),
  CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`numero_factura`) REFERENCES `facturacabecera` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `detalle_factura` */

/*Table structure for table `detallepedido` */

DROP TABLE IF EXISTS `detallepedido`;

CREATE TABLE `detallepedido` (
  `id` int(11) NOT NULL,
  `pedido` int(11) DEFAULT NULL,
  `producto` int(11) DEFAULT NULL,
  `cant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `producto` (`producto`),
  KEY `pedido` (`pedido`),
  CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `producto` (`id`),
  CONSTRAINT `detallepedido_ibfk_3` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `detallepedido` */

/*Table structure for table `empleado` */

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `empleado` */

insert  into `empleado`(`id`,`usuario`,`ci`,`nombre`,`apellido`,`fechanaci`,`nacionalidad`,`ciudad`,`barrio`,`telefono`,`cargo`,`direccion`) values (1,1,4358744,'Sandro Roberto','Castillo Delgado','1988-01-30','paraguaya',22,'Itacurubi',985201942,'Gerente','Tte. Cabrera C/ don bosco'),(4,7,123456,'Juliana','cabrera','1988-01-30','Paraguay',1,'barrio',985201942,'Cajero','Tte. Cabrera casi Don bosco'),(5,9,44444,'Calabera','Deshuesada','1987-02-15','nacionalidad',21,'barrio',21321,'Mesero','Soldado Desconocido'),(8,10,546555,'julian','acevedo','1978-03-22','nacionalidad',1,'barrio',21321,'cargo','dire'),(11,12,435788,'Luna Canela','DeJesús Castillo','2019-01-01','Paraguaya',22,'Itacurubi',331240667,'Cajero','Tte. Cabrera casi Don bosco');

/*Table structure for table `facturacabecera` */

DROP TABLE IF EXISTS `facturacabecera`;

CREATE TABLE `facturacabecera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suc` int(3) DEFAULT NULL,
  `caja` int(11) DEFAULT NULL,
  `nro_fac` int(7) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `caja` (`caja`),
  CONSTRAINT `facturacabecera_ibfk_1` FOREIGN KEY (`caja`) REFERENCES `caja` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `facturacabecera` */

/*Table structure for table `facturadetalle` */

DROP TABLE IF EXISTS `facturadetalle`;

CREATE TABLE `facturadetalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factura_cab` int(11) DEFAULT NULL,
  `pedido` int(11) DEFAULT NULL,
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
  KEY `producto` (`pedido`),
  KEY `sabores` (`sabores`),
  CONSTRAINT `facturadetalle_ibfk_1` FOREIGN KEY (`factura_cab`) REFERENCES `facturacabecera` (`id`),
  CONSTRAINT `facturadetalle_ibfk_3` FOREIGN KEY (`sabores`) REFERENCES `sabores` (`id`),
  CONSTRAINT `facturadetalle_ibfk_4` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8;

/*Data for the table `historial` */

insert  into `historial`(`id`,`fhconexion`,`fhdesconexion`,`usuario`,`nivel`) values (123,'2019-05-10 00:47:50','2019-05-10 00:47:50','ADMIN','ADMINISTRADOR'),(124,'2019-05-10 00:50:57',NULL,'SKULL','ADMINISTRADOR'),(125,'2019-05-10 00:54:57','0000-00-00 00:00:00','ADMIN','ADMINISTRADOR'),(126,'2019-05-10 01:04:12',NULL,'ADMIN','ADMINISTRADOR'),(127,'2019-05-10 01:06:56',NULL,'PEDRITO','ADMINISTRADOR'),(128,'2019-05-10 01:07:41',NULL,'ADMIN','ADMINISTRADOR'),(129,'2019-05-10 08:52:59',NULL,'ADMIN','ADMINISTRADOR'),(130,'2019-05-10 09:54:51',NULL,'ADMIN','ADMINISTRADOR'),(131,'2019-05-10 10:09:33',NULL,'ADMIN','ADMINISTRADOR'),(132,'2019-05-10 10:14:55',NULL,'ADMIN','ADMINISTRADOR'),(133,'2019-05-11 19:00:16',NULL,'ADMIN','ADMINISTRADOR'),(134,'2019-05-11 19:00:25',NULL,'ADMIN','ADMINISTRADOR'),(135,'2019-05-11 19:00:47',NULL,'ADMIN','ADMINISTRADOR'),(136,'2019-05-11 19:01:04',NULL,'ADMIN','ADMINISTRADOR'),(137,'2019-05-11 19:01:26',NULL,'ADMIN','ADMINISTRADOR'),(138,'2019-05-11 19:04:19',NULL,'ADMIN','ADMINISTRADOR'),(139,'2019-05-11 21:57:12',NULL,'ADMIN','ADMINISTRADOR'),(140,'2019-05-12 23:16:56',NULL,'ADMIN','ADMINISTRADOR'),(141,'2019-05-12 23:24:49',NULL,'ADMIN','ADMINISTRADOR'),(142,'2019-05-14 13:18:37',NULL,'ADMIN','ADMINISTRADOR'),(143,'2019-05-14 20:33:33',NULL,'ADMIN','ADMINISTRADOR'),(144,'2019-05-18 20:34:38',NULL,'ADMIN','ADMINISTRADOR'),(145,'2019-05-19 18:13:55',NULL,'ADMIN','ADMINISTRADOR'),(146,'2019-05-19 18:14:57',NULL,'lunacanela','ADMINISTRADOR'),(147,'2019-05-19 18:17:25',NULL,'ADMIN','ADMINISTRADOR'),(148,'2019-05-19 19:36:24',NULL,'ADMIN','ADMINISTRADOR'),(149,'2019-05-19 20:45:06',NULL,'calabera','USUARIO'),(150,'2019-05-19 20:46:00',NULL,'SKULL','ADMINISTRADOR'),(151,'2019-05-19 20:46:33',NULL,'ADMIN','ADMINISTRADOR'),(152,'2019-05-19 23:53:30',NULL,'SKULL','ADMINISTRADOR'),(153,'2019-05-20 00:23:41',NULL,'ADMIN','ADMINISTRADOR'),(154,'2019-05-20 22:35:02',NULL,'ADMIN','ADMINISTRADOR'),(155,'2019-05-21 12:30:43',NULL,'ADMIN','ADMINISTRADOR'),(156,'2019-05-21 12:35:02',NULL,'ADMIN','ADMINISTRADOR'),(157,'2019-05-22 18:51:28',NULL,'ADMIN','ADMINISTRADOR'),(158,'2019-05-26 01:38:27',NULL,'SKULL','ADMINISTRADOR'),(159,'2019-05-26 01:41:57',NULL,'ADMIN','ADMINISTRADOR'),(160,'2019-05-26 13:58:27',NULL,'SKULL','CAJERO'),(161,'2019-05-26 14:27:03',NULL,'SKULL','CAJERO'),(162,'2019-05-26 14:50:31',NULL,'SKULL','CAJERO'),(163,'2019-05-26 14:53:18',NULL,'SKULL','CAJERO'),(164,'2019-05-26 15:33:16',NULL,'SKULL','CAJERO'),(165,'2019-05-26 16:20:50',NULL,'JULIA','ADMINISTRACION'),(166,'2019-05-26 16:26:23',NULL,'JULIA','ADMINISTRACION'),(167,'2019-05-26 16:32:29',NULL,'SKULL','CAJERO'),(168,'2019-05-26 16:32:54',NULL,'JULIA','CONTABILIDAD'),(169,'2019-05-26 16:40:03',NULL,'SKULL','CAJERO'),(170,'2019-05-26 16:44:20',NULL,'JULIA','CONTABILIDAD'),(171,'2019-05-26 16:52:24',NULL,'SKULL','CAJERO'),(172,'2019-05-26 22:31:51',NULL,'ADMIN','ADMINISTRADOR'),(173,'2019-05-26 22:50:02',NULL,'ADMIN','ADMINISTRADOR'),(174,'2019-05-26 22:54:21',NULL,'SKULL','CAJERO'),(175,'2019-05-26 22:54:47',NULL,'ADMIN','ADMINISTRADOR'),(176,'2019-05-27 14:35:50',NULL,'ADMIN','ADMINISTRADOR'),(177,'2019-05-28 11:04:36',NULL,'ADMIN','ADMINISTRADOR'),(178,'2019-05-28 13:56:45',NULL,'ADMIN','ADMINISTRADOR'),(179,'2019-05-28 14:04:45',NULL,'ADMIN','ADMINISTRADOR'),(180,'2019-05-28 14:05:19',NULL,'JULIA','CONTABILIDAD'),(181,'2019-05-28 14:56:55',NULL,'ADMIN','ADMINISTRADOR'),(182,'2019-05-28 16:16:04',NULL,'SKULL','CAJERO'),(183,'2019-05-28 16:56:13',NULL,'ADMIN','ADMINISTRADOR'),(184,'2019-05-28 17:03:28',NULL,'SKULL','CAJERO'),(185,'2019-05-28 17:04:31',NULL,'JULIA','CONTABILIDAD'),(186,'2019-05-28 17:04:55',NULL,'SKULL','CAJERO'),(187,'2019-05-28 17:05:16',NULL,'JULIA','CONTABILIDAD'),(188,'2019-05-28 17:31:55',NULL,'ADMIN','ADMINISTRADOR'),(189,'2019-06-04 19:33:04',NULL,'ADMIN','ADMINISTRADOR'),(190,'2019-06-09 21:04:04',NULL,'ADMIN','ADMINISTRADOR');

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `marca` */

insert  into `marca`(`id`,`marca`) values (1,'COCA COLA'),(2,'PEPSI'),(4,'BRAMHA'),(5,'POLAR'),(7,'NIKO'),(8,'DE LA CASA');

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

/*Table structure for table `pedido` */

DROP TABLE IF EXISTS `pedido`;

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nroPedido` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `vendedor` int(11) DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `mesa` int(11) DEFAULT NULL,
  `cantPersona` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendedor` (`vendedor`),
  KEY `cliente` (`cliente`),
  KEY `mesa` (`mesa`),
  KEY `nroPedido` (`nroPedido`),
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`vendedor`) REFERENCES `empleado` (`id`),
  CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`mesa`) REFERENCES `mesa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `pedido` */

insert  into `pedido`(`id`,`nroPedido`,`fecha`,`vendedor`,`cliente`,`mesa`,`cantPersona`) values (8,2,'0000-00-00 00:00:00',5,2,8,2),(9,3,'0000-00-00 00:00:00',5,3,8,1),(10,4,'2019-06-10 17:43:26',5,2,8,2);

/*Table structure for table `postretamano` */

DROP TABLE IF EXISTS `postretamano`;

CREATE TABLE `postretamano` (
  `id` int(11) NOT NULL,
  `tamano` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `postretamano` */

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
  `bebidatamano` int(11) DEFAULT NULL,
  `postretamano` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria` (`categoria`),
  KEY `tamano` (`tamano`),
  KEY `marca` (`marca`),
  KEY `bebidatamano` (`bebidatamano`),
  KEY `postretamano` (`postretamano`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`tamano`) REFERENCES `tamano` (`id`),
  CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`),
  CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`bebidatamano`) REFERENCES `bebidastamano` (`id`),
  CONSTRAINT `producto_ibfk_5` FOREIGN KEY (`postretamano`) REFERENCES `postretamano` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `producto` */

insert  into `producto`(`id`,`nombre`,`categoria`,`marca`,`precio`,`tamano`,`stock`,`bebidatamano`,`postretamano`) values (1,'GASEOSA',7,2,5000,4,1000,NULL,NULL),(2,'MASITA',6,8,3000,3,200,NULL,NULL),(3,'RELLENO DE QUESO',8,8,35000,3,3,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `proveedor` */

insert  into `proveedor`(`id`,`ruc`,`nombre`,`telefono`,`direccion`,`ciudad`) values (1,'465465','SANDRO CASTILLO',985201942,'TTE. CABRERA CASI DON BOSCO',15),(2,'454654-4','CASA YASY',1231321,'TTE. CABRERA CASI DON BOSCO',22);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tamano` */

insert  into `tamano`(`id`,`tamano`) values (1,'EXTRA FAMILIAR'),(2,'FAMILIAR'),(3,'PERSONAL'),(4,'DE LITRO'),(5,'EN LATA 800 ML.'),(7,'EN COMPOTERA');

/*Table structure for table `tempcompra` */

DROP TABLE IF EXISTS `tempcompra`;

CREATE TABLE `tempcompra` (
  `id` int(11) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tempcompra` */

insert  into `tempcompra`(`id`,`codigo`,`descripcion`,`cantidad`,`precio`) values (0,1,'puto el que lo lea',1111,1500);

/*Table structure for table `tmp` */

DROP TABLE IF EXISTS `tmp`;

CREATE TABLE `tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tmp` */

insert  into `tmp`(`id`,`descripcion`,`cantidad`,`precio`) values (8,'puto el que lo lea',108,135000.00);

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

insert  into `usuario`(`id`,`usuario`,`pass`,`nivel`,`estado`) values (1,'ADMIN','202cb962ac59075b964b07152d234b70','ADMINISTRADOR','activo'),(7,'JULIA','202cb962ac59075b964b07152d234b70','CONTABILIDAD','inactivo'),(8,'PEDRITO','202cb962ac59075b964b07152d234b70','USUARIO','inactivo'),(9,'SKULL','202cb962ac59075b964b07152d234b70','CAJERO','inactivo'),(10,'ING.INFO','bcbe3365e6ac95ea2c0343a2395834dd','ADMINISTRADOR','inactivo'),(11,'calabera','202cb962ac59075b964b07152d234b70','USUARIO','inactivo'),(12,'lunacanela','046ecac2f9e4e6fcaecb3fa829ba5d4a','ADMINISTRADOR','inactivo');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
