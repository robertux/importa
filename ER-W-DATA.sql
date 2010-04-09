-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.51a-24+lenny2


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema importa
--

CREATE DATABASE IF NOT EXISTS importa;
USE importa;

--
-- Definition of table `importa`.`Usuario`
--

DROP TABLE IF EXISTS `importa`.`Usuario`;
CREATE TABLE  `importa`.`Usuario` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`Usuario`
--

/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
LOCK TABLES `Usuario` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;


--
-- Definition of table `importa`.`accesorio`
--

DROP TABLE IF EXISTS `importa`.`accesorio`;
CREATE TABLE  `importa`.`accesorio` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `marca` int(10) unsigned NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `url_imagen` varchar(200) default NULL,
  `precio` double unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_accesorio_marca` (`marca`),
  CONSTRAINT `fk_accesorio_marca` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`accesorio`
--

/*!40000 ALTER TABLE `accesorio` DISABLE KEYS */;
LOCK TABLES `accesorio` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `accesorio` ENABLE KEYS */;


--
-- Definition of table `importa`.`compatible_vehiculo_acc`
--

DROP TABLE IF EXISTS `importa`.`compatible_vehiculo_acc`;
CREATE TABLE  `importa`.`compatible_vehiculo_acc` (
  `id` int(10) unsigned NOT NULL,
  `idvehiculo` int(10) unsigned NOT NULL,
  `idaccesorio` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_compatible_vehiculo_acc` (`idvehiculo`),
  KEY `fk_compatible_accesorio_acc` (`idaccesorio`),
  CONSTRAINT `fk_compatible_accesorio_acc` FOREIGN KEY (`idaccesorio`) REFERENCES `accesorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compatible_vehiculo_acc` FOREIGN KEY (`idvehiculo`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`compatible_vehiculo_acc`
--

/*!40000 ALTER TABLE `compatible_vehiculo_acc` DISABLE KEYS */;
LOCK TABLES `compatible_vehiculo_acc` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `compatible_vehiculo_acc` ENABLE KEYS */;


--
-- Definition of table `importa`.`compatible_vehiculo_rep`
--

DROP TABLE IF EXISTS `importa`.`compatible_vehiculo_rep`;
CREATE TABLE  `importa`.`compatible_vehiculo_rep` (
  `id` int(10) unsigned NOT NULL,
  `idvehiculo` int(10) unsigned NOT NULL,
  `idrepuesto` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_compatible_vehiculo_rep` (`idvehiculo`),
  KEY `fk_compatible_repuesto_rep` (`idrepuesto`),
  CONSTRAINT `fk_compatible_repuesto_rep` FOREIGN KEY (`idrepuesto`) REFERENCES `repuesto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compatible_vehiculo_rep` FOREIGN KEY (`idvehiculo`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`compatible_vehiculo_rep`
--

/*!40000 ALTER TABLE `compatible_vehiculo_rep` DISABLE KEYS */;
LOCK TABLES `compatible_vehiculo_rep` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `compatible_vehiculo_rep` ENABLE KEYS */;


--
-- Definition of table `importa`.`item_oferta`
--

DROP TABLE IF EXISTS `importa`.`item_oferta`;
CREATE TABLE  `importa`.`item_oferta` (
  `id` int(10) unsigned NOT NULL,
  `oferta` int(10) unsigned NOT NULL,
  `iditem` int(10) unsigned NOT NULL,
  `tipoitem` int(10) unsigned NOT NULL,
  `cantidaditem` int(10) unsigned NOT NULL,
  `descuento` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_item_oferta_oferta` (`oferta`),
  CONSTRAINT `fk_item_oferta_oferta` FOREIGN KEY (`oferta`) REFERENCES `oferta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`item_oferta`
--

/*!40000 ALTER TABLE `item_oferta` DISABLE KEYS */;
LOCK TABLES `item_oferta` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `item_oferta` ENABLE KEYS */;


--
-- Definition of table `importa`.`marca`
--

DROP TABLE IF EXISTS `importa`.`marca`;
CREATE TABLE  `importa`.`marca` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(100) NOT NULL,
  `url_imagen` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`marca`
--

/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
LOCK TABLES `marca` WRITE;
INSERT INTO `importa`.`marca` VALUES  (0,'default','blank.png'),
 (1,'Toyota','blank.png'),
 (2,'Mazda','blank.png'),
 (3,'Honda','blank.png'),
 (4,'Mitsubishi','blank.png');
UNLOCK TABLES;
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;


--
-- Definition of table `importa`.`oferta`
--

DROP TABLE IF EXISTS `importa`.`oferta`;
CREATE TABLE  `importa`.`oferta` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`oferta`
--

/*!40000 ALTER TABLE `oferta` DISABLE KEYS */;
LOCK TABLES `oferta` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `oferta` ENABLE KEYS */;


--
-- Definition of table `importa`.`repuesto`
--

DROP TABLE IF EXISTS `importa`.`repuesto`;
CREATE TABLE  `importa`.`repuesto` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `marca` int(10) unsigned NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `url_imagen` varchar(200) default NULL,
  `precio` double unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_repuesto_marca` (`marca`),
  CONSTRAINT `fk_repuesto_marca` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`repuesto`
--

/*!40000 ALTER TABLE `repuesto` DISABLE KEYS */;
LOCK TABLES `repuesto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `repuesto` ENABLE KEYS */;


--
-- Definition of table `importa`.`tipo_vehiculo`
--

DROP TABLE IF EXISTS `importa`.`tipo_vehiculo`;
CREATE TABLE  `importa`.`tipo_vehiculo` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`tipo_vehiculo`
--

/*!40000 ALTER TABLE `tipo_vehiculo` DISABLE KEYS */;
LOCK TABLES `tipo_vehiculo` WRITE;
INSERT INTO `importa`.`tipo_vehiculo` VALUES  (0,'default');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipo_vehiculo` ENABLE KEYS */;


--
-- Definition of table `importa`.`vehiculo`
--

DROP TABLE IF EXISTS `importa`.`vehiculo`;
CREATE TABLE  `importa`.`vehiculo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tipo` int(10) unsigned NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `anio` int(11) NOT NULL,
  `marca` int(10) unsigned NOT NULL,
  `estado` int(11) NOT NULL COMMENT 'se manejaran los estados desde php y no se almacenaran en una tabla aparte',
  `url_imagen` varchar(200) default NULL,
  `precio` double unsigned NOT NULL,
  `descripcion` text,
  PRIMARY KEY  (`id`),
  KEY `fk_vehiculo_marca` (`marca`),
  KEY `fk_vehiculo_tipo` (`tipo`),
  CONSTRAINT `fk_vehiculo_marca` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehiculo_tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importa`.`vehiculo`
--

/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
LOCK TABLES `vehiculo` WRITE;
INSERT INTO `importa`.`vehiculo` VALUES  (0,0,'default',1997,1,2,'default.jpg',6200,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at lectus arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed consectetur nulla ac leo vehicula rhoncus vitae et dolor. Nullam fringilla, ligula nec facilisis feugiat, metus neque tincidunt tellus, et pulvinar enim libero vel nunc. Fusce dui dolor, gravida sit amet consequat blandit, sollicitudin a eros. Curabitur vitae risus arcu. Phasellus a mauris id lectus imperdiet euismod id eget tortor. Nam tincidunt dolor a metus lobortis id hendrerit felis suscipit. Vivamus laoreet molestie enim non condimentum. Sed dictum ipsum quam. Vivamus feugiat libero sit amet tellus pretium vestibulum. Curabitur mi justo, porttitor non commodo scelerisque, accumsan eget quam. Suspendisse tempus rutrum tempor. Maecenas placerat urna eu neque luctus egestas. Duis eros erat, fermentum vulputate tempus vitae, dictum sit amet dolor. Nulla facilisi.'),
 (1,0,'default',2003,2,2,'default.jpg',4000,'Ut metus justo, convallis in adipiscing vitae, rutrum non arcu. Vivamus ut nisi id odio varius aliquam. Donec varius quam quis elit dictum vitae pulvinar ante tempus. Nulla facilisi. Aenean ultricies ante gravida dui tincidunt at suscipit est fringilla. Duis interdum interdum arcu at vehicula. Praesent vulputate varius massa, sit amet rutrum est tincidunt quis. Aliquam vitae quam elit. Quisque libero ipsum, placerat at vulputate et, tincidunt non dui. Donec porttitor gravida elit, ut iaculis augue vestibulum quis. Sed nec odio odio, et ullamcorper magna. Ut luctus malesuada diam, nec molestie tortor dictum in. Morbi lacinia ultrices ultrices. Duis feugiat feugiat ultricies. Quisque urna sem, fermentum at feugiat nec, commodo at orci. Ut pulvinar dictum lorem, eu euismod justo congue non. Nullam sed nibh placerat dolor commodo accumsan ullamcorper non lorem. Donec ullamcorper augue dapibus neque molestie sed feugiat mi faucibus. Nulla ac ligula sit amet quam bibendum varius in sed nulla. Cras eu aliquam felis.');
INSERT INTO `importa`.`vehiculo` VALUES  (2,0,'default',2001,4,2,'default.jpg',8000,'Praesent vulputate luctus metus, vestibulum sagittis lorem viverra a. Aenean tincidunt blandit diam, id euismod libero commodo congue. Maecenas nec ipsum nisl, in laoreet ipsum. Suspendisse elementum nisi augue. Etiam pretium nisl sit amet erat sollicitudin rhoncus. Nullam blandit dui mattis mauris laoreet ac convallis erat faucibus. Nullam eget justo id elit suscipit fringilla sed non orci. Etiam rutrum dignissim justo, in dictum augue malesuada vitae. Nunc nec magna tristique lorem eleifend semper. Phasellus tincidunt, justo sed posuere volutpat, magna libero accumsan lorem, lobortis volutpat diam purus sit amet orci. Maecenas porta luctus cursus. Donec nec mauris arcu, nec laoreet augue.'),
 (3,0,'default',2005,4,2,'default.jpg',5400,'Praesent at consectetur erat. Donec commodo tristique felis elementum bibendum. Fusce condimentum velit ac neque suscipit tincidunt. Ut rhoncus tempor tortor, sit amet facilisis magna imperdiet sit amet. Proin mattis dapibus nunc, nec sollicitudin nunc venenatis in. Vestibulum ut magna ut augue imperdiet cursus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam a mattis velit. In gravida purus a dui consequat quis molestie nibh egestas. Pellentesque lacinia condimentum est vitae tempus. Phasellus in risus eu purus congue tincidunt id fermentum lorem. Donec ante dolor, faucibus et luctus sit amet, gravida sit amet lacus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
 (4,0,'default',2008,3,2,'default.jpg',5000,'Duis nisl enim, iaculis quis iaculis eget, pulvinar congue felis. Quisque vel purus mauris. Morbi condimentum sollicitudin lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dignissim laoreet arcu vitae suscipit. Donec posuere turpis tortor, ut pretium dolor. Donec sed arcu sed odio molestie consequat. Donec lorem ipsum, vehicula id dictum eu, porta et lectus. Duis tellus ligula, pretium eget suscipit non, vulputate sed velit. Curabitur hendrerit rhoncus nisi, et fringilla odio sagittis id. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed tempus blandit orci, eget vestibulum neque sagittis non. Morbi molestie, nisi vitae mattis euismod, est felis aliquet est, vitae rutrum arcu justo et diam. Vivamus tincidunt turpis hendrerit ligula auctor non iaculis neque tempor.');
INSERT INTO `importa`.`vehiculo` VALUES  (5,0,'default',2001,1,2,'default.jpg',7500,'Nulla quam enim, luctus ullamcorper feugiat vitae, molestie id leo. Sed iaculis tempus sapien eget iaculis. In lacinia aliquet tincidunt. Fusce et volutpat magna. Nam eget blandit eros. Pellentesque est ligula, pulvinar ut pharetra at, suscipit sit amet est. Duis viverra tortor quis orci egestas pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris massa eros, luctus ac ullamcorper convallis, accumsan vitae velit. Cras aliquet, diam ut condimentum porta, magna mi tempus eros, vel hendrerit neque urna vitae quam. Nunc mi orci, condimentum vitae ultrices quis, tempor ac ipsum. Nulla facilisi. Sed velit erat, sagittis quis scelerisque in, lacinia at diam. Aliquam tortor nisi, consectetur eget interdum sit amet, sollicitudin sit amet augue. Nulla at condimentum erat. Phasellus mattis est ut libero pulvinar consequat. Proin rhoncus massa at elit luctus a porttitor odio pulvinar.');
UNLOCK TABLES;
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
