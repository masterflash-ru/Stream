<?php
namespace Mf\Stream\Service;

use Locale;
use ADO\Service\RecordSet;
use ADO\Service\Command;
use Mf\Stream\Entity\Item;
use Exception;


use Zend\Paginator\Adapter;
use Zend\Paginator\Paginator;


class Stream 
{
	const PUBLIC=1;
	const SPECIAL=-1;
	const NONPUBLIC=0;
	
    protected $connection; 
    protected $cache;
	protected $page=0;
	protected $locale;
	protected $config;
	protected $stream_name;
	
	protected $items_page=10;		//элементов на странице
    
    public function __construct($connection, $cache,$config) 
    {
        $this->connection = $connection;
        $this->cache = $cache;
		$this->config=$config;
		$this->page_type=self::PUBLIC;
		$this->locale=$config["locale_default"];

		//\Zend\Debug\Debug::dump($config['streams']);
    }


/*
получить список последних элементов
*/
public function LoadList()
{
	$rs=new RecordSet();
	$rs->CursorType =adOpenKeyset;
	$rs->Open("select * from stream 
		where 
			category='".$this->stream_name."' and 
			locale='".$this->locale."' and 
			url>'' and 
			public =".self::PUBLIC."
				order by date_public desc",$this->connection);
	
	$items=$rs->FetchEntityAll(Item::class);
	$paginator = new Paginator(new Adapter\ArrayAdapter($items));
	$paginator->setItemCountPerPage($this->items_page); //кол-во новостей на странице
	$paginator->setCurrentPageNumber($this->page);
	return $paginator;
}



/**
собственно чтение по url 
*/
public function LoadDetal($url)
    {
		//создаем ключ кеша
		$key="Stream_{$this->stream_name}_{$this->locale}_".preg_replace('/[^0-9a-zA-Z_\-]/iu', '',$url);
        //пытаемся считать из кеша
        $result = false;
        $page= $this->cache->getItem($key, $result);
        if (!$result)
        {
            //промах кеша, создаем
			$c=new Command();
			$c->NamedParameters=true;
			$c->ActiveConnection=$this->connection;
			$p=$c->CreateParameter('url', adChar, adParamInput, 50, $url);//генерируем объек параметров
			$c->Parameters->Append($p);//добавим в коллекцию
			$c->CommandText="select * from stream 
					where 
						category='".$this->stream_name."' and 
						locale='".$this->locale."' and 
						url=:url and
						public =".self::PUBLIC."
							order by date_public";
			$rs=new RecordSet();
			$rs->CursorType =adOpenKeyset;
			$rs->Open($c);
			$page=$rs->FetchEntity(Item::class);

            //сохраним в кеш
            $this->cache->setItem($key, $page);
			$this->cache->setTags($key,["Stream"]);
        }
    return $page;
	}
 
 
/*
получить список для главной в плитки
*/
public function LoadLastList($limit=3)
	{
		$limit=(int)$limit;
		//создаем ключ кеша
		$key="Stream_last_{$limit}_{$this->stream_name}_{$this->locale}";
        //пытаемся считать из кеша
        $result = false;
        $items= $this->cache->getItem($key, $result);
        if (!$result)
        	{
				$rs=new RecordSet();
				$rs->CursorType = adOpenKeyset;
				$rs->open("select * from stream 
								where 
									category='".$this->stream_name."' and 
									locale='".$this->locale."' and 
									url>'' and 
									public =".self::PUBLIC."
										order by date_public  desc limit $limit",$this->connection);
				$items=$rs->FetchEntityAll(Item::class);
				//сохраним в кеш
				$this->cache->setItem($key, $items);
				$this->cache->setTags($key,["Stream"]);

			}
	return $items;
	}

 
 
 
 
/*мультиязычность разрешена?
возвращает true|false
если опция "locale_enable_list" массив больше 1 элемента, то мультиязычность ДА
*/  
public function isMultiLocale()
{
	if (!isset($this->config["locale_enable_list"])) {return false;}
	if (isset($this->config["locale_enable_list"]) && is_array($this->config["locale_enable_list"]) 
		&& count($this->config["locale_enable_list"])>1) {return true;}
	return false;
}



  
 /*устновить номер страницы списка*/
public function SetPage($page)
{
	$this->page=(int)$page;
}

/*прочитать тип страниц для считывания*/
public function GetPage()
{
	return $this->page;
}

/*устновить имя ленты
сразу читается его конфигурация из секции
*/
public function SetStreamName($name)
{
	$this->stream_name=$name;
	if (!array_key_exists($name,$this->config['streams'] )) {throw new Exception("Попытка установить не допустимую  ленту");}
	if (isset($this->config['streams'][$name]['items_page'])) {$this->items_page=(int)$this->config['streams'][$name]['items_page'];}
}

/*прочитать имя ленты*/
public function GetStreamName()
{
	return $this->stream_name;
}

 
//установка локали
public function SetLocale($locale=NULL)
{
	if (!empty($locale)) 
		{
			//проверим на допустимость имени локали
			if (!in_array($locale,$this->config["locale_enable_list"])) 
				{
					throw new Exception("Попытка установить не допустимую локаль");
				}
			$this->locale=$locale;
		}
}

//получить локали
public function GetLocale()
	{
		return $this->locale;
	}
//получить дефолтную локаль, которая указана в конфиге приложения
public function GetDefaultLocale()
{
	return $this->config["locale_default"];
}



}

