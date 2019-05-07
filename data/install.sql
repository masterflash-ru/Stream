-- MySQL dump 10.13  Distrib 5.6.37, for FreeBSD11.0 (i386)
--
-- Host: localhost    Database: simba4
-- ------------------------------------------------------
-- Server version	5.6.37

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

DROP TABLE IF EXISTS `stream`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;

CREATE TABLE `stream` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` char(5) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL COMMENT 'ID юзера-владельца',
  `category` char(50) DEFAULT NULL,
  `date_public` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'дата публикации',
  `full` text COMMENT 'полностью новости',
  `caption` char(255) NOT NULL COMMENT 'заголовок',
  `alt` char(255) DEFAULT NULL COMMENT 'подпись на плашках, ALT',
  `anons` text COMMENT 'анонс новости',
  `url` char(255) DEFAULT NULL,
  `public` int(11) DEFAULT NULL COMMENT '1- публиковать',
  `title` char(254) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `description` text,
  `counter` int(11) DEFAULT '0' COMMENT 'счетчик просмотров',
  `lastmod` datetime DEFAULT NULL COMMENT 'дата в карту сайта',
  `seo_options` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_public` (`date_public`),
  KEY `url` (`url`),
  KEY `public` (`public`),
  KEY `category` (`category`),
  KEY `locale` (`locale`),
  KEY `owner` (`owner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='лента информации, новости, статьи';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'simba4'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

