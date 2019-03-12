<?php
namespace Mf\Stream\Service\Admin\JqGrid\Plugin;

/*
*/
use Admin\Service\JqGrid\Plugin\Images as AImages;

class Images extends AImages
{
    
    protected $def_options =[
        "image_id"=>"id",                        //имя поля с ID
        "storage_item_name" => "",              //имя секции в хранилище
        "storage_item_rule_name"=>"admin_img",  //имя правила из хранилища
        "database_table_name" =>"stream",       //имя таблицы в которую добавляем записи, если напрямую в базу
    ];


/**
* операция чтения
* возвращает строку пути к файлу+файл пригодную для тега IMG
*/
public function read($value,$index,$row)
{
    return $this->ImagesLib->loadImage($row["category"],$row[$this->options["image_id"]],$this->options["storage_item_rule_name"]);
}

/**
* повторяет админский плагин, только подменивает имя хранилища
*/
public function write($value,$postParameters)
{
    $this->options["storage_item_name"]=$postParameters["category"];
    return parent::write($value,$postParameters);
}



}