модуль работы с лентами статей, новостей....
После установки следует загрузить в базу дамп из папки data


Установка
composer require masterflash-ru/stream

Добавьте в конфиг приложения:
```php
'streams'=>[
			'news'=>[                         /*раздел ленты*/
				'description'=>'Новости',        /*Имя ленты*/
				'items_page'=>12,               /*кол-во элементов при просмотре анонсов*/
			],

			'itogi'=>[
				'description'=>'Итоги',
				'items_page'=>10,
			], 

	],
```
Для хранения изображений используется masterflash-ru/storage, поэтому в конфиг приложения нужно добавить фрагмент, аналогичный данному:
```php
/*хранилище и обработка (ресайз) фото и других файлов*/
    "storage"=>[

        /*хранит загруженные файлы, готовые для обработки
        это промедуточное хранение
        */
        'data_folder'=>"data/datastorage",

        /*
        *Именованные хранилища фото в виде множества вложенных папок
        *по умолчанию имеется всегда default
        *уровень вложений и размеры имен каталогов определяются параметром в фильтр CopyToStorage
        */
        'file_storage'=>[
            'default'=>[
                'base_url'=>"media/pics/",
            ],
        ],

        'items'=>[
            /*хранилище для ленты новостей, ключ это имя секции, которая используется для работы
            он же является именем раздела, под которым записываются и считываются файлы*/
            "news"=>[
                "description"=>"Хранение фото новостей",
                'file_storage'=>'default',
                'file_rules'=>[
                            'admin_img'=>[
                                'filters'=>[
                                        CopyToStorage::class => [
                                                    'folder_level'=>0,
                                                    'folder_name_size'=>3,
                                                    'strategy_new_name'=>'md5'
                                        ],
                                        ImgResize::class=>[
                                                    "method"=>2,
                                                    "width"=>250,
                                                    "height"=>150,
                                                    'adapter'=>Gd::class,
                                        ],
    
                                ],
                                'validators' => [
                                        IsImage::class=>[],
                                        ImageSize::class => [
                                            'minWidth' => 222,
                                            'minHeight' => 166,
                                    ],
                                ],
                            ],
                            'anons'=>[
                                'filters'=>[
                                        CopyToStorage::class => [
                                                    'folder_level'=>0,
                                                    'folder_name_size'=>3,
                                                    'strategy_new_name'=>'md5'
                                        ],
                                        ImgResize::class=>[
                                                    "method"=>1,
                                                    "width"=>222,
                                                    "height"=>166,
                                                    'adapter'=>'gd',
                                        ],
                                ],
                            ],
                ],
            ],//news
        ],
    ],
```
