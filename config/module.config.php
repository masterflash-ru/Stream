<?php
/**
работа с лентами новостей, статей.....

настройки модуля по умолчанию, если требуется использовать другие потоки, работающие так же как и новости/статьи, тогда
следует разместить аналогичную конфигурацию в папке (от корня)
config/config.module.php - если этот файл имеется, тогда новая конфигурация сольется с дефолтной, поверх

 */

namespace Stream;

use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;


return [

	//маршруты
    'router' => [
        'routes' => [
		
            //список новостей
			'stream' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/:stream[/page/:page]',
					'constraints' => [
                               			 //'locale' => '[a-zA-Z0-9_\-]+',
										 'stream' => 'news|article',
										 'page' => '\d+',
                           			 ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
						'page'=>1
                    ],
                ],
			],
			
			//маршрут для подробности
			'stream_detal' => [
					'type' => Segment::class,
					'options' => [
						'route'    => '/:stream/:url',
						'constraints' => [
											 'url' => '[a-zA-Z0-9_\-]+',
											 'stream' => 'news|article',
										 ],
						'defaults' => [
							'controller' => Controller\IndexController::class,
							'action'     => 'detal',
						],
					],
			],				

	    ],
    ],
	
	//контроллеры
    'controllers' => [
        'factories' => [
			Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,	
        ],
	],

	 'service_manager' => [
			  'factories' => [//сервисы-фабрики
				   Service\GetControllersInfo::class => Service\Factory\GetControllersInfoFactory::class,
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


	/*настройки потоков
	*здесь пример - новости, по необходимости добавьте нужные параметры в такую же секцию в глобальном конфиге
	*приложения
	*/
	'streams'=>[
			'news'=>[
				'description'=>'Новости',
				'items_page'=>2,
				'images_array'=>[
						//подробности в пакете Images
							'admin_img'=>["method"=>1,"w"=>150,"h"=>150,"optimize"=>true],
							'anons'=>["method"=>1,"w"=>250,"h"=>167,"optimize"=>true],
				],
			],

			'article'=>[
				'description'=>'Статьи',
				'items_page'=>10,
				'images_array'=>[
						//подробности в пакете Images
							'admin_img'=>["method"=>1,"w"=>150,"h"=>150,"optimize"=>true],
							'anons'=>["method"=>1,"w"=>250,"h"=>167,"optimize"=>true],
				],
			],

	],
	'streams_media'=>[
			'media_folder'=>"media/pic",				//имя папки в public для размещения медиаматериала
	],
	
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
