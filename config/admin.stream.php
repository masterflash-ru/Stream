<?php
namespace Mf\Stream;

use Admin\Service\GqGridColModelHelper;
use Zend\Json\Expr;

return [
        /*jqgrid - сетка*/
        "type" => "ijqgrid",
        "description"=>"Редактирование ленты статей/новостей",
        "options" => [
            "container" => "stream",
            "caption" => "<h1>Это заголовок перед всем111</h1>",
            "podval" => "Это информация в конце интерфейса111",
            
            
            /*все что касается чтения в таблицу*/
            "read"=>[
                "adapter"=>"db", /*SQL выборка*/
                "options"=>[ 
                    "sql"=>"select * from stream",
                    "PrimaryKey"=>"id",
                ],
            ],
            /*все что касается записи*/
            "write"=>[
                "adapter"=>"db", /*SQL выборка*/
                "options"=>[ 
                    "sql"=>"select * from stream",
                    "PrimaryKey"=>"id",
                ],
            ],
            /*внешний вид*/
            "layout"=>[
                
                "caption" => "Это заголовок грида",
                "height" => "auto",
                "width" => 1000,
                "rowNum" => 20,
                "rowList" => [20,50,100],
                "sortname" => "date_public",
                "sortorder" => "desc",
                "viewrecords" => true,
                "autoencode" => true,
                "hidegrid" => false,
                "toppager" => true,
               // "multiselect" => true,
                "rownumbers" => false,
                "navgrid" => [
                    "button" => [
                        "edit" => true,
                        "add" => true,
                        "del" => true, 
                        "view" => false,
                        "cloneToTop" => true,
                        "search" => true,
                        
                    ],
                ],
                "colModel" => [

                    GqGridColModelHelper::text("caption",["label"=>"Заголовок","width"=>400]),
                    GqGridColModelHelper::text("url",[
                        "width"=>400,
                        "hidden"=>true,
                        "editrules"=>[
                            "edithidden"=>true,
                        ]
                    ]),
                    GqGridColModelHelper::datetime("date_public",["label"=>"Дата публикации"]),
                    GqGridColModelHelper::checkbox("public",["label"=>"Публ","width"=>30]),
                    
                    
                    //GqGridColModelHelper::text("category",["label"=>"Раздел","width"=>100,"editable" => false]),
                    GqGridColModelHelper::select("category",
                                        ["label"=>"Раздел",
                                         "editoptions"=>[
                                             "load_value"=>"",
                                             "value"=>["news"=>"Новости","articles"=>"Статьи"],/*значение выпадающего списка Фиксировано*/
                                             //"dataUrl"=>"/adm/ddddd"
                                         ],
                                        ]),
                    
                    GqGridColModelHelper::ckeditor("full_news",["label"=>"Статья полностью"]),
                  
                    

                    GqGridColModelHelper::cellActions(),
                    
                
                ],
            ],
        ],
];