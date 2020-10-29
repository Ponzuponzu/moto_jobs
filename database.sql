-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: moto_change
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `paint_job`
--

DROP TABLE IF EXISTS `paint_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paint_job` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plate_no` varchar(45) NOT NULL,
  `current_color` varchar(45) NOT NULL,
  `target_color` varchar(45) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plate_no_UNIQUE` (`plate_no`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paint_job`
--

LOCK TABLES `paint_job` WRITE;
/*!40000 ALTER TABLE `paint_job` DISABLE KEYS */;
INSERT INTO `paint_job` VALUES (1,'1','Red','Blue','Complete','2020-10-29 20:58:18','2020-10-29 20:59:00'),(2,'2','Red','Blue','Complete','2020-10-29 20:58:23','2020-10-29 21:07:57'),(3,'3','Red','Blue','Complete','2020-10-29 20:58:29','2020-10-29 21:01:29'),(4,'4','Green','Blue','Complete','2020-10-29 20:58:53','2020-10-29 21:01:31'),(5,'5','Red','Green','Complete','2020-10-29 21:02:00','2020-10-29 21:06:41'),(6,'6','Green','Green',NULL,'2020-10-29 21:02:09','2020-10-29 21:02:09'),(7,'7','Red','Blue','Complete','2020-10-29 21:02:27','2020-10-29 21:07:58'),(8,'8','Red','Red',NULL,'2020-10-29 21:02:31','2020-10-29 21:02:31'),(11,'9','Red','Red','Complete','2020-10-29 21:03:21','2020-10-29 21:08:02'),(12,'10','Red','Red','Complete','2020-10-29 21:03:27','2020-10-29 21:08:04'),(13,'123','Red','Red',NULL,'2020-10-29 21:08:16','2020-10-29 21:08:16');
/*!40000 ALTER TABLE `paint_job` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-29 21:10:28
