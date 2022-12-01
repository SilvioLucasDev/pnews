CREATE DATABASE  IF NOT EXISTS `sts_pnews` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sts_pnews`;
-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sts_pnews
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sts_telefone_usuario`
--

DROP TABLE IF EXISTS `sts_telefone_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sts_telefone_usuario` (
  `id_telefone_usuario` int NOT NULL AUTO_INCREMENT,
  `fk_telefone_usuario` int NOT NULL,
  `telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_telefone_status` int NOT NULL,
  `dt_created` datetime NOT NULL,
  `dt_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_telefone_usuario`),
  KEY `fk_telefone_usuario_idx` (`fk_telefone_usuario`),
  KEY `fk_telefone_status_idx` (`fk_telefone_status`),
  CONSTRAINT `fk_telefone_status` FOREIGN KEY (`fk_telefone_status`) REFERENCES `sts_status` (`id_status`),
  CONSTRAINT `fk_telefone_usuario` FOREIGN KEY (`fk_telefone_usuario`) REFERENCES `sts_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='FK_NomeDaTabela_NomeDaTabelaEstrangeira';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sts_telefone_usuario`
--

LOCK TABLES `sts_telefone_usuario` WRITE;
/*!40000 ALTER TABLE `sts_telefone_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `sts_telefone_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-07  1:49:28
