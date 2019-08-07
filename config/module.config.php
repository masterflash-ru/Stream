<?php
/**
работа с лентами новостей, статей.....
подробности настройки в документации
*/

namespace Mf\Stream;
use Zend\Cache\Storage\Plugin\Serializer;
use Zend\Cache\Storage\Adapter\Filesystem;
use Zend\ServiceManager\Factory\InvokableFactory;

return [

	//контроллеры
    'controllers' => [
        'factories' => [
			Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,	
        ],
	],

	 'service_manager' => [
			  'factories' => [//сервисы-фабрики
                  Service\GetControllersInfo::class => Service\Factory\GetControllersInfoFactory::class,
                  Service\GetMap::class => Service\Factory\GetMapFactory::class,
                  Service\Stream::class => Service\Factory\StreamFactory::class,
			  ],
	  ],

    'view_helpers' => [
        'factories' => [
            View\Helper\LastStream::class => View\Helper\Factory\LastStreamFactory::class,
        ],
        'aliases' => [
            'LastStream' => View\Helper\LastStream::class,
			'laststream' => View\Helper\LastStream::class,
        ], 
    ],


    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'streams'=>[
        "config"=>[
            'status'=>[
                0=>"Не опубликовано или на модерации",
                1=>"Опубликовано",
            ],
        ],
        /*конфиг элементов ленты
        "categories"=>[
            'default' =>[                                 //ключ - системное имя ленты
                  'description'=>'',                      //Имя ленты 
                  'pagination'=> [                        //параметры вывода страниц 
                      'paginationControl' => [
                          'tpl' => 'simba',               //шаблон вывода номеров страниц, по умолчанию внутренний  /
                          'ScrollingStyle' => 'Sliding',  //стиль прокрутки номеров, допускается All, Elastic, Jumping, Sliding - по умолчанию 
                      ],
                      'ItemCountPerPage' => 10,           //кол-во элементов при просмотре анонсов
                      'PageRange' =>   10                 //кол-во ссылок для перехода на другие страницы списка
                  ],
                  'tpl' => [
                      'index' => 'stream/index/index',    //шаблон вывода списка статей
                      'detal' => 'stream/index/detal',    //шаблон вывода подробностей статьи
                  ],
                  'layout' => null,                       //макет вывода, по умолчанию текущий
              ],
        ],*/

    ],
    /*доступ к панели управления*/
    "permission"=>[
        "objects" =>[
            "interface/stream" => [1,1,0760],
        ],
    ],

    /*сетка для админки*/
    "interface"=>[
        "stream"=>__DIR__."/admin.stream.php",
    ],
    /*плагины для сетки JqGrid*/
    "JqGridPlugin"=>[
        'factories' => [
            Service\Admin\JqGrid\Plugin\Images::class=>Service\Admin\JqGrid\Plugin\FactoryImages::class,
            Service\Admin\JqGrid\Plugin\GetCategory::class=>Service\Admin\JqGrid\Plugin\FactoryGetCategory::class,
        ],
        'aliases' =>[
            "streamimage"=>Service\Admin\JqGrid\Plugin\Images::class,
            "GetCategory" => Service\Admin\JqGrid\Plugin\GetCategory::class,
        ],
    ],

    /*Канонический адрес сайта*/
    "ServerDefaultUri"=>$_SERVER["REQUEST_SCHEME"]."://".trim($_SERVER["SERVER_NAME"],"w."),
];
