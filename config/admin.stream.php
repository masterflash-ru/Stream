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
            "caption" => "",
            "podval" => "",
            
            
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
                "caption" => "Лента статей/новостей и аналогичной информации",
                "height" => "auto",
                //"width" => 1000,
                "rowNum" => 10,
                "rowList" => [10,20,50,100],
                "sortname" => "date_public",
                "sortorder" => "desc",
                "viewrecords" => true,
                "autoencode" => false,
                "hidegrid" => false,
                "toppager" => true,
                
                /*дает доп строку в конце сетки, из данных туда можно ставить итоги какие-либо*/
                //"footerrow"=> true, 
                //"userDataOnFooter"=> true,
               
                // "multiselect" => true,
                //"onSelectRow"=> new Expr("editRow"), //клик на строке вызов строчного редактора
        
                
                "rownumbers" => false,
                "navgrid" => [
                    "button" => NavGridHelper::Button(["search"=>false]),
                    "editOptions"=>NavGridHelper::editOptions(["closeAfterEdit"=>false]),
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
                    ColModelHelper::select("locale",
                                        ["label"=>"Язык",
                                         "editable"=>true,
                                         "width"=>40,
                                         "plugins"=>[
                                             "colModel"=>[//плагин срабатывает при генерации сетки, вызывается в помощнике сетки
                                                 "Locale"=>[]
                                             ]
                                         ]
                                        ]),

                    ColModelHelper::datetime("date_public",["label"=>"Дата публикации","editoptions" => ["size"=>60 ]]),
                    ColModelHelper::checkbox("public",["label"=>"Публ","width"=>30]),
                    
                    ColModelHelper::select("category",
                                        ["label"=>"Раздел",
                                         "width"=>75,
                                         "editable"=>true,
                                         "editoptions"=>[
                                         ],
                                         "plugins"=>[
                                             "colModel"=>[//плагин срабатывает при генерации сетки, вызывается в помощнике сетки
                                                 "GetCategory"=>[]
                                             ]
                                         ]
                                        ]),
                    ColModelHelper::textarea("anons",["label"=>"Анонс","hidden"=>true,"editrules"=>["edithidden"=>true]]),
                    ColModelHelper::ckeditor("full",[
                        "label"=>"Статья полностью",
                        "plugins"=>[
                            "edit"=>[
                                "ClearContent"=>[],
                            ],
                            "add"=>[
                                "ClearContent"=>[],
                            ],
                        ],
                    ]),
                    
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
                    ColModelHelper::text("alt",["label"=>"ALT подпись","hidden"=>true,"editoptions" => ["size"=>120 ],"editrules"=>["edithidden"=>true]]),
                    ColModelHelper::textarea("title",["label"=>"TITLE","hidden"=>true,"editrules"=>["edithidden"=>true]]),
                    ColModelHelper::textarea("keywords",["label"=>"KEYWORDS","hidden"=>true,"editrules"=>["edithidden"=>true]]),
                    ColModelHelper::textarea("description",["label"=>"DESCRIPTION","hidden"=>true,"editrules"=>["edithidden"=>true]]),
                    ColModelHelper::seo("seo_options",["label"=>"Опции SEO"]),
                    ColModelHelper::text("lastmod",[
                        "hidden"=>true,
                        "plugins"=>[
                            "edit"=>[
                                "LastMod"=>[],
                            ],
                            "add"=>[
                                "LastMod"=>[],
                            ],
                        ],
                        ]),

                ColModelHelper::cellActions(),
                    
                
                ],
            ],
        ],
];