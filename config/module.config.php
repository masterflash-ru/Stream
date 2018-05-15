<?php
/**
работа с лентами новостей, статей.....
подробности настройки в документации
*/

namespace Mf\Stream;

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
    /*конфиг элемента ленты по умолчанию*/
    'stream_config_item_default' =>[
          'description'=>'',                      /*Имя ленты*/
          'pagination'=> [                        /*параметры вывода страниц*/
              'paginationControl' => [
                  'tpl' => 'control_default',     /*шаблон вывода номеров страниц, по умолчанию внутренний*/
                  'ScrollingStyle' => 'Sliding',  /*стиль прокрутки номеров, допускается All, Elastic, Jumping, Sliding - по умолчанию*/
              ],
              'ItemCountPerPage' => 12,           /*кол-во элементов при просмотре анонсов*/
              'PageRange' =>   10                 /*кол-во ссылок для перехода на другие страницы списка*/
          ],
          'tpl' => [
              'index' => 'stream/index/index',    /*шаблон вывода списка статей*/
              'detal' => 'stream/index/detal',    /*шаблон вывода подробностей статьи*/
          ],
          'layout' => null,                       /*макет вывода, по умолчанию текущий*/
      ],
];
