<?php
namespace Mf\Stream\Service;

use Locale;
use ADO\Service\RecordSet;
use ADO\Service\Command;
use Mf\Stream\Entity\Item;
use Mf\Stream\Entity\SeoOptions;
use Exception;
use Zend\Paginator\Adapter;
use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayUtils;


class Stream 
{
	
    protected $connection; 
    protected $cache;
    protected $locale;
	protected $config;
	protected $stream_name;
    protected $config_item_stream=[];
    protected $max_select_items=6000;
    protected $ServerDefaultUri;
	

    public function __construct($connection, $cache,$config) 
    {
        if (empty($config["locale_default"])){
            $config["locale_default"]="ru_RU";
        }
        $this->connection = $connection;
        $this->cache = $cache;
		$this->config=$config;
		$this->locale=$config["locale_default"];
        $this->ServerDefaultUri=$config["ServerDefaultUri"];
    }


/*
получить список последних элементов
*/
public function LoadList()
{
    //создаем ключ кеша
    $key="Stream_list_{$this->stream_name}_{$this->locale}";
    //пытаемся считать из кеша
    $result = false;
    $paginator= $this->cache->getItem($key, $result);
    if (!$result ){
        $rs=new RecordSet();
        $rs->CursorType =adOpenKeyset;
        $rs->Open("select * from stream 
            where 
                category='".$this->stream_name."' and 
                locale='".$this->locale."' and 
                url>'' and 
                public =1
                    order by date_public desc limit ".$this->max_select_items,$this->connection);

        $items=$rs->FetchEntityAll(Item::class);
        $paginator = new Paginator(new Adapter\ArrayAdapter($items));
        //сохраним в кеш
        $this->cache->setItem($key, $paginator);
        $this->cache->setTags($key,["Stream"]);
    }

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
        if (!$result ){
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
						public =1
							order by date_public";
			$rs=new RecordSet();
			$rs->CursorType =adOpenKeyset;
			$rs->Open($c);
            if ($rs->EOF) {throw new  \Exception("Запись в не найдена");}
			$page=$rs->FetchEntity(Item::class);
            
            //опции перезапишем в виде объекта
            $s=unserialize($page->getSeo_options());
            $seoOptions=new SeoOptions();
            $seoOptions->setRobots($s["robots"]);
            $seoOptions->setCanonical($s["canonical"]);
            $page->setSeo_options($seoOptions);

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
									public =1
										order by date_public  desc limit $limit",$this->connection);
				$items=$rs->FetchEntityAll(Item::class);
				//сохраним в кеш
				$this->cache->setItem($key, $items);
				$this->cache->setTags($key,["Stream"]);

			}
	return $items;
	}

    
/*
* получить список досуптных не пустых разделов лент
* возвращает массив элементов:
* ["category"=>имя_категории,
*    "items"=>всего_кол-во_записей_в_ленте,
*    "itemsCountPerPage"=>элементов_на_странице,
* .  "lastmod"=>дата_модификации]
* предназначен для генерации в карте sitemap списка ленты по страницам 
**/
public function getCategories()
{
    $rez=[];
    foreach (array_keys($this->config["streams"]["categories"]) as $category){
        $rs=$this->connection->Execute("select count(*) as c,max(lastmod) as lastmod from stream where category='$category'");
        $c=(int)$rs->Fields->Item["c"]->Value;
        if ($c>0){
        
            if (!isset($this->config["streams"]["categories"][$category]['pagination']['ItemCountPerPage'])){
                throw new  \Exception("Не указан параметр ['pagination']['ItemCountPerPage'] в конфиге ленты $category");
            }
            $items_in_page=$this->config["streams"]["categories"][$category]['pagination']['ItemCountPerPage'];
            $rez[]=[
                "category"=>$category,
                "items"=>$c,
                "itemsCountPerPage"=>$items_in_page,
                "lastmod"=>$rs->Fields->Item["lastmod"]->Value
            ];
        }
    }
    return $rez;
}
    
 /**
 * получить список всех URL, дату модификации, для создания карты сайта
 */
 public function getMap()
 {
		$key="Stream_all_{$this->locale}";
        //пытаемся считать из кеша
        $result = false;
        $items= $this->cache->getItem($key, $result);
        if (!$result){
            $rs=new RecordSet();
            $rs->CursorType = adOpenKeyset;
            $rs->open("select url,locale,category,lastmod from stream 
								where 
									locale='".$this->locale."' and 
									url>'' and 
									public =1
										order by date_public",$this->connection);
            $items=$rs->FetchEntityAll(Item::class);
			//сохраним в кеш
			$this->cache->setItem($key, $items);
			$this->cache->setTags($key,["Stream"]);
		}
	return $items;
 }

/*
* получить максимальную дату модификации
**/
public function getMaxLastMod()
{
    $rs=new RecordSet();
    $rs->open("select max(lastmod) as lastmod, count(*) as recordcount from stream 
								where 
									locale='".$this->locale."' and 
									url>'' and 
									public =1",$this->connection);
    $items=$rs->FetchEntity(Item::class);
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



/*устновить имя ленты
*сразу читается его конфигурация из секции и сливается с дефолтными настройками элемента, результат
* запоминается и возвращается по запросу
*/
public function setStreamName(string $name)
{
	if (!array_key_exists($name,$this->config['streams']["categories"] )) {
        throw new Exception("Попытка установить не допустимую  ленту");
    }
    $this->stream_name=$name;
    $this->config_item_stream=ArrayUtils::merge($this->config['streams']["default"],$this->config['streams']["categories"][$name]);
}

/*
*получить конфиг элемента выбранной ленты
возвращает массив
*/
public function getConfigStreamItem(string $name=null)
{
    if (empty($name)){
        return $this->config_item_stream;
    }
    if (isset($this->config['streams']["categories"][$name])){
        return $this->config['streams']["categories"][$name];
    }
    throw new Exception("Попытка считать не существующую конфигурацию ленты: {$name}");
}

/*прочитать имя ленты*/
public function getStreamName()
{
	return $this->stream_name;
}

 
//установка локали
public function setLocale($locale=NULL)
{
	if (!empty($locale)) {
        //проверим на допустимость имени локали
        if (!in_array($locale,$this->config["locale_enable_list"])) {
            throw new Exception("Попытка установить не допустимую локаль");
        }
        $this->locale=$locale;
    }
}

//получить локали
public function getLocale()
	{
		return $this->locale;
	}
//получить дефолтную локаль, которая указана в конфиге приложения
public function getDefaultLocale()
{
	return $this->config["locale_default"];
}

/*получить канонический адрес сайта*/
public function getServerDefaultUri()
{
    return $this->ServerDefaultUri;
}


}

