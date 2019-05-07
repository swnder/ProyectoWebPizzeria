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
  KEY `idEmpleAper` (`idEmpleAper`),
  KEY `idEmpleCie` (`idEmpleCie`),
  CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`idEmpleAper`) REFERENCES `cliente` (`id`),
  CONSTRAINT `caja_ibfk_2` FOREIGN KEY (`idEmpleCie`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `caja` */

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `categoria` */

/*Table structure for table `ciudad` */

DROP TABLE IF EXISTS `ciudad`;

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(30) DEFAULT NULL,
  `departamento` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `ciudad` */

insert  into `ciudad`(`id`,`ciudad`,`departamento`) values (1,'CONCEPCIóN','CONCEPCION'),(8,'LORETO','CONCEPCION'),(13,'HORQUETA','CONCEPCION'),(14,'VALLEMI','CONCEPCION'),(15,'SAN CARLOS','CONCEPCION');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cliente` */

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
  `nombre` varchar(30) DEFAULT NULL,
  `fechanaci` date DEFAULT NULL,
  `nacionalidad` varchar(30) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `cargo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario` (`usuario`),
  KEY `ciudad` (`ciudad`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`),
  CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `empleado` */

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
  `idusuario` int(11) DEFAULT NULL,
  `fhconexion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhdesconexion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Data for the table `historial` */

insert  into `historial`(`id`,`idusuario`,`fhconexion`,`fhdesconexion`) values (15,1,'2019-05-04 21:34:56','0000-00-00 00:00:00'),(16,2,'2019-05-04 21:35:53','0000-00-00 00:00:00'),(17,1,'2019-05-04 21:37:41','0000-00-00 00:00:00'),(18,1,'2019-05-04 22:25:35','0000-00-00 00:00:00'),(19,2,'2019-05-04 22:33:16','0000-00-00 00:00:00'),(20,2,'2019-05-04 22:34:39','0000-00-00 00:00:00'),(21,2,'2019-05-04 22:36:45','0000-00-00 00:00:00'),(22,2,'2019-05-04 22:37:29','0000-00-00 00:00:00'),(23,2,'2019-05-04 22:42:25','0000-00-00 00:00:00'),(24,1,'2019-05-04 23:25:00','0000-00-00 00:00:00'),(25,2,'2019-05-04 23:29:40','0000-00-00 00:00:00'),(26,2,'2019-05-04 23:58:22','0000-00-00 00:00:00'),(27,2,'2019-05-05 00:27:46','0000-00-00 00:00:00'),(28,2,'2019-05-05 00:28:45','0000-00-00 00:00:00'),(29,1,'2019-05-05 00:30:07','0000-00-00 00:00:00'),(30,1,'2019-05-05 00:34:26','0000-00-00 00:00:00'),(31,1,'2019-05-05 11:18:03','0000-00-00 00:00:00'),(32,2,'2019-05-05 12:31:15','0000-00-00 00:00:00'),(33,2,'2019-05-05 19:06:58','0000-00-00 00:00:00'),(34,2,'2019-05-05 19:20:57','0000-00-00 00:00:00'),(35,1,'2019-05-05 19:37:45','0000-00-00 00:00:00'),(36,1,'2019-05-06 00:34:57','0000-00-00 00:00:00'),(37,1,'2019-05-06 00:37:33','0000-00-00 00:00:00'),(38,2,'2019-05-06 00:44:49','0000-00-00 00:00:00'),(39,2,'2019-05-06 02:45:40','0000-00-00 00:00:00'),(40,1,'2019-05-06 11:02:57','0000-00-00 00:00:00'),(41,1,'2019-05-06 15:11:36','0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mesa` */

insert  into `mesa`(`id`,`descripcion`,`ubicacion`,`sillas`) values (1,'NDA QUE MOSTRAR','EN EL CIELO',4),(2,'MESA REDONDA','EN EL CENTRO',5);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `proveedor` */

/*Table structure for table `sabores` */

DROP TABLE IF EXISTS `sabores`;

CREATE TABLE `sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sabores` varchar(40) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sabores` */

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`usuario`,`pass`,`nivel`) values (1,'PEDRO','37693cfc748049e45d87b8c7d8b9aacd','Administrador'),(2,'PEDRO','37693cfc748049e45d87b8c7d8b9aacd','Administrador'),(4,'JULIA','eccbc87e4b5ce2fe28308fd9f2a7baf3','USUARIO');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
