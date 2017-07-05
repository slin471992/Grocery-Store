-- MySQL dump 10.13  Distrib 5.6.28, for osx10.9 (x86_64)
--
-- Host: localhost    Database: FINAL
-- ------------------------------------------------------
-- Server version	5.6.28

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
-- Table structure for table `AdminUser`
--

DROP TABLE IF EXISTS `AdminUser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AdminUser` (
  `Ausername` varchar(50) NOT NULL DEFAULT '',
  `Apassword` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Ausername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AdminUser`
--

LOCK TABLES `AdminUser` WRITE;
/*!40000 ALTER TABLE `AdminUser` DISABLE KEYS */;
INSERT INTO `AdminUser` VALUES ('admin','Aa123456');
/*!40000 ALTER TABLE `AdminUser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Category` (
  `CatID` int(11) NOT NULL DEFAULT '0',
  `CatName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CatID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES (1,'Vegetable'),(2,'Fruit'),(3,'Diary'),(4,'Meats'),(5,'Snacks'),(6,'Beverage');
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Customer`
--

DROP TABLE IF EXISTS `Customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Customer` (
  `Cusername` varchar(50) NOT NULL DEFAULT '',
  `Cpassword` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Cusername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customer`
--

LOCK TABLES `Customer` WRITE;
/*!40000 ALTER TABLE `Customer` DISABLE KEYS */;
INSERT INTO `Customer` VALUES ('123','afdd0b4ad2ec172c586e2150770fbf9e'),('1234','994242de3894f53ac7bc9d6c56364b2a'),('12345','afdd0b4ad2ec172c586e2150770fbf9e'),('123456','afdd0b4ad2ec172c586e2150770fbf9e'),('1234567','afdd0b4ad2ec172c586e2150770fbf9e'),('555','afdd0b4ad2ec172c586e2150770fbf9e'),('aaa','b95495d2b655e0cd832244427261b76a'),('abc','afdd0b4ad2ec172c586e2150770fbf9e'),('bbb','afdd0b4ad2ec172c586e2150770fbf9e'),('ccc','afdd0b4ad2ec172c586e2150770fbf9e'),('Juni','f7bb3ad3971d33a4554d4ef3576d27c1');
/*!40000 ALTER TABLE `Customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Grocery`
--

DROP TABLE IF EXISTS `Grocery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Grocery` (
  `GID` int(11) NOT NULL DEFAULT '0',
  `GName` varchar(50) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`GID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Grocery`
--

LOCK TABLES `Grocery` WRITE;
/*!40000 ALTER TABLE `Grocery` DISABLE KEYS */;
INSERT INTO `Grocery` VALUES (1,'Tomato','A tomato',1,1000000),(2,'Cucumber','A cucumber.',1,999999),(3,'Potato','A potato.',1,1000000),(4,'Grape','A bag of grapes.',3,999984),(5,'Blueberry','A box of bluberries.',6,1000000),(6,'Beef','A piece of fresh beef.',16,1000000),(7,'Pork','A piece of fresh pork.',13,1000000),(9,'Coke','A pack of Coke.',3.99,1000000),(10,'Skim Milk','A large bottle of skim milk.',5,1000000),(11,'Low Fat Milk','A large bottle of low fat milk.',5,1000000),(13,'Whole Milk','A large bottle of whole milk.',3,1000000),(15,'Frozen Yogurt','A pack of frozen Yogurt.',2,999999),(16,'Pepsi','A pack of Pepsi.',4,999998),(17,'Ice Cream','A box of ice cream.',4,999994),(18,'Popcorn','A pack of popcorn.',5,999989);
/*!40000 ALTER TABLE `Grocery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GroceryCat`
--

DROP TABLE IF EXISTS `GroceryCat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GroceryCat` (
  `GID` int(11) NOT NULL DEFAULT '0',
  `CatID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`GID`,`CatID`),
  KEY `CatID` (`CatID`),
  CONSTRAINT `grocerycat_ibfk_1` FOREIGN KEY (`GID`) REFERENCES `Grocery` (`GID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `grocerycat_ibfk_2` FOREIGN KEY (`CatID`) REFERENCES `Category` (`CatID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GroceryCat`
--

LOCK TABLES `GroceryCat` WRITE;
/*!40000 ALTER TABLE `GroceryCat` DISABLE KEYS */;
INSERT INTO `GroceryCat` VALUES (1,1),(2,1),(3,1),(4,2),(5,2),(10,3),(11,3),(13,3),(15,3),(6,4),(7,4),(17,5),(18,5),(9,6),(16,6);
/*!40000 ALTER TABLE `GroceryCat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OrderItems`
--

DROP TABLE IF EXISTS `OrderItems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OrderItems` (
  `OrderID` int(11) NOT NULL DEFAULT '0',
  `ItemID` int(11) NOT NULL DEFAULT '0',
  `UnitPrice` double DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Total` double DEFAULT NULL,
  `ShipDate` datetime DEFAULT NULL,
  PRIMARY KEY (`OrderID`,`ItemID`),
  KEY `ItemID` (`ItemID`),
  CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `Orders` (`OrderID`),
  CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `Grocery` (`GID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OrderItems`
--

LOCK TABLES `OrderItems` WRITE;
/*!40000 ALTER TABLE `OrderItems` DISABLE KEYS */;
INSERT INTO `OrderItems` VALUES (1,17,4,1,4,NULL),(1,18,5,1,5,NULL),(2,16,4.09,1,4.09,NULL),(4,18,5,1,5,NULL),(5,18,5,1,5,NULL),(6,18,5,1,5,NULL),(7,17,4,3,12,NULL),(10,17,4,1,4,NULL),(13,18,5,1,5,NULL),(15,18,5,1,5,NULL),(16,18,5,1,5,NULL),(17,4,3,10,30,NULL),(17,16,4,1,4,NULL),(18,2,1,1,1,NULL);
/*!40000 ALTER TABLE `OrderItems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Orders` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `Date_Time` datetime DEFAULT NULL,
  `Cusername` varchar(50) DEFAULT NULL,
  `OrderTotal` double DEFAULT NULL,
  `OrderStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `Cusername` (`Cusername`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Cusername`) REFERENCES `Customer` (`Cusername`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (1,'2016-12-07 01:11:49','bbb',9,'Processing'),(2,'2016-12-07 01:13:04','abc',4.09,'Processing'),(3,'2016-12-07 01:27:58','bbb',25,'Processing'),(4,'2016-12-07 01:28:58','bbb',5,'Processing'),(5,'2016-12-07 01:29:46','bbb',5,'Processing'),(6,'2016-12-07 01:30:05','bbb',5,'Processing'),(7,'2016-12-07 01:31:00','bbb',12,'Processing'),(8,'2016-12-07 01:43:59','ccc',5,'Processing'),(9,'2016-12-07 01:45:39','ccc',10,'Processing'),(10,'2016-12-07 01:46:52','ccc',4,'Processing'),(11,'2016-12-07 09:22:25','Juni',5,'Processing'),(12,'2016-12-07 09:26:01','abc',1,'Processing'),(13,'2016-12-07 09:36:25','12345',10,'Processing'),(14,'2016-12-07 09:37:32','12345',55,'Processing'),(15,'2016-12-07 18:46:46','12345',5,'Processing'),(16,'2016-12-07 18:48:05','abc',5,'Processing'),(17,'2016-12-07 19:12:00','abc',34,'Processing'),(18,'2016-12-07 20:01:58','555',1,'Processing');
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-07 20:08:14
