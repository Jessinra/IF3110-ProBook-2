-- MySQL dump 10.16  Distrib 10.1.36-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: tayobook
-- ------------------------------------------------------
-- Server version	10.1.36-MariaDB

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
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth` (
  `username` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `expiredAt` datetime NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES ('aditbro','$2y$10$GwTDthjsTikIvHUyepb0HuQ9bzjZrPLqalCLdMXFoSwNkmjlDSB/S','','','2018-11-01 03:22:52'),('admin','$2y$10$qbB5JjN/k5AXja4YYSnNk.g4ksS7fRxfpLIsnhLDrzaA76ztFsXXa','Chrome','::1','2018-11-28 11:39:49'),('admins','$2y$10$fboUJum9xsMZ1GwRPpgVdOhiap64GH058vGNcUt.yIhsP48dZywdy','','','2018-10-25 21:35:21'),('HeiTuyul','$2y$10$4sJ.9iiS1dqyjn0VdfjuUOrl5cVPs4bwiLuOBNTH8jse3G35ZqGW.','','','2018-10-26 05:57:27');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `cover` varchar(400) DEFAULT NULL,
  `rating` float NOT NULL,
  `voters` int(11) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (1,'Sit veniam distinctio similique quisquam.','Kelley Treutel','England the nearer is to give the hedgehog had unrolled itself, and was in the distance, sitting sad and lonely on a summer day: The Knave shook his head mournfully. \'Not I!\' said the Cat remarked..','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0),(2,'Fugiat dolor repellat veniam dicta eos ea qui.','Emma Runte','Cheshire Cat sitting on the breeze that followed them, the melancholy words:-- \'Soo--oop of the bill, \"French, music, AND WASHING--extra.\"\' \'You couldn\'t have wanted it much,\' said Alice; \'I daresay.','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0),(3,'Ipsam impedit tempore eos qui autem minima.','Don Armstrong Sr.','YOUR table,\' said Alice; \'living at the Lizard as she went on, \'you throw the--\' \'The lobsters!\' shouted the Queen. \'Can you play croquet?\' The soldiers were always getting up and bawled out, \"He\'s.','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0),(4,'Quae aut omnis cum inventore quas impedit.','Prof. Travon Rodriguez IV','Alice, \'as all the arches are gone from this morning,\' said Alice thoughtfully: \'but then--I shouldn\'t be hungry for it, while the rest were quite dry again, the cook tulip-roots instead of onions.\'.','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0),(5,'Exercitationem ducimus ut aut.','Fabiola Corwin','Alice went on so long that they could not join the dance? Will you, won\'t you join the dance? Will you, won\'t you join the dance? Will you, won\'t you join the dance. Would not, could not help.','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0),(6,'Ut et ad quas et blanditiis qui.','Madisen Kutch','And it\'ll fetch things when you come and join the dance. Will you, won\'t you join the dance?\"\' \'Thank you, it\'s a French mouse, come over with diamonds, and walked two and two, as the March Hare.','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0),(7,'Aperiam modi rerum sed quae quia.','Danial Gleason V','Mock Turtle sighed deeply, and began, in a very respectful tone, but frowning and making quite a chorus of voices asked. \'Why, SHE, of course,\' he said in a voice outside, and stopped to listen..','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0),(8,'Ut repudiandae quibusdam aspernatur quia nostrum molestias.','Dr. Jena Runolfsson Sr.','As soon as look at me like that!\' He got behind Alice as she went on again:-- \'I didn\'t write it, and kept doubling itself up and walking away. \'You insult me by talking such nonsense!\' \'I didn\'t.','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0),(9,'Aut suscipit et ut et est nulla ad.','Mr. Preston Zulauf','They were indeed a queer-looking party that assembled on the floor, as it was perfectly round, she came upon a Gryphon, lying fast asleep in the sun. (IF you don\'t know of any that do,\' Alice said.','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0),(10,'Dolor neque optio officia facere consectetur totam.','Prof. Pietro Wilkinson III','I shall be late!\' (when she thought of herself, \'I don\'t like it, yer honour, at all, at all!\' \'Do as I tell you, you coward!\' and at once took up the fan and a piece of rudeness was more than Alice.','/tugasbesar1_2018/frontend/img_resource/silberchatz.jpg',0,0);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_order`
--

