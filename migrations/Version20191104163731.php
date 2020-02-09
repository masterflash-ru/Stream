<?php

namespace Mf\Stream;

use Mf\Migrations\AbstractMigration;
use Mf\Migrations\MigrationInterface;
use Laminas\Db\Sql\Ddl;

class Version20191104163731 extends AbstractMigration implements MigrationInterface
{
    public static $description = "Migration for streams";
    public function up($schema,$adapter)
    {
        $this->mysql_add_create_table=" ENGINE=MyIsam DEFAULT CHARSET=utf8";
        $table = new Ddl\CreateTable("stream");
        $table->addColumn(new Ddl\Column\Integer('id',false,null,["AUTO_INCREMENT"=>true]));
        $table->addColumn(new Ddl\Column\Char('locale', 5,true,null,["COMMENT"=>"Локаль формата ru_RU","KEY"=>"locale"]));
        $table->addColumn(new Ddl\Column\Integer('owner',true,null,["COMMENT"=>"ID юзера-владельца"]));
        $table->addColumn(new Ddl\Column\Char('category', 50,true,null,["COMMENT"=>"Категория ленты"]));
        $table->addColumn(new Ddl\Column\Datetime('date_public', true,null,["COMMENT"=>"дата публикации"]));
        $table->addColumn(new Ddl\Column\Text('full', 0,true,null,["COMMENT"=>"контент страницы"]));
        $table->addColumn(new Ddl\Column\Char('caption', 255,true,null,["COMMENT"=>"заголовок"]));
        $table->addColumn(new Ddl\Column\Char('alt', 255,true,null,["COMMENT"=>"подпись фото"]));
        $table->addColumn(new Ddl\Column\Text('anons', 0,true,null,["COMMENT"=>"анонс"]));
        $table->addColumn(new Ddl\Column\Char('url', 255,true,null,["COMMENT"=>"URL"]));
        $table->addColumn(new Ddl\Column\Integer('public',false,null));
        $table->addColumn(new Ddl\Column\Integer('counter',true,null));
        $table->addColumn(new Ddl\Column\Char('title', 255,true,null));
        $table->addColumn(new Ddl\Column\Char('keywords', 255,true,null));
        $table->addColumn(new Ddl\Column\Varchar('description', 3000,true,null));
        $table->addColumn(new Ddl\Column\Datetime('lastmod', true,null,["COMMENT"=>"дата модификации"]));
        $table->addColumn(new Ddl\Column\Varchar('seo_options', 2000,true,null,["COMMENT"=>"SEO опции"]));
        
        $table->addConstraint(
            new Ddl\Constraint\PrimaryKey(['id'])
        );
        $table->addConstraint(
            new Ddl\Constraint\UniqueKey(['url'])
        );
        $table->addConstraint(
            new Ddl\Index\Index(['locale'],'locale')
        );
        $table->addConstraint(
            new Ddl\Index\Index(['public'],'public')
        );
        $table->addConstraint(
            new Ddl\Index\Index(['counter'],'counter')
        );
        $table->addConstraint(
            new Ddl\Index\Index(['owner'],'owner')
        );
        $this->addSql($table);
    }

    public function down($schema,$adapter)
    {
        $drop = new Ddl\DropTable('stream');
        $this->addSql($drop);
    }

}
