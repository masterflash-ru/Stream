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

delete from design_tables where table_name='stream';
delete from design_tables_text_interfase where interface_name='stream';

INSERT INTO `design_tables` (`interface_name`, `table_name`, `table_type`, `col_name`, `caption_style`, `row_type`, `col_por`, `pole_spisok_sql`, `pole_global_const`, `pole_prop`, `pole_type`, `pole_style`, `pole_name`, `default_sql`, `functions_befo`, `functions_after`, `functions_befo_out`, `functions_befo_del`, `properties`, `value`, `validator`, `sort_item_flag`, `col_function_array`) VALUES 
  ('stream_detal', 'stream', 0, 'description', '', 3, 0, '', '', 'cols=100 rows=5', '3', '', 'description', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'anons', '', 2, 5, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'anons', '', 3, 0, '', '', 'cols=100 rows=6', '3', '', 'anons', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'full', '', 2, 7, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'full', '', 3, 0, '', ' [\"statpage\"][''media_folder'']', ',', '39', '', 'full', '', '', '', '', '', 'a:4:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:7:\"default\";i:3;s:7:\"default\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'alt', '', 2, 9, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'alt', '', 3, 0, '', '', 'size=100', '2', '', 'alt', '', '', '', '', '', 'a:1:{i:0;s:4:\"Text\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'public', '', 2, 10, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'public', '', 3, 0, '', '', '', '20', '', 'public', '', '', '', '', '', 'a:4:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'counter', '', 2, 11, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'counter', '', 3, 0, '', '', '', '2', '', 'counter', '', '', '', '', '', 'a:1:{i:0;s:4:\"Text\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'title', '', 2, 15, '', '', '', '3', '', '', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'title', '', 3, 0, '', '', 'cols=100 rows=5', '3', '', 'title', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'keywords', '', 2, 16, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'keywords', '', 3, 0, '', '', 'cols=100 rows=5', '3', '', 'keywords', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'description', '', 2, 17, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'foto', '', 0, 0, 'select * from stream where locale=''$pole_dop0''  and category=''$pole_dop1''  and public=''$pole_dop2'' order by date_public desc', '', '1,1,0,0', 'foto', '0', 'id', 'delete from stream where id=$id', '', '', '', '', '', 0x613A323A7B733A32343A22666F726D5F656C656D656E74735F6E65775F7265636F7264223B733A313A2230223B733A32343A22666F726D5F656C656D656E74735F6A6D705F7265636F7264223B733A313A2230223B7D, 'stream,Stream', 1, ''),
  ('stream', 'stream', 0, '', '', 1, 0, '', '', 'onChange=this.form.submit()', '4', '', '', '', '', '', '\\Mf\\Stream\\Lib\\Func\\GetLocales', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', '', 0, ''),
  ('stream', 'stream', 0, '', '', 1, 0, '', '', 'onChange=this.form.submit()', '4', '', '', '', '', '', '\\Mf\\Stream\\Lib\\Func\\GetStreamList', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', '', 0, ''),
  ('stream', 'stream', 0, '', '', 1, 0, 'DROP TABLE IF EXISTS sp;create temporary table sp (id int(11), name char(50)) ENGINE=MEMORY DEFAULT CHARSET=utf8; insert into sp (id,name) values (1, \"Опубликованные\"),(0,\"Не опубликованные или на модерации\"),(-1,\"Черновики\"); select * from sp', '', 'onChange=this.form.submit()', '4', '', '', 'select * from sp', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', '', 0, ''),
  ('stream', 'stream', 0, 'id', '', 2, 2, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, '1', '', 2, 36, '', '', '', '19', '', 'save', '', '', '', '', '', 'a:2:{i:0;s:1:\"1\";i:1;s:16:\"Добавить\";}', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'id', '', 3, 0, '', '', '', '49', '', 'id', '', '', '', '', '', 'a:5:{i:0;s:1:\"0\";i:1;s:12:\"stream_detal\";i:2;s:0:\"\";i:3;s:1:\"0\";i:4;s:6:\"button\";}', 0xD09FD0BED0B4D180D0BED0B1D0BDD0BE, 'N;', 0, 'N;'),
  ('stream', 'stream', 0, '1', '', 3, 0, '', '', ',', '17', '', 'save,del', '', '', '', '', '', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"0\";i:2;s:33:\"Сохранить,Удалить\";i:3;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'date_public', '', 2, 4, '', '', ',', '27', '', 'date_public', '', '', '', '', '', 'a:4:{i:0;s:1:\"0\";i:1;s:1:\"0\";i:2;s:1:\"2\";i:3;s:1:\"2\";}', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'date_public', '', 3, 0, '', '', ',', '27', '', 'date_public', '', '', '', '', '', 'a:4:{i:0;s:1:\"0\";i:1;s:1:\"0\";i:2;s:1:\"2\";i:3;s:1:\"2\";}', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'caption', '', 2, 4, '', '', 'size=60', '2', '', 'caption', '', '', '', '', '', 'a:1:{i:0;s:4:\"Text\";}', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'caption', '', 3, 0, '', '', 'size=60', '2', '', 'caption', '', '', '', '', '', 'a:1:{i:0;s:4:\"Text\";}', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'locale', '', 2, 0, '', '', '', '0', '', 'pole_dop0', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'locale', '', 3, 0, '', '', '', '0', '', 'pole_dop0', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'category', '', 2, 0, '', '', '', '0', '', 'pole_dop1', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'category', '', 3, 0, '', '', '', '0', '', 'pole_dop1', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'public', '', 2, 9, '', '', '', '0', '', 'pole_dop2', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'public', '', 3, 0, '', '', '', '0', '', 'pole_dop2', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'foto', '', 2, 7, '', '', '', '1', '', 'foto', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"1\";}', '', 'N;', 0, 'N;'),
  ('stream', 'stream', 0, 'foto', '', 3, 0, '', '', '', '32', '', 'foto', '', '\\Mf\\Stream\\Lib\\Func\\InImgLib', '', '\\Mf\\Stream\\Lib\\Func\\OutImgLib', 'Mf\\Stream\\Lib\\Func\\InImgLib', 'a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, '', '', 0, 1, 'select * from stream where id=$get_interface_input', '', '0,0,0,0', '', '0', 'id', '', '', '', '', '', '', 0x613A323A7B733A32343A22666F726D5F656C656D656E74735F6E65775F7265636F7264223B733A313A2230223B733A32343A22666F726D5F656C656D656E74735F6A6D705F7265636F7264223B733A313A2230223B7D, 'stream,Stream', 1, ''),
  ('stream_detal', 'stream', 0, 'date_public', '', 2, 1, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'date_public', '', 3, 0, '', '', ',', '27', '', 'date_public', '', '', '', '', '', 'a:4:{i:0;s:1:\"0\";i:1;s:1:\"0\";i:2;s:1:\"2\";i:3;s:1:\"2\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'caption', '', 2, 3, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'caption', '', 3, 0, '', '', 'size=100', '2', '', 'caption', '', '', '', '', '', 'a:1:{i:0;s:4:\"Text\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'url', '', 2, 4, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, 'url', '', 3, 0, '', '', 'size=100', '2', '', 'url', '', '', '\\Mf\\Stream\\Lib\\Func\\CreateUrl', '', '', 'a:1:{i:0;s:4:\"Text\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, '1', '', 2, 36, '', '', '', '1', '', '', '', '', '', '', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('stream_detal', 'stream', 0, '1', '', 3, 0, '', '', '', '19', '', 'save', '', '', '', '', '', 'a:2:{i:0;s:1:\"1\";i:1;s:18:\"Сохранить\";}', '', 'N;', 0, 'N;');



INSERT INTO `design_tables_text_interfase` (`language`, `table_type`, `interface_name`, `item_name`, `text`) VALUES 
  ('ru_RU', 0, 'stream', 'values_message_id3', 'Подробно'),
  ('ru_RU', 0, 'stream', 'caption0', 'Лента информации'),
  ('ru_RU', 0, 'stream', 'caption_dop_0', 'Locale: '),
  ('ru_RU', 0, 'stream', 'caption_dop_1', 'Раздел:'),
  ('ru_RU', 0, 'stream', 'caption_dop_2', 'Статус:'),
  ('ru_RU', 0, 'stream', 'caption_col_id', 'Редактировать'),
  ('ru_RU', 0, 'stream', 'caption_col_1', 'Операция'),
  ('ru_RU', 0, 'stream', 'caption_col_date_public', 'Дата публикации'),
  ('ru_RU', 0, 'stream', 'caption_col_caption', 'Заголовок'),
  ('ru_RU', 0, 'stream', 'caption_col_foto', 'Фото'),
  ('ru_RU', 0, 'stream', 'caption_col_public', 'Статус');

INSERT INTO `design_tables_text_interfase` (`language`, `table_type`, `interface_name`, `item_name`, `text`) VALUES 
  ('ru_RU', 0, 'stream_detal', 'caption0', 'Подробности'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_date_public', 'дата публикации'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_full', 'Подробно'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_caption', 'Заголовок'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_alt', 'Подпись фото'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_anons', 'Анонс'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_url', 'URL - транслит заголовка - автомат'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_public', 'Публиковать'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_title', 'TITLE'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_keywords', 'KEYWORDS'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_description', 'DESCRIPTION'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_counter', 'просмотров'),
  ('ru_RU', 0, 'stream_detal', 'caption_col_1', 'Операция');

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
  `lastmod` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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

