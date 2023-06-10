-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: localhost    Database: projectinfo
-- ------------------------------------------------------
-- Server version	8.0.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `address` (
  `AddressId` bigint NOT NULL,
  `ZipCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StreetName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General9` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General10` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`AddressId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author` (
  `authorid` int DEFAULT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book` (
  `BookId` bigint NOT NULL,
  `Title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CategoryId` int DEFAULT NULL,
  `PublishedYear` int DEFAULT NULL,
  `StatusId` int NOT NULL,
  `Barcode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UserId` int DEFAULT NULL,
  `Memo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Isbn` bigint DEFAULT NULL,
  `Secondowner` int DEFAULT NULL,
  `General1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General9` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General10` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`BookId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (1,'George\'s Secret Key to the UNIVERSE','Lucy and Stephen Hawking',2,2007,1,'9781416985846',0,'51299',9781416985846,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'George\'s Secret Key to the UNIVERSE','Lucy and Stephen Hawking',2,2007,1,'9781416985846',2021100055,'51299',9781416985846,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'fgh','f',0,2011,1,'ddd',2021100055,'d',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'fgh','f',0,2011,1,'ddd',2021100055,'d',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'ss','ss',0,2022,1,'aa',2021100055,'aa',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'ss','ss',0,2022,1,'aa',2021100055,'aa',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'ss','ss',0,2022,1,'aa',2021100055,'aa',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booktransaction`
--

DROP TABLE IF EXISTS `booktransaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booktransaction` (
  `BookId` bigint NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `LoanerId` bigint DEFAULT NULL,
  `StatusId` int NOT NULL,
  PRIMARY KEY (`BookId`,`StartDate`,`EndDate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booktransaction`
--

LOCK TABLES `booktransaction` WRITE;
/*!40000 ALTER TABLE `booktransaction` DISABLE KEYS */;
INSERT INTO `booktransaction` VALUES (1,'2022-09-24 11:58:50','2022-09-24 12:09:06',2021100055,2),(1,'2022-09-24 12:09:30','2022-09-24 12:45:25',2021100055,0),(1,'2022-09-24 12:45:57','2022-09-24 13:29:36',2021100055,2),(1,'2022-09-24 13:29:36','2022-09-24 13:29:41',NULL,1),(1,'2022-09-24 13:29:41','2022-09-24 13:33:33',NULL,1),(1,'2022-09-24 13:33:33','2022-09-24 13:33:40',NULL,1),(1,'2022-09-24 13:33:40','9999-09-09 00:00:00',NULL,1),(2,'2022-09-24 13:34:26','2022-09-24 13:34:53',NULL,1),(2,'2022-09-24 13:34:53','2022-09-24 13:35:09',2021100055,2),(2,'2022-09-24 13:35:09','2022-09-24 13:35:13',NULL,1),(2,'2022-09-24 13:35:13','9999-09-09 00:00:00',NULL,1),(3,'2022-10-15 12:26:12','9999-09-09 00:00:00',NULL,1),(4,'2022-10-15 12:31:02','9999-09-09 00:00:00',NULL,1),(5,'2022-10-15 12:31:20','9999-09-09 00:00:00',NULL,1),(6,'2022-10-15 12:31:21','9999-09-09 00:00:00',NULL,1),(7,'2022-10-15 12:32:34','9999-09-09 00:00:00',NULL,1);
/*!40000 ALTER TABLE `booktransaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borrow`
--

DROP TABLE IF EXISTS `borrow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `borrow` (
  `BarcodeOfBook` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DateOfRequest` date DEFAULT NULL,
  `LengthOfNumberOfDays` int DEFAULT NULL,
  `BorrowerId` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrow`
--

LOCK TABLES `borrow` WRITE;
/*!40000 ALTER TABLE `borrow` DISABLE KEYS */;
/*!40000 ALTER TABLE `borrow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `CategoryId` int NOT NULL,
  `CategoryName` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CategoryAbbreviation` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Math','MATH'),(2,'Science','SCI'),(3,'Horror','HORROR'),(4,'Action','ACT'),(5,'Fantasy','FAN'),(6,'Grammar','GRA');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `changepassword`
--

DROP TABLE IF EXISTS `changepassword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `changepassword` (
  `UserId` int NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Token` int DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `changepassword`
--

LOCK TABLES `changepassword` WRITE;
/*!40000 ALTER TABLE `changepassword` DISABLE KEYS */;
INSERT INTO `changepassword` VALUES (2021100055,'lanceatadhikari@gmail.com',NULL,'2021-10-31 00:00:00'),(2021100043,'lanceatadhi',212345,'2021-01-31 00:00:00'),(2021100055,'lanceatadhikari@gmail.com',461570,'2021-10-31 00:00:00'),(2021100055,'lanceatadhikari@gmail.com',634662,'2021-10-31 00:00:00'),(2021100055,'lanceatadhikari@gmail.com',846001,'2021-10-31 00:00:00'),(2021100055,'lanceatadhikari@gmail.com',599414,'2021-10-31 00:00:00'),(2021100055,'lanceatadhikari@gmail.com',983456,'2021-10-31 00:00:00'),(2021100055,'lanceatadhikari@gmail.com',161020,'2021-10-31 21:36:23'),(2021100055,'lanceatadhikari@gmail.com',597438,'2021-11-20 14:18:09'),(2021110056,'lanceatadhikari@gmail.com',411940,'2021-11-27 13:31:26'),(2021110056,'lanceatadhikari@gmail.com',712467,'2021-12-18 15:10:50'),(2021110056,'lanceatadhikari@gmail.com',433095,'2021-12-18 15:13:02'),(2022050093,'sudeep.manandhar@necase.ca',818628,'2022-05-29 22:46:35'),(2022050096,'sudeep.manandhar@necase.ca',552252,'2022-05-30 23:14:12'),(2022050096,'sudeep.manandhar@necase.ca',748803,'2022-05-30 23:17:54'),(2021100055,'lanceatadhikari@gmail.com',366352,'2022-08-06 13:21:20'),(2022060102,'liblancedeep@gmail.com',488441,'2022-09-16 17:51:17'),(2022090114,'lanceatadhikari@gmail.com',751838,'2022-10-15 12:45:24');
/*!40000 ALTER TABLE `changepassword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `StatusId` int NOT NULL,
  `StatusName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Available'),(2,'Reserved'),(3,'Borrowed'),(4,'Returned'),(5,'Lost');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `UserId` int NOT NULL,
  `CreateDate` date DEFAULT NULL,
  `FirstName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PhoneNumber` bigint DEFAULT NULL,
  `Email` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UserStatus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AddressId` bigint DEFAULT NULL,
  `General1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General9` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `General10` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2021090053,'2021-09-26','Lance','Adhikari',8254363234,'dshrestha@gmail.com','lance1234','1','$2y$04$2vxn4rMcUjw3fq0xhPKSA.h.u8MGCOxsV9L5rnr8h/pQWt8FvA9ua',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2021100054,'2021-10-02','Lance','Adhikari',8254363234,'lanceatadhikari@gmail.com','abc','1','$2y$04$hIMQfWX5Nqnou8iqc.hqXOE/5q0uzxI0x0LClmUf643ajXWuUttwO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2021100055,'2021-10-17','Lance','Adhikari',8254363234,'lanceatadhikari@gmail.com','bob987','1','$2y$04$Q/IPXc.jltwvj6JZYsF/JuCBCAvWS/iW.pqOlwgJKibdEgyLeAlGq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2021110056,'2021-11-27','lance','adhikari',5879373234,'lanceatadhikari@gmail.com','LanceAdhikari','1','$2y$04$l0frVM.3lzm02PWcGy.LYOHmy1PtY4cH.m6ZYD0/o0YXSIET3nGQG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022020058,'2022-02-26','Ram','Adhikari',5879372473,'dshrestha@gmail.com','RamA','1','$2y$04$aCMqKUJgDpE8sN2ywjg0luWxF1b/VQuLLPAj8hBXZzijH6Nk.5KNa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022020059,'2022-02-26','Deepesh','Shrestha',5873573042,'dshrestha@gmail.com','Deepesh','1','$2y$04$WprKZPdY7j5cReuo.zdjS.4g.EgVP75Wxv1b79Q5GaMItt93OwFEO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050079,'2022-05-10','Deepesh','Shrestha',5873573042,'dshrestha@gmail.com','dshrestha','1','$2y$04$N.Gx6UAQmJ2oa4pDrhC.b.Tnz9XagwQNSGNAANPvWlWk4yqx3EVqu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050080,'2022-05-15','Deepesh','Shrestha',5873573042,'dshrestha@gmail.com','dshrestha','1','$2y$04$bLoquSCiPrFUZ81cZ8eIc.SAdyBsG0s6qirH2tE8O0sXKSPux5hMq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050081,'2022-05-15','TestUserDeepesh','Yes',32343424341,'dshrestha@gmail.com','testuser','1','$2y$04$/Uk6MBClppHU9C5BpzYWN.Cjvu.w3xz6AcsKMJakijQMnxuLTyXjS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050082,'2022-05-25','Test','Test',5879373234,'liblancedeep@gmail.com','test1','1','$2y$04$/gia4B/2pMmugh2JJNlzsefBDO03yxOISxADQ8jT.yiyMxgFtNUSq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050083,'2022-05-25','test2','test2',5879825515,'liblancedeep@gmail.com','test2','1','$2y$04$CMqps83r3GK7AwbXBSLQdu9x/loj3AOWngx.CFT9b.Cli9zOlxVU2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050084,'2022-05-25','test3','test3',5879372473,'liblancedeep@gmail.com','test3','1','$2y$04$1jQgek9QEa10.Jo9oXQfMeI3lJSwWkR1m6bK/q9NwXMwXFQCpFtjq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050086,'2022-05-25','test5','test5',5879372473,'liblancedeep@gmail.com','test5','1','$2y$04$KC804dlcs2D/W1fmzNcosu/LtSdsUWWIeaBoMDdqZDz695lW4R0Ne',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050087,'2022-05-25','test6','test6',5879372473,'liblancedeep@gmail.com','test6','1','$2y$04$l2r1.yXGipx2a6xL3QuSveST/7plqkWgojHGkldsEdQWwQ3QzGZcy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050088,'2022-05-25','test7','test7',5879372473,'liblancedeep@gmail.com','test7','1','$2y$04$Z.dybvSujKDdaAHb/64zn.lGQ8MsFxmt1rG19KpptMZ2cvcuC54Uy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050089,'2022-05-25','test8','test8',5879372473,'liblancedeep@gmail.com','test8','1','$2y$04$SON0ExEf57jrf5F1IXstieEafDCVk8owf1wGjgaJ8Z7wKwNMF5xYK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050090,'2022-05-24','Ram','Adhikari',15879372473,'ramatadhikari@gmail.com','Ramu','1','$2y$04$uEIdesR2FIMGhthNcuJLRueBQbaICtgydaHOopPK9SEqtZQo1TalG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050091,'2022-05-29','Sudeep','Manandhar',5879825515,'sudeep.manandhar@necase.ca','sudeep','1','$2y$04$OdzPHAlxyvPWzCAfrHkHKeWm5QbdWV5nVuWPBK6kTSqDR19qcbC/q',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050095,'2022-05-30','John','Doe',0,'sudeep.manandhar@necase.ca','sudeep10','1','$2y$04$lE6AZRyo.pMFqLslm.4asupitwzEY9qtjXRGljCYTIkq30jgkUQW6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022050096,'2022-05-30','John','Doe',0,'sudeep.manandhar@necase.ca','sudeep11','1','$2y$04$QMlR0ibLhvMHcCap1IKj3.5F9buMHqX99FFVv1y.8QT4.4o3/2g8W',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022060098,'2022-06-05','Kusumakar','Sharma',7807107166,'kusumakar.sharma@gmail.com','kusumakar.sharma','1','$2y$04$.rbPvh808tM8DzFpbN1iB.0A107dZRKYmhntlwtEtzUyaWTxdZlYC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022060099,'2022-06-05','test9','test9',5879373234,'liblancedeep@gmail.com','test9','1','$2y$04$GnmljCLxB.luOG4k4boIgeA8fJaSnNaZIJsnk.Ye0Ru4pspXz2Bky',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022060100,'2022-06-06','Tej','Adhikari ',7806808762,'tej.adhikari@necase.ca','tadhikari4','1','$2y$04$fRXi5vPlLbeV.4kahshtpO3hfgtzlo5kQX9Yza/ti9Lhw7z.KNNGy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022080110,'2022-08-27','Deepesh','Shrestha',5873573042,'dshrestha@gmail.com','testd','1','$2y$04$kGHC3hSiqBO5oVtlqzCwpe8HED.KFqWz/6BwgtES9nqU3ofv4r8IS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022090111,'2022-09-08','Japan','Patel',0,'xinterate.mc@gmail.com','XYTRAH','1','$2y$04$fK6iati11ELqXSNj.cxeMuPmdrxIT3KKIiB4TQwV/HtsQy6O45QLG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022090112,'2022-09-16','Lance','Adhikari',8254363234,'liblancedeep@gmail.com','LanceTest','1','$2y$04$xGfHmnBumV5oR4.RAEbYoeCPVXBtbntjzAhQAeW2xnZkD42fgM9lu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022090113,'2022-09-24','Deepesh','Shrestha',5873573042,'dshrestha@gmail.com','dshrestha','1','$2y$04$k9cw.cVTJsQD7CMVAzgJaejhILm9svOr4nmWyaaLyPqSqgQcaJ8nq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2022090114,'2022-09-24','Lance','Adhikari',8254363234,'lanceatadhikari@gmail.com','LanceA','1','$2y$04$Xh6znIxavb.CM2sqe6Xw0u822SlElqkAJ1vsHZXuL3VqUdKtTzPv6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-20 12:58:25