DROP TABLE IF EXISTS `book_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_commented` int(1) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_order`
--

LOCK TABLES `book_order` WRITE;
/*!40000 ALTER TABLE `book_order` DISABLE KEYS */;
INSERT INTO `book_order` VALUES (46,1,1,'2018-11-01 09:08:21',NULL,'aditbro'),(47,1,1,'2018-11-01 09:08:27',NULL,'aditbro'),(48,1,1,'2018-11-01 09:08:31',NULL,'aditbro'),(49,1,1,'2018-11-01 09:08:32',1,'aditbro'),(50,1,1,'2018-11-01 09:08:32',1,'aditbro'),(51,1,1,'2018-11-01 09:08:32',1,'aditbro'),(52,2,1,'2018-11-01 09:12:47',NULL,'aditbro'),(53,2,1,'2018-11-01 09:12:49',NULL,'aditbro'),(54,1,10,'2018-11-01 13:29:52',NULL,'kayu_balok'),(55,1,10,'2018-11-01 13:29:57',1,'kayu_balok'),(56,1,3,'2018-11-01 13:30:25',1,'kayu_balok'),(57,1,4,'2018-11-01 13:46:14',NULL,'kayu_balok'),(58,1,1,'2018-11-22 22:04:15',NULL,'admin'),(59,1,1,'2018-11-23 09:52:54',NULL,'admin'),(60,1,1,'2018-11-23 09:57:10',NULL,'admin'),(61,1,1,'2018-11-23 10:08:38',NULL,'admin'),(62,1,1,'2018-11-23 10:10:50',NULL,'admin'),(63,1,1,'2018-11-23 10:12:08',NULL,'admin'),(64,1,1,'2018-11-23 10:18:58',NULL,'admin'),(67,0,8,'2018-11-28 16:59:13',NULL,'admin'),(68,0,8,'2018-11-28 16:59:42',NULL,'admin'),(69,0,3,'2018-11-28 17:01:00',NULL,'admin'),(70,0,3,'2018-11-28 17:02:00',NULL,'admin'),(71,0,3,'2018-11-28 17:02:42',NULL,'admin'),(72,0,3,'2018-11-28 17:03:51',NULL,'admin'),(73,0,3,'2018-11-28 17:05:16',NULL,'admin'),(74,0,3,'2018-11-28 17:05:33',NULL,'admin'),(75,0,3,'2018-11-28 17:05:34',NULL,'admin');
/*!40000 ALTER TABLE `book_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_review`
--

DROP TABLE IF EXISTS `book_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_review`
--

LOCK TABLES `book_review` WRITE;
/*!40000 ALTER TABLE `book_review` DISABLE KEYS */;
INSERT INTO `book_review` VALUES (38,1,'aditbro',3,'alus',49),(39,1,'aditbro',5,'alus juga',50),(40,1,'aditbro',3,'maksa',51),(41,1,'kayu_balok',4,'asal',55),(42,1,'kayu_balok',2,'halo',56);
/*!40000 ALTER TABLE `book_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `hashedPassword` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `card` varchar(12) NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'Ayrton Cyril','admin','1@gmail.com','$2y$10$yCnPXbGvfk1GLHJo/3MG3uQnixyjG8m43XawuyN.iiB3v6aeGcOUe','asdaa','0987654567','/tugasbesar2_2018/Pro-Book/frontend/img_resource/admin1543227382c1 (1).jpg','123456789123'),(6,'Ayrton Cyril','arcturus','arcturus@gmail.com','$2y$10$a2vw5VdiYAuqBkIp3klgiOCzIx07OpfQbET8Lu8z9bS2woNnAGwIC','asda','123123123','/tugasbesar1_2018/frontend/img_resource/arcturus1541037936jamur.png',''),(7,'ellen','ellen','ellen@gmail.com','$2y$10$o8ekwTXV13DxKduKfXe/6u7fqYnJZ5qWR2BpbdhwRf90Qf.R1Dol2','rumah ellen bagus loh','0816529372','/tugasbesar1_2018/frontend/img_resource/default-profile.jpg',''),(11,'Adit BRO','aditbro','adit@bro.co','$2y$10$Mf1cBpFzhXR8UN3lcveShuNmo1LurwJTXwwWEi82TFoQXJIofC.Z2','sdbcjsdbclzdfhbudhjfzvfzbdvfdzbfxrdfrd','09877933812','/tugasbesar1_2018/frontend/img_resource/default-profile.jpg',''),(12,'Kayu kotak','kayu_balok','kayu_balok@sungai.com','$2y$10$s0FJ1ZdB/WGL9ci2whTneubxXWgr8mqjpAqy5Nmz0uZ4ovXD.9Go2','sungai hitam bandung','123456789','/tugasbesar1_2018/frontend/img_resource/kayu_balok1541053667jamur.png',''),(13,'Kayu Lontong','kayu_lontong','kayu_balok@gmail.com','$2y$10$Jk4EQebwCm7Z0FcsRce3G.sP0uEO6aL26zRw9qUxmt8VqoAqV962u','sungai pink pluto','123456789','/tugasbesar1_2018/frontend/img_resource/default-profile.jpg',''),(14,'Ayrton Cyril','asd','231@gmail.com','$2y$10$DnaKXwVwF.fUi4xM5N9DqezjDxXeqCne3BYBrsz74t9vXVFtGEw5S','asdad','123123123','/tugasbesar2_2018/Pro-Book/frontend/img_resource/default-profile.jpg',''),(15,'Kayu balok','123','123@f.com','$2y$10$SDq9R6GwASojjgyyWjFo/.XR89BkTXq2P2cu2pfifMOs4OqQPaueu','123','123123122','/tugasbesar2_2018/Pro-Book/frontend/img_resource/default-profile.jpg',''),(16,'Ayrton Cyril','adminasd','ayrton.cyril@gmail.com','$2y$10$VaDvPZumJNK3LeItIz45u.jm1369LyTuIXzEN5iepDS72...3e/Bq','adasd','082083012312','/tugasbesar2_2018/Pro-Book/frontend/img_resource/default-profile.jpg',''),(17,'asd','asdasdqw','asd@ffd.com','$2y$10$xOuPbCRiKx8QndYJ3phfcOgmJYzy6ii.fvOK3k.1Ed59vlHm2iSGS','dasdasd','2783172312','/tugasbesar2_2018/Pro-Book/frontend/img_resource/default-profile.jpg',''),(18,'123','12313','123@fsdf.com','$2y$10$OTLzFgS/Z9RhT.MV8WZE5.Y63OJySkE0xoU6C3nZSHtOfsJtHYPpa','asdad','9231233123','/tugasbesar2_2018/Pro-Book/frontend/img_resource/default-profile.jpg','');
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

-- Dump completed on 2018-11-28 17:08:41
