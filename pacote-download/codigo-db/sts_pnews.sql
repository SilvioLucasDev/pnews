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
-- Table structure for table `sts_borracharia`
--

DROP TABLE IF EXISTS `sts_borracharia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sts_borracharia` (
  `id_borracharia` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_borracharia_status` int NOT NULL,
  `dt_created` datetime NOT NULL,
  `dt_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_borracharia`),
  KEY `fk_borracharia_status_idx` (`fk_borracharia_status`),
  CONSTRAINT `fk_borracharia_status` FOREIGN KEY (`fk_borracharia_status`) REFERENCES `sts_status` (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='FK_NomeDaTabela_NomeDaTabelaEstrangeira';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sts_borracharia`
--

LOCK TABLES `sts_borracharia` WRITE;
/*!40000 ALTER TABLE `sts_borracharia` DISABLE KEYS */;
/*!40000 ALTER TABLE `sts_borracharia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sts_endereco_borracharia`
--

DROP TABLE IF EXISTS `sts_endereco_borracharia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sts_endereco_borracharia` (
  `id_endereco_borracharia` int NOT NULL AUTO_INCREMENT,
  `fk_endereco_borracharia` int NOT NULL,
  `coords_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coords_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rua` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_endereco_status` int NOT NULL,
  `dt_created` datetime NOT NULL,
  `dt_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_endereco_borracharia`),
  KEY `fk_endereco_borracharia_idx` (`fk_endereco_borracharia`),
  KEY `fk_end_borracharia_status_idx` (`fk_endereco_status`),
  CONSTRAINT `fk_end_borracharia_status` FOREIGN KEY (`fk_endereco_status`) REFERENCES `sts_status` (`id_status`),
  CONSTRAINT `fk_endereco_borracharia` FOREIGN KEY (`fk_endereco_borracharia`) REFERENCES `sts_borracharia` (`id_borracharia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='FK_NomeDaTabela_NomeDaTabelaEstrangeira';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sts_endereco_borracharia`
--

LOCK TABLES `sts_endereco_borracharia` WRITE;
/*!40000 ALTER TABLE `sts_endereco_borracharia` DISABLE KEYS */;
/*!40000 ALTER TABLE `sts_endereco_borracharia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sts_endereco_usuario`
--

DROP TABLE IF EXISTS `sts_endereco_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sts_endereco_usuario` (
  `id_endereco_usuario` int NOT NULL AUTO_INCREMENT,
  `fk_endereco_usuario` int NOT NULL,
  `cep` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rua` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `complemento` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_endereco_status` int NOT NULL,
  `dt_created` datetime NOT NULL,
  `dt_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_endereco_usuario`),
  KEY `fk_usuario_id_idx` (`fk_endereco_usuario`),
  KEY `fk_endereco_status_idx` (`fk_endereco_status`),
  CONSTRAINT `fk_endereco_status` FOREIGN KEY (`fk_endereco_status`) REFERENCES `sts_status` (`id_status`),
  CONSTRAINT `fk_endereco_usuario` FOREIGN KEY (`fk_endereco_usuario`) REFERENCES `sts_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='FK_NomeDaTabela_NomeDaTabelaEstrangeira';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sts_endereco_usuario`
--

LOCK TABLES `sts_endereco_usuario` WRITE;
/*!40000 ALTER TABLE `sts_endereco_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `sts_endereco_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sts_status`
--

DROP TABLE IF EXISTS `sts_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sts_status` (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `abrev_status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_created` date NOT NULL,
  `dt_updated` date DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sts_status`
--

LOCK TABLES `sts_status` WRITE;
/*!40000 ALTER TABLE `sts_status` DISABLE KEYS */;
INSERT INTO `sts_status` VALUES (1,'P','PENDENTE','2022-10-24',NULL),(2,'A','ATIVO','2022-10-24',NULL),(3,'R','REPROVADO','2022-10-24',NULL),(4,'C','CANCELADO','2022-10-24',NULL);
/*!40000 ALTER TABLE `sts_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sts_telefone_borracharia`
--

DROP TABLE IF EXISTS `sts_telefone_borracharia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sts_telefone_borracharia` (
  `id_telefone_borracharia` int NOT NULL AUTO_INCREMENT,
  `fk_telefone_borracharia` int NOT NULL,
  `telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_telefone_status` int NOT NULL,
  `dt_created` datetime NOT NULL,
  `dt_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_telefone_borracharia`),
  KEY `fk_telefone_status_idx` (`fk_telefone_status`),
  KEY `fk_telefone_borracharia_idx` (`fk_telefone_borracharia`),
  CONSTRAINT `fk_tel_borracharia_status` FOREIGN KEY (`fk_telefone_status`) REFERENCES `sts_status` (`id_status`),
  CONSTRAINT `fk_telefone_borracharia` FOREIGN KEY (`fk_telefone_borracharia`) REFERENCES `sts_borracharia` (`id_borracharia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='FK_NomeDaTabela_NomeDaTabelaEstrangeira';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sts_telefone_borracharia`
--

LOCK TABLES `sts_telefone_borracharia` WRITE;
/*!40000 ALTER TABLE `sts_telefone_borracharia` DISABLE KEYS */;
/*!40000 ALTER TABLE `sts_telefone_borracharia` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `sts_usuario`
--

DROP TABLE IF EXISTS `sts_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sts_usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sobrenome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_nascimento` date NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_usuario_status` int NOT NULL,
  `dt_created` datetime NOT NULL,
  `dt_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuario_status_idx` (`fk_usuario_status`),
  CONSTRAINT `fk_usuario_status` FOREIGN KEY (`fk_usuario_status`) REFERENCES `sts_status` (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='FK_NomeDaTabela_NomeDaTabelaEstrangeira';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sts_usuario`
--

LOCK TABLES `sts_usuario` WRITE;
/*!40000 ALTER TABLE `sts_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `sts_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sts_veiculo_usuario`
--

DROP TABLE IF EXISTS `sts_veiculo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sts_veiculo_usuario` (
  `id_veiculo_usuario` int NOT NULL AUTO_INCREMENT,
  `fk_veiculo_usuario` int NOT NULL,
  `apelido_veiculo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabricante_veiculo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo_veiculo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano_veiculo` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo_pneu_dianteiro` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo_pneu_traseiro` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fabricante_pneu` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ultima_troca_pneu` date NOT NULL,
  `tempo_medio_troca_pneu` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_veiculo_status` int NOT NULL,
  `dt_created` datetime NOT NULL,
  `dt_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_veiculo_usuario`),
  KEY `fk_veiculo_status_idx` (`fk_veiculo_status`),
  KEY `fk_veiculo_usuario_idx` (`fk_veiculo_usuario`),
  CONSTRAINT `fk_veiculo_status` FOREIGN KEY (`fk_veiculo_status`) REFERENCES `sts_status` (`id_status`),
  CONSTRAINT `fk_veiculo_usuario` FOREIGN KEY (`fk_veiculo_usuario`) REFERENCES `sts_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='FK_NomeDaTabela_NomeDaTabelaEstrangeira';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sts_veiculo_usuario`
--

LOCK TABLES `sts_veiculo_usuario` WRITE;
/*!40000 ALTER TABLE `sts_veiculo_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `sts_veiculo_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-07  1:47:28
