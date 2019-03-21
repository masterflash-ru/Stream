<?php
namespace Mf\Stream;

use Admin\Service\JqGrid\ColModelHelper;
use Admin\Service\JqGrid\NavGridHelper;
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
                "db"=>[//плагин выборки из базы
                    "sql"=>"select stream.*, id as img from stream",
                    "PrimaryKey"=>"id",
                ],
            ],
            /*редактирование*/
            "edit"=>[
                "cache" =>[
                    "tags"=>["stream","Stream"],
                    "keys"=>["stream","Stream"],
                ],
                "db"=>[ 
                    "sql"=>"select * from stream",
                    "PrimaryKey"=>"id",
                ],
            ],
            "add"=>[
                "db"=>[ 
                    "sql"=>"select * from stream",
                    "PrimaryKey"=>"id",
                ],
            ],
            //удаление записи
            "del"=>[
                "cache" =>[
                    "tags"=>["stream","Stream"],
                    "keys"=>["stream","Stream"],
                ],
                "db"=>[ 
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
                //"autowidth"=>true,
                "hidegrid" => false,
                "toppager" => true,
                
                /*дает доп строку в конце сетки, из данных туда можно ставить итоги какие-либо*/
                "footerrow"=> true, 
                "userDataOnFooter"=> true,
               
                // "multiselect" => true,
                //"onSelectRow"=> new Expr("editRow"), //клик на строке вызов строчного редактора
               // "serializeRowData"=>new Expr("function (Data){console.log(Data); return Data;}"),
                
                
                "rownumbers" => false,
                "navgrid" => [
                    "button" => NavGridHelper::Button(),
                    "editOptions"=>NavGridHelper::editOptions(),
                    "addOptions"=>NavGridHelper::addOptions(),
                    "delOptions"=>NavGridHelper::delOptions(),
                    "viewOptions"=>NavGridHelper::viewOptions(),
                    "searchOptions"=>NavGridHelper::searchOptions(),
                ],
                "colModel" => [

                    ColModelHelper::text("caption",["label"=>"Заголовок","width"=>400,"editoptions" => ["size"=>120 ]]),
                    ColModelHelper::text("url",[
                        "width"=>400,
                        "hidden"=>true,
                        "editrules"=>[
                            "edithidden"=>true,
                        ],
                        "plugins"=>[
                            "edit"=>[
                                "translit"=>[
                                    "source"=>"caption"
                                ],
                            ],
                            "edit"=>[
                                "translit"=>[
                                    "source"=>"caption"
                                ],
                            ],
                            "add"=>[
                                "translit"=>[
                                    "source"=>"caption"
                                ],
                            ],
                        ],
                       "editoptions" => ["size"=>120 ],
                    ]),
                    
                    ColModelHelper::datetime("date_public",["label"=>"Дата публикации","editoptions" => ["size"=>60 ]]),
                    ColModelHelper::checkbox("public",["label"=>"Публ","width"=>30]),
                    
                    

                    ColModelHelper::select("category",
                                        ["label"=>"Раздел",
                                         "editable"=>true,
                                         "editoptions"=>[
                                         ],
                                         "plugins"=>[
                                             "colModel"=>[//плагин срабатывает при генерации сетки, вызывается в помощнике сетки
                                                 "GetCategory"=>[]
                                             ]
                                         ]
                                        ]),
                    
                    ColModelHelper::ckeditor("full",["label"=>"Статья полностью"]),
                    
                    ColModelHelper::image("img",
                                          ["label"=>"Фото",
                                           "plugins"=>[
                                               "read"=>[
                                                   "streamimage" =>[
                                                       "image_id"=>"id",                        //имя поля с ID
                                                       "storage_item_rule_name"=>"admin_img"   //имя правила из хранилища
                                                   ],
                                               ],
                                               "edit"=>[
                                                   "streamimage" =>[
                                                       "image_id"=>"id",                        //имя поля с ID
                                                   ],
                                               ],
                                               "del"=>[
                                                   "streamimage" =>[
                                                       "image_id"=>"id",                        //имя поля с ID
                                                   ],
                                               ],
                                               "add"=>[
                                                   "streamimage" =>[
                                                       "image_id"=>"id",                        //имя поля с ID
                                                       "database_table_name"=>"stream"
                                                   ],
                                               ],
                                           ],
                                          ]),
                ColModelHelper::seo("seo_options",["label"=>"Опции SEO"]),
                ColModelHelper::cellActions(),
                    
                
                ],
            ],
        ],
];