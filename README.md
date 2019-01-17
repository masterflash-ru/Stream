модуль работы с лентами статей, новостей....
После установки следует загрузить в базу дамп из папки data, скопируйте стили css из папки public в файл стилей приложения
Если требуется удалить модуль, загрузите дамп deinstall.sql, он удаляет все из базы.

Установка
composer require masterflash-ru/stream

Добавьте в конфиг приложения:
```php
//определение вначале файла, для указания в маршруте
use Mf\Stream\Controller\IndexController as Stream;

....

'streams'=>[
        "categories"=>[
              'news'=>[                                   /*раздел ленты*/
                  'description'=>'Новости',               /*ОБЯЗАТЕЛЬНО Имя ленты*/
                  'pagination'=> [                        /*параметры вывода страниц, здесь указаны параметры по умолчанию*/
                       'paginationControl'=> [
                         'tpl'=>'simba',                  /*шаблон вывода номеров страниц, по умолчанию внутренний, можно bootstrap4, см. пакет masterflash-ru/navigation*/
                         'ScrollingStyle'=> 'Sliding',    /*стиль прокрутки номеров, допускается All, Elastic, Jumping, Sliding - по умолчанию*/
                        ],
                  'ItemCountPerPage' => 10,               /*кол-во элементов при просмотре анонсов*/
                  'PageRange' =>   10                     /*кол-во ссылок для перехода на другие страницы списка*/
                  ],
                 'tpl' => [                               /*НЕ обязательно, указаны параметры по умолчанию*/
                     'index' => 'stream/index/index',     /*шаблон вывода списка статей*/
                     'detal' => 'stream/index/detal',     /*шаблон вывода подробностей статьи*/
                 ],
                 'layout' => null,                        /*имя макета в котором выводится, по умолчанию текущий*/
              ],
        ],


],
```
Для хранения изображений используется masterflash-ru/storage, поэтому в конфиг приложения нужно добавить фрагмент, аналогичный данному:
```php
/*хранилище и обработка (ресайз) фото и других файлов*/
    "storage"=>[
        'data_folder'=>"data/datastorage",
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
Добавьте в конфиг приложения маршрут:
```php
        //маршрут для подробности
        'stream_detal_ru_RU' => [
             'type' => Segment::class,
             'options' => [
                  'route'    => '/:stream/:url',
                  'constraints' => [
                        'url' => '[a-zA-Z0-9_\-]+',
                         'stream' => 'news|articles',
                  ],
                 'defaults' => [
                     'controller' => Stream::class,
                     'action'     => 'detal',
                     'locale'=>'ru_RU'
                 ],
            ],
        ],

        //список новостей
        'stream_ru_RU' => [
            'type' => Segment::class,
                'options' => [
                    'route'    => '/:stream[/page/:page]',
                    'constraints' => [
                          'stream' => 'news|articles',
                          'page' => '\d+',
                    ],
                    'defaults' => [
                        'controller' => Stream::class,
                        'action'     => 'index',
                        'page'=>0,                /*<= обязательно 0 !!!!*/
                        'locale'=>'ru_RU'
                    ],
                ],
         ],

```
Модуль предоставляет помощник вывода последних статей, использование:
```php
/*сценарий view
Опции в помощник (массив):
[
     "locale"=>"ru_RU",          //имя локали
     "items"=>3,                 //кол-во элементов в выводе последних статей
     "tpl"=>"lastdefault",       //сценарий генерации HTML
]

*/

echo $this->laststream('имя_ленты',[опции]);

```
В конфиге приложения должны быть настройки кэша с именем 'DefaultSystemCache':
```php

    'caches' => [
        'DefaultSystemCache' => [
            'adapter' => [
                'name'    => Filesystem::class,
                'options' => [
                    'cache_dir' => './data/cache',
                    'ttl' => 60*60*2 
                ],
            ],
            'plugins' => [
                [
                    'name' => Serializer::class,
                    'options' => [
                    ],
                ],
            ],
        ],
    ],
```


