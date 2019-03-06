<?php
namespace Mf\Stream\Service\Admin\JqGrid\Plugin;

/*
*/
/*это обработчик в админ пакете*/
use Admin\Service\JqGrid\Plugin\Images as AImages;


class Images extends AImages
{
/**
*/
public function read($value,$index,$row)
{
    $value=$this->ImagesLib->loadImage($row["category"],$row[$this->options["image_id"]],$this->options["storage_item_rule_name"]);
    return $value;    
}

/**
*/
public function write($value)
{
    

}



}