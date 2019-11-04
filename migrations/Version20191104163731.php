<?php

namespace Mf\Stream;

use Mf\Migrations\AbstractMigration;
use Mf\Migrations\MigrationInterface;

class Version20191104163731 extends AbstractMigration implements MigrationInterface
{
    public static $description = "Migration description";

    public function up($schema)
    {
        switch ($this->db_type){
            case "mysql":{
                $this->addSql("CREATE TABLE `stream` (
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
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='лента информации, новости, статьи'");
                break;
            }
            default:{
                throw new \Exception("the database {$this->db_type} is not supported !");
            }
        }
    }

    public function down($schema)
    {
        switch ($this->db_type){
            case "mysql":{
                $this->addSql("DROP TABLE `stream`");
                break;
            }
            default:{
                throw new \Exception("the database {$this->db_type} is not supported !");
            }
        }
    }
}
