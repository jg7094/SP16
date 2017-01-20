CREATE DATABASE  IF NOT EXISTS `dbJAG` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci */;
USE `dbJAG`;
-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: dbJAG
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `priimek` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 NOT NULL,
  `geslo` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin','admin@admin.si','$2y$10$NoVeaIsKLCb7Y36Rb5Lj8ujor8L6SooIehxewzqkSqr827k5gRMj6');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `izdelek`
--

DROP TABLE IF EXISTS `izdelek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `izdelek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `opis` longtext CHARACTER SET utf8,
  `cena` int(11) NOT NULL,
  `model` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `barva` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `izdelek`
--

LOCK TABLES `izdelek` WRITE;
/*!40000 ALTER TABLE `izdelek` DISABLE KEYS */;
INSERT INTO `izdelek` VALUES (1,'Stol','najboljši stol',42,'Pisarniški','moder');
/*!40000 ALTER TABLE `izdelek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `narocilo`
--

DROP TABLE IF EXISTS `narocilo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `narocilo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT '0',
  `idstranka` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `narocilo`
--

LOCK TABLES `narocilo` WRITE;
/*!40000 ALTER TABLE `narocilo` DISABLE KEYS */;
INSERT INTO `narocilo` VALUES (1,1,1,420);
/*!40000 ALTER TABLE `narocilo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stranka`
--

DROP TABLE IF EXISTS `stranka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stranka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `priimek` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `naslov` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `geslo` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stranka`
--

LOCK TABLES `stranka` WRITE;
/*!40000 ALTER TABLE `stranka` DISABLE KEYS */;
INSERT INTO `stranka` VALUES (1,'Jaka','Govc','Doma 420','jg@jg.si','$2y$10$NoVeaIsKLCb7Y36Rb5Lj8ujor8L6SooIehxewzqkSqr827k5gRMj6');
/*!40000 ALTER TABLE `stranka` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vozicek`
--

DROP TABLE IF EXISTS `vozicek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vozicek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idnarocilo` int(11) NOT NULL,
  `idizdelek` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vozicek`
--

LOCK TABLES `vozicek` WRITE;
/*!40000 ALTER TABLE `vozicek` DISABLE KEYS */;
INSERT INTO `vozicek` VALUES (1,1,1,42);
/*!40000 ALTER TABLE `vozicek` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-16  1:57:59
