/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.14-MariaDB : Database - xenturionit_respaldo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`xenturionit_respaldo` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `xenturionit_respaldo`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `ID_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_admin` varchar(75) DEFAULT NULL,
  `apellido_admin` varchar(75) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `hash_pass` varchar(60) NOT NULL,
  `nivel` int(1) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  `estado_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_admin`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

/*Data for the table `admins` */

insert  into `admins`(`ID_admin`,`nombre_admin`,`apellido_admin`,`usuario`,`hash_pass`,`nivel`,`creado`,`actualizado`,`estado_admin`) values (1,'admin','admin','admin','$2y$12$lHcrW0zESdGLopYmrO4eA.b4BG.bEPRu0Q81UQb449WcwPizJoYIG',1,NULL,'2022-04-22 23:04:31',1),(2,'Anthony','Piguave','anthony','$2y$12$JTF5VEf.wPmmPZ3KDyZ4teBN09VB.ym1nKpvbV/g8bnazVSrMOlLO',0,'2022-04-25 20:39:16','2022-05-17 21:19:22',1);

/*Table structure for table `categoria_evento` */

DROP TABLE IF EXISTS `categoria_evento`;

CREATE TABLE `categoria_evento` (
  `id_categoria` tinyint(10) NOT NULL AUTO_INCREMENT,
  `cat_evento` varchar(50) NOT NULL,
  `icono` varchar(15) NOT NULL,
  `actualizado` datetime NOT NULL,
  `estado_categoria` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `categoria_evento` */

insert  into `categoria_evento`(`id_categoria`,`cat_evento`,`icono`,`actualizado`,`estado_categoria`) values (1,'SEMINARIO','fa-address-book','2022-05-16 23:20:10',1),(2,'Conferencia','fa-address-book','2022-04-23 13:04:35',1),(3,'TALLERES','fa-code','2022-05-19 20:33:39',1),(46,'adas','fa-500px','0000-00-00 00:00:00',0);

/*Table structure for table `cuentas_bancarias` */

DROP TABLE IF EXISTS `cuentas_bancarias`;

CREATE TABLE `cuentas_bancarias` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre_banco` varchar(50) DEFAULT NULL,
  `tipo_cuenta` varchar(15) DEFAULT NULL,
  `nro_cuenta` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ced_ruc` varchar(14) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Data for the table `cuentas_bancarias` */

insert  into `cuentas_bancarias`(`id`,`nombre_banco`,`tipo_cuenta`,`nro_cuenta`,`email`,`ced_ruc`,`descripcion`,`creado`,`actualizado`,`estado`) values (1,'PICHINCHA','CORRIENTE','123','email@email.com','0953708050001','TRANFERENCIA BANCO PICHINCHA',NULL,'2022-05-16 21:58:24',1),(32,'GUAYAQUIL','CORRIENTE','123','email@email.com','0953708050001','TRANFERENCIA BANCO GUAYAQUIL','2022-05-16 21:23:21','2022-05-17 21:24:06',1);

/*Table structure for table `eventos` */

DROP TABLE IF EXISTS `eventos`;

CREATE TABLE `eventos` (
  `evento_id` tinyint(10) NOT NULL AUTO_INCREMENT,
  `nombre_evento` varchar(60) NOT NULL,
  `fecha_evento` date NOT NULL,
  `hora_evento` varchar(10) NOT NULL,
  `cupo` int(11) DEFAULT NULL,
  `id_cat_evento` tinyint(10) NOT NULL,
  `id_inv` tinyint(4) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `fecha_creado` datetime DEFAULT NULL,
  `fecha_editado` date DEFAULT NULL,
  `estado_evento` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`evento_id`),
  KEY `id_cat_evento` (`id_cat_evento`),
  KEY `id_inv` (`id_inv`),
  CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_cat_evento`) REFERENCES `categoria_evento` (`id_categoria`),
  CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_inv`) REFERENCES `invitados` (`invitado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

/*Data for the table `eventos` */

insert  into `eventos`(`evento_id`,`nombre_evento`,`fecha_evento`,`hora_evento`,`cupo`,`id_cat_evento`,`id_inv`,`clave`,`fecha_creado`,`fecha_editado`,`estado_evento`) values (1,'HTML5 y CSS3','2022-09-24','02:00 PM',0,3,3,'taller_01',NULL,'2022-05-05',0),(6,'WordPress','2016-12-09','19:00:00',NULL,3,5,'taller_13',NULL,NULL,0),(7,'Como ser freelancer','2016-12-09','10:00 AM',0,2,2,'conf_01',NULL,'2022-05-16',0),(8,'Tecnologías del Futuro PHP','2016-12-09','05:00 PM',NULL,2,3,'conf_02',NULL,NULL,0),(9,'Seguridad en la Web','2016-12-09','07:00 PM',NULL,2,2,'conf_03',NULL,NULL,0),(10,'Diseño UI y UX para móviles','2016-12-09','10:00:00',NULL,1,6,'sem_01',NULL,NULL,1),(12,'PHP y MySQL','2016-12-10','12:00:00',NULL,3,2,'taller_03',NULL,NULL,0),(13,'JavaScript Avanzado','2016-12-10','14:00:00',NULL,3,3,'taller_04',NULL,NULL,0),(14,'SEO en Google','2016-12-10','17:00:00',NULL,3,4,'taller_05',NULL,NULL,0),(15,'De Photoshop a HTML5 y CSS3','2016-12-10','19:00:00',NULL,3,5,'taller_06',NULL,NULL,0),(16,'PHP Intermedio y Avanzado','2016-12-10','21:00:00',NULL,3,6,'taller_07',NULL,NULL,0),(17,'Como crear una tienda online que venda millones en pocos día','2016-12-10','10:00 AM',0,2,2,'conf_04',NULL,'2022-05-16',0),(18,'Los mejores lugares para encontrar trabajo','2016-12-10','17:00:00',NULL,2,1,'conf_05',NULL,NULL,0),(19,'Pasos para crear un negocio rentable ','2016-12-10','19:00:00',NULL,2,2,'conf_06',NULL,NULL,0),(22,'Laravel','2016-12-11','10:00:00',NULL,3,1,'taller_08',NULL,NULL,0),(23,'Crea tu propia API','2016-12-11','12:00:00',NULL,3,2,'taller_09',NULL,NULL,0),(24,'JavaScript y jQuery','2016-12-11','14:00:00',NULL,3,3,'taller_10',NULL,NULL,0),(25,'Creando Plantillas para WordPress','2016-12-11','17:00:00',NULL,3,4,'taller_11',NULL,NULL,0),(26,'Tiendas Virtuales en Magento','2016-12-11','19:00:00',NULL,3,5,'taller_12',NULL,NULL,0),(30,'Creando una App en Android en una mañana','2016-12-11','10:00:00',NULL,1,4,'sem_04',NULL,NULL,1),(31,'Creando una App en iOS en una tarde','2016-12-11','17:00:00',NULL,1,1,'sem_05',NULL,NULL,0),(32,'Flexbox para principiantes','2016-12-10','11:00:00',NULL,2,4,'conf_07',NULL,NULL,1),(78,'Apache Ignite: Mejora la Velocidad, la Escala y la Disponibi','2022-05-31','08:00 AM',25,3,3,'','2022-04-25 22:10:00',NULL,1),(79,'Utilizando la Red Informática ToolKit (CNTK) - Guayaquil','2022-10-01','10:00 PM',26,3,3,'','2022-04-25 22:21:53',NULL,1),(81,'PYTHON & JAVASCRIPT','2022-06-03','10:15 PM',20,2,2,'','2022-05-16 22:19:19','2022-05-16',1),(82,'JAVA Y KOTLIN','2022-06-01','10:15 PM',20,3,3,'','2022-05-16 22:23:03','2022-05-16',1);

/*Table structure for table `invitados` */

DROP TABLE IF EXISTS `invitados`;

CREATE TABLE `invitados` (
  `invitado_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre_invitado` varchar(30) NOT NULL,
  `apellido_invitado` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `url_imagen` varchar(50) NOT NULL,
  `editado` datetime NOT NULL,
  `url_facebook` varchar(200) DEFAULT NULL,
  `url_twitter` varchar(200) DEFAULT NULL,
  `url_instagram` varchar(200) DEFAULT NULL,
  `estado_invitado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`invitado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `invitados` */

insert  into `invitados`(`invitado_id`,`nombre_invitado`,`apellido_invitado`,`descripcion`,`url_imagen`,`editado`,`url_facebook`,`url_twitter`,`url_instagram`,`estado_invitado`) values (1,'Willow ','Trantow','Dennis Ritchie fue un reconocido científico informático estadounidense. Es mejor recordado por crear el lenguaje de programación C y sus contribuciones al desarrollo del sistema operativo UNIX.','willow_trantow(1).jpg','2022-05-05 21:40:31',NULL,NULL,NULL,1),(2,'Cole ','Emmerich  ','un estudiante finlandés, desarrolló el sistema operativo Linux, similar a Unix mientras estaba haciendo su maestría en el año 1991.','3(1).jpg','2022-05-05 21:40:01',NULL,NULL,NULL,1),(3,'Brenden ','Legros','Brenden Legros Nació el 29 de enero de 1972 en Cambridge.','Brenden_Legros.png','2022-05-05 21:39:46',NULL,NULL,NULL,1),(4,'Jack ','Christiansen','Stephen Gary Wozniak, hijo de un ingeniero de Lockheed Martin, nacido el 11 de agosto de 1950, quedó fascinado por la electrónica a una edad temprana. Aunque nunca fue un estudiante estrella en el sentido tradicional, Wozniak tenía una aptitud para construir componentes electrónicos que funcionen desde cero.','2(1).jpg','2022-05-05 21:40:13',NULL,NULL,NULL,1),(5,'Harold','Garcia','Científico computacional estadounidense. Colaboró en el diseño y desarrollo de los sistemas operativos Multics y Unix, así como el desarrollo de varios lenguajes de programación como el C','5(1).jpg','2022-05-05 21:45:31',NULL,NULL,NULL,1),(6,'Alejandrin ','Littel','Sergey Mikhaylovich Brin, empresario de Internet e informático, nació el 21 de agosto de 1973 en Moscú, Rusia. El hijo de un matemático soviético economista, Brin y su familia emigraron a los Estados Unidos para escapar de la persecución judía en 1979. Luego de graduarse en matemáticas y ciencias de la computación de la Universidad de Maryland en College Park, Brin ingresó a la Universidad de Stanford, donde se reunió Página Larry. Ambos alumnos estaban completando doctorados en informática.','4(1).jpg','2022-05-05 21:43:05',NULL,NULL,NULL,1),(7,'Andres','Parra','Es un mexicano, ingeniero físico graduado de la Universidad Iberoamericana y actor formado en CEFAC, la escuela oficial de actuación de TV Azteca y en CEA, la escuela oficial de actores de Televisa. Debido a su trayectoria académica y a su experiencia en su negocio de mercadeo en red, donde llegó a ser uno de los distribuidores más grandes del mundo en la industria, Diego empezó a utilizar sus habilidades para comunicar de manera sistematizada su conocimiento y experiencias de vida, dando conferencias y talleres en 2005, para motivar a su audiencia a superarse, a lograr sus metas y a diseñar la vida deseada.','invitado1.jpg','2022-05-05 21:47:33','https://facebook.com/a1','https://twitter.com/a1','https://instagram.com/a1',1),(35,'12w3123','2131231','312312','4k-deadpool.jpg','2022-05-17 21:00:37','1231312','23123123','3123',0);

/*Table structure for table `regalos` */

DROP TABLE IF EXISTS `regalos`;

CREATE TABLE `regalos` (
  `ID_regalo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_regalo` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_regalo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `regalos` */

insert  into `regalos`(`ID_regalo`,`nombre_regalo`) values (1,'Pulsera'),(2,'Etiquetas'),(3,'Plumas');

/*Table structure for table `registrados` */

DROP TABLE IF EXISTS `registrados`;

CREATE TABLE `registrados` (
  `ID_Registrado` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_registrado` varchar(50) NOT NULL,
  `apellido_registrado` varchar(50) NOT NULL,
  `email_registrado` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `pases_articulos` longtext NOT NULL,
  `talleres_registrados` longtext NOT NULL,
  `regalo` int(11) NOT NULL,
  `total_pagado` varchar(50) NOT NULL,
  `pagado` int(1) NOT NULL,
  `forma_pago` varchar(25) DEFAULT NULL,
  `estado_registrado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_Registrado`),
  KEY `regalo` (`regalo`),
  CONSTRAINT `registrados_ibfk_1` FOREIGN KEY (`regalo`) REFERENCES `regalos` (`ID_regalo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `registrados` */

insert  into `registrados`(`ID_Registrado`,`nombre_registrado`,`apellido_registrado`,`email_registrado`,`fecha_registro`,`pases_articulos`,`talleres_registrados`,`regalo`,`total_pagado`,`pagado`,`forma_pago`,`estado_registrado`) values (1,'NOMBRE','APELLIDO','prueba@gmail.com','2022-04-01 04:15:44','{\"un_dia\":{\"cantidad\":\"1\"},\"pase_completo\":{\"cantidad\":\"0\"},\"pase_2dias\":{\"cantidad\":\"0\"},\"camisas\":1,\"etiquetas\":1}','{\"eventos\":[\"10\"]}',2,'41.3',1,'Paypal',0),(2,'AXEL','GALARZA','axel@gmail.com','2022-04-01 04:20:39','{\"un_dia\":{\"cantidad\":\"\"},\"pase_completo\":{\"cantidad\":\"1\"},\"pase_2dias\":{\"cantidad\":\"\"},\"camisas\":1,\"etiquetas\":2}','{\"eventos\":[\"8\",\"17\",\"12\",\"22\",\"24\"]}',1,'63.3',1,'Paypal',0),(3,'RAUL','TORRES','pruebacompra@gmail.com','2022-05-05 04:21:57','{\"un_dia\":{\"cantidad\":\"2\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"1\"},\"camisas\":1,\"etiquetas\":2}','{\"eventos\":[\"10\",\"17\"]}',2,'118.3',0,'Paypal',0),(4,'ANDRES','ANDRADE','andres@gmail.com','2022-05-10 04:22:37','{\"un_dia\":{\"cantidad\":\"2\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"1\"},\"camisas\":1,\"etiquetas\":2}','{\"eventos\":[\"10\",\"17\"]}',2,'118.3',1,'Paypal',0),(5,'MARIA','TORRES','maria@gmail.com','2022-05-14 04:25:31','{\"un_dia\":{\"cantidad\":\"2\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"1\"},\"camisas\":1,\"etiquetas\":1}','{\"eventos\":[\"4\",\"12\"]}',2,'116.3',1,'Paypal',0),(8,'CARLOS','VILLALTA','testventa@gmail.com','2022-05-14 19:03:28','{\"un_dia\":{\"cantidad\":\"1\"},\"pase_completo\":{\"cantidad\":\"1\"},\"pase_2dias\":{\"cantidad\":\"1\"},\"camisas\":1,\"etiquetas\":1}','{\"eventos\":[\"8\",\"17\",\"30\"]}',1,'136.3',1,'Paypal',0),(9,'NICOLE','FERNANDES','nicolefernandes@gmail.com','2022-05-15 02:54:02','{\"un_dia\":{\"cantidad\":\"1\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"\"},\"camisas\":1,\"etiquetas\":1}','{\"eventos\":[\"10\",\"8\"]}',2,'41.3',1,'Paypal',0),(12,'CHRISTIAN','ALVARADO','pruebacompra@gmail.com','2022-05-15 05:16:14','{\"un_dia\":{\"cantidad\":\"1\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"\"},\"camisas\":1}','{\"eventos\":[\"10\"]}',3,'39.3',1,'Paypal',0),(13,'LUIS','LUIS','pruebacompra@gmail.com','2022-05-15 05:17:37','{\"un_dia\":{\"cantidad\":\"\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"1\"},\"camisas\":10,\"etiquetas\":10}','{\"eventos\":[\"79\",\"12\"]}',1,'158',0,'Transferencia o Depósito',1),(14,'pruebacompra@gmail.com','pruebacompra@gmail.com','pruebacompra@gmail.com','2022-05-20 04:31:40','{\"un_dia\":{\"cantidad\":\"1\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"\"},\"camisas\":1,\"etiquetas\":1}','{\"eventos\":[\"10\"]}',2,'41.3',1,'Paypal',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
