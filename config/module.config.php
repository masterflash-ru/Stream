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
];
