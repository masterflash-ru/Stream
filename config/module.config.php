<?php
/**
работа с лентами новостей, статей.....
помимо всего создается помощник види для показа последних статей/новостей, по умолчанию ичпользуется встроеный шаблон вывода
если нужен другой, создайте аналогичный с именем laststream.phtml и запишите в папку data/stream  
*/

namespace Stream;

use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;
/*
для других языков создайте новые маршруты по аналогии с ru_RU 
в имени маршрута обязательно должна стоять локаль
*/
return [

	//маршруты
    'router' => [
        'routes' => [
		
            //список новостей
			'stream_ru_RU' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/:stream[/page/:page]',
					'constraints' => [
										 'stream' => 'news|article',
										 'page' => '\d+',
                           			 ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
						'page'=>1,
						'locale'=>'ru_RU'
                    ],
                ],
			],
			
			//маршрут для подробности
			'stream_detal_ru_RU' => [
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
							'locale'=>'ru_RU'
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
			],

			'article'=>[
				'description'=>'Статьи',
				'items_page'=>10,
			],

	],
	
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
			getcwd() . '/data/stream'
        ],
    ],
];
