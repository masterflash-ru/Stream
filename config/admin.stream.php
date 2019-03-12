<?php
namespace Mf\Stream;

use Admin\Service\JqGrid\ColModelHelper;
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
            /*все что касается записи*/
            "write"=>[
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

                    ColModelHelper::text("caption",["label"=>"Заголовок","width"=>400]),
                    ColModelHelper::text("url",[
                        "width"=>400,
                        "hidden"=>true,
                        "editrules"=>[
                            "edithidden"=>true,
                        ],
                        "plugins"=>[
                            "write"=>[
                                "translit"=>[
                                    "source"=>"caption"
                                ],
                            ],
                        ]

                    ]),
                    
                    ColModelHelper::datetime("date_public",["label"=>"Дата публикации"]),
                    ColModelHelper::checkbox("public",["label"=>"Публ","width"=>30]),
                    
                    

                    ColModelHelper::select("category",
                                        ["label"=>"Раздел",
                                         "editable"=>true,
                                         "editoptions"=>[
                                         ],
                                         "plugins"=>[
                                             "colModel"=>[
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
                                               "write"=>[
                                                   "streamimage" =>[
                                                       "image_id"=>"id",                        //имя поля с ID
                                                   ],

                                               ],
                                           ],
                                          ]),

                ColModelHelper::cellActions(),
                    
                
                ],
            ],
        ],
];