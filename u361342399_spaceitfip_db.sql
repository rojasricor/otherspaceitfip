-- MariaDB dump 10.19  Distrib 10.6.11-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u361342399_spaceitfip_db
-- ------------------------------------------------------
-- Server version	10.6.11-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administradores_spaceitfip`
--

DROP TABLE IF EXISTS `administradores_spaceitfip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administradores_spaceitfip` (
  `id_administrador` int(11) NOT NULL AUTO_INCREMENT,
  `nombres_administrador` text NOT NULL,
  `apellidos_administrador` text NOT NULL,
  `correo_institucional_administrador` text NOT NULL,
  `contraseña_administrador` text NOT NULL,
  PRIMARY KEY (`id_administrador`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores_spaceitfip`
--

/*!40000 ALTER TABLE `administradores_spaceitfip` DISABLE KEYS */;
INSERT INTO `administradores_spaceitfip` VALUES (1,'administrador','uno','administrador1@itfip.edu.co','$2y$10$V2Y3dSnBFj1mIXBAr.NAM.hGrQdG3ivkKyZv0UaZgQjDYlTapCjLi'),(2,'administrador','dos','administrador2@itfip.edu.co','$2y$10$uAAH.wD4irTbHWPrRA4S/uoVdlFXmJglTIIw1MQd5LnISZj9le8oS'),(3,'administrador','tres','administrador3@itfip.edu.co','$2y$10$EfUJ9xWVW3f8UGQcxdCzKOTMP0fr8xzG7MS0NVVgoDGHsoryUDsjW');
/*!40000 ALTER TABLE `administradores_spaceitfip` ENABLE KEYS */;

--
-- Table structure for table `aprobacion_prestamos_bienes_itfip`
--

DROP TABLE IF EXISTS `aprobacion_prestamos_bienes_itfip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aprobacion_prestamos_bienes_itfip` (
  `id_aprobacion` bigint(11) NOT NULL AUTO_INCREMENT,
  `fecha_aprobacion_bien` datetime NOT NULL DEFAULT current_timestamp(),
  `id_prestamo` bigint(20) NOT NULL,
  `aprobacion_prestamo` enum('no','si') NOT NULL DEFAULT 'no',
  `observacion_prestamo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_aprobacion`),
  KEY `id_prestamo` (`id_prestamo`),
  CONSTRAINT `aprobacion_prestamos_bienes_itfip_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `registro_prestamos_bienes_itfip` (`id_prestamo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aprobacion_prestamos_bienes_itfip`
--

/*!40000 ALTER TABLE `aprobacion_prestamos_bienes_itfip` DISABLE KEYS */;
INSERT INTO `aprobacion_prestamos_bienes_itfip` VALUES (1,'2023-01-20 03:05:09',2,'si',''),(2,'2023-01-20 03:05:22',1,'no','...'),(3,'2023-01-20 03:06:58',3,'no','no cumple'),(4,'2023-01-20 03:33:29',5,'no','no'),(5,'2023-01-20 03:33:39',4,'si',''),(6,'2023-01-20 03:34:16',6,'si',''),(7,'2023-01-20 06:13:15',8,'si',''),(8,'2023-01-20 06:14:01',7,'no','no');
/*!40000 ALTER TABLE `aprobacion_prestamos_bienes_itfip` ENABLE KEYS */;

--
-- Table structure for table `bienes_itfip`
--

DROP TABLE IF EXISTS `bienes_itfip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bienes_itfip` (
  `id_bien` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_bien` text NOT NULL,
  PRIMARY KEY (`id_bien`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bienes_itfip`
--

/*!40000 ALTER TABLE `bienes_itfip` DISABLE KEYS */;
INSERT INTO `bienes_itfip` VALUES (1,'Auditorio ITFIP'),(2,'Estadio Deportivo Fútbol'),(3,'Canchas Baloncesto'),(4,'Piscina Semiolímpica');
/*!40000 ALTER TABLE `bienes_itfip` ENABLE KEYS */;

--
-- Table structure for table `registro_prestamos_bienes_itfip`
--

DROP TABLE IF EXISTS `registro_prestamos_bienes_itfip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro_prestamos_bienes_itfip` (
  `id_prestamo` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_solicitud_bien` datetime NOT NULL DEFAULT current_timestamp(),
  `id_bien` int(11) NOT NULL,
  `fecha_entrega_bien` datetime NOT NULL,
  `fecha_fin_bien` datetime NOT NULL,
  `nombre_del_solicitante` text NOT NULL,
  `numero_documento_del_solicitante` bigint(11) NOT NULL,
  `direccion_del_solicitante` text NOT NULL,
  `telefono_del_solicitante` bigint(11) NOT NULL,
  `descripcion_prestamo` text NOT NULL,
  `finalidad_prestamo` text NOT NULL,
  `aprobacion_pendiente` enum('si','no') NOT NULL DEFAULT 'si',
  PRIMARY KEY (`id_prestamo`),
  KEY `id_bien` (`id_bien`),
  CONSTRAINT `registro_prestamos_bienes_itfip_ibfk_1` FOREIGN KEY (`id_bien`) REFERENCES `bienes_itfip` (`id_bien`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_prestamos_bienes_itfip`
--

/*!40000 ALTER TABLE `registro_prestamos_bienes_itfip` DISABLE KEYS */;
INSERT INTO `registro_prestamos_bienes_itfip` VALUES (1,'2023-01-20 02:56:59',3,'2015-07-13 03:33:00','2015-07-13 16:16:00','Quia Quo Impedit La',5166666666,'Ab Cum Enim Quis Ver',4688888888,'Quidem mollit sit i','Neque eaque est volu','no'),(2,'2023-01-20 03:04:52',2,'2023-01-20 16:04:00','2023-01-20 17:04:00','Mauren Gomez',1234567890,'Vereda Dindalito ',3214567890,'Asdfgjhgf','Jhgfds','no'),(3,'2023-01-20 03:06:28',1,'2023-01-27 18:05:00','2023-01-27 20:05:00','Natalia Reina',987654321,'Espinal',3210987654,'Nbvc','Uytre','no'),(4,'2023-01-20 03:08:49',3,'2023-01-31 18:08:00','2023-01-31 19:08:00','Luis',987612345,'Colombia',2134509876,'Ertyuio','Erfghm','no'),(5,'2023-01-20 03:32:16',4,'2023-02-02 15:31:00','2023-02-02 17:31:00','Ricardo',1092837465,'Tolima',3210987465,'Jhgfds','Rfdx','no'),(6,'2023-01-20 03:33:07',4,'2023-01-28 16:32:00','2023-01-28 18:32:00','Ricardo',1203948576,'Tolima',3214059687,'Gfdsw','Brgfbv','no'),(7,'2023-01-20 04:16:13',2,'2023-01-21 16:14:00','2023-01-21 20:14:00','Ricardo Rojas Rico',1111122448,'Espinal',3173926578,'Sasasasassasa','Dadadadadas','no'),(8,'2023-01-20 06:11:38',1,'2023-01-19 08:09:00','2023-01-19 18:09:00','Luis Antonio Herran',1234567890,'La Casa ',3103254567,'Vsdwjj','Rydhh','no');
/*!40000 ALTER TABLE `registro_prestamos_bienes_itfip` ENABLE KEYS */;

--
-- Dumping routines for database 'u361342399_spaceitfip_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-16  2:22:44
