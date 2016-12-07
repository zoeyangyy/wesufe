-- MySQL dump 10.13  Distrib 5.5.52, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: wesufe
-- ------------------------------------------------------
-- Server version	5.5.52-0ubuntu0.14.04.1

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
-- Table structure for table `think_comment`
--

DROP TABLE IF EXISTS `think_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_comment` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `text` varchar(45) DEFAULT NULL,
  `sendtime` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `think_lovewall`
--

DROP TABLE IF EXISTS `think_lovewall`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_lovewall` (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `like_number` int(11) DEFAULT '0',
  `comment_number` int(11) DEFAULT '0',
  `userid` varchar(45) DEFAULT NULL,
  `text` varchar(210) DEFAULT NULL,
  `sendtime` varchar(45) DEFAULT NULL,
  `sender` varchar(45) DEFAULT NULL,
  `receiver` varchar(45) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  PRIMARY KEY (`postid`)
) ENGINE=InnoDB AUTO_INCREMENT=392 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `think_user`
--

DROP TABLE IF EXISTS `think_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(45) NOT NULL,
  `subscribe` char(1) DEFAULT NULL,
  `subscribe_time` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `accessToken` varchar(45) DEFAULT NULL,
  `accessToken_time` varchar(45) DEFAULT NULL,
  `stuNo` varchar(20) DEFAULT NULL,
  `stuName` varchar(45) DEFAULT NULL,
  `stuClass` varchar(45) DEFAULT NULL,
  `stuMajor` varchar(45) DEFAULT NULL,
  `unsubscribe_time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid_UNIQUE` (`userid`),
  UNIQUE KEY `openid_UNIQUE` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-07 20:41:03
