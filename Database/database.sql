-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: mydb
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `credentials`
--

DROP TABLE IF EXISTS `credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credentials` (
  `credId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`credId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credentials`
--

LOCK TABLES `credentials` WRITE;
/*!40000 ALTER TABLE `credentials` DISABLE KEYS */;
/*!40000 ALTER TABLE `credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `studentId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `university` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`studentId`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Kayson','Riggs','1995-02-12','De La Salle University'),(2,'Ezra','Mclean','1986-01-06','De La Salle University'),(3,'Whitney','Bryan','1988-02-05','De La Salle University'),(4,'Brycean','Ortega','2010-08-30','Ateneo De Manila University'),(5,'Adele','Alexander','1988-05-06','Ateneo De Manila University'),(6,'Sergio','Castro','1989-01-28','Ateneo De Manila University'),(7,'Celeste','Nash','2000-12-12','Lyceum of the Philippines University'),(8,'Audrey','Hoffman','1997-11-08','Mapua Institute of Technology'),(9,'Bailey','Pierce','2004-07-11','Mapua Institute of Technology'),(10,'Miles','Farmer','2010-04-08','Mapua Institute of Technology'),(11,'Messiah','Terry','2006-12-12','De La Salle University'),(12,'Arabella','Osborne','1993-09-27','De La Salle University'),(13,'Natalee','Navarro','2005-11-30','De La Salle University'),(14,'April','Sanchez','1999-02-15','De La Salle University'),(15,'Jose','Hodge','2004-11-17','Ateneo De Manila University'),(16,'Cannon','Marquez','2000-07-12','Ateneo De Manila University'),(17,'Gunner','Penningtor','1990-10-23','University of Santo Tomas'),(18,'Jordan','Wiley','2007-09-01','University of Santo Tomas'),(19,'Raven','Avila','2008-01-13','De La Salle University'),(20,'Ryan','Gentry','1993-05-04','Mapua Institute of Technology'),(21,'Alia','Callahan','1995-06-23','University of the Philippines'),(22,'Tiana','Patterson','2007-02-17','Lyceum of the Philippines University'),(23,'Aubri','Gutierrez','1989-02-19','University of Santo Tomas'),(24,'Valentina','Mack','1996-05-21','University of Santo Tomas'),(25,'Darwin','Winters','1988-01-14','De La Salle University'),(26,'Zain','Spencer','1986-08-25','De La Salle University'),(27,'Tatiana','Mcneil','1994-08-03','University of Santo Tomas'),(28,'Yehuda','Griffith','1999-08-14','University of the Philippines'),(29,'Cecelia','Rhodes','1992-03-25','Lyceum of the Philippines University'),(30,'Olivia','Hodge','1994-06-26','Lyceum of the Philippines University'),(31,'Leslie','Sparks','1998-09-06','University of the Philippines'),(32,'Hank','Lloyd','1988-06-02','Lyceum of the Philippines University'),(33,'Leighton','Daniel','1993-01-07','Lyceum of the Philippines University'),(34,'Madisyn','Barrera','1996-11-11','University of the Philippines'),(35,'Priscilla','Snow','1989-06-16','STI'),(36,'Kenzie','DeJesus','1985-07-09','STI'),(37,'Braylin','Reese','1985-05-10','University of Santo Tomas'),(38,'Major','Gilmore','1995-05-06','University of the Philippines'),(39,'Amiya','McCoy','1999-09-07','University of the Philippines'),(40,'Angel','Chan','2002-04-03','University of the Philippines'),(41,'Michael','Fuentes','2007-09-09','Lyceum of the Philippines University'),(42,'Lina','Carson','2009-11-12','STI'),(43,'Emilie','Joyce','1992-10-05','De La Salle University'),(44,'Ruben','Dennis','1998-04-12','Ateneo De Manila University'),(45,'Ryder','Leach','1992-02-25','Ateneo De Manila University'),(46,'Rihanna','Blair','2004-07-25','STI'),(47,'Jolene','Rice','1990-09-02','STI'),(48,'Shelby','Stein','1997-03-30','Mapua Institute of Technology'),(49,'Charlee','Nicholson','2004-11-11','Lyceum of the Philippines University'),(50,'Breanna','Hughes','2007-03-09','De La Salle University');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-10 14:05:05
