<?php
namespace Mf\Stream\Service;

/*
сервис обработки прерывания GetMap simba.sitemap

*/
use Exception;

class GetMap 
{
    protected $streamService;
	protected $Router;
	protected $type="sitemapindex";
    protected $locale="ru_RU";
    protected $name;

	
    public function __construct($Router, array $options,$streamService) 
    {
        $this->streamService=$streamService;
		$this->Router=$Router;
		if(isset($options["type"])){
            $this->type=$options["type"];
        }
		if(isset($options["locale"])){
            $this->locale=$options["locale"];
        }
		if(isset($options["name"])){
            $this->name=$options["name"];
        }
    }
    
	/**
    * сам обработчик
    */
	public function GetMap()
	{
        if ($this->type=="sitemapindex"){
            /*получить информацию для генерации sitemapindex*/
            $maxLastMod=$this->streamService->getMaxLastMod();
            return ["name"=>"stream","lastmod"=>$maxLastMod->getLastmod()];
        }
        /*получение списка всех страниц и генерация URL*/
        if ($this->type=="sitemap"){
            if ($this->name!="stream"){
                /*если запрос не принадлежит этому модулю то выход*/
                return [];
            }
            $rez=[];
            /*список категорий не пустых!*/
            $categories=$this->streamService->getCategories();
            foreach ($categories as $item){
                //["category"=>имя_категории,"items"=>всего_кол-во_записей_в_ленте,"itemsCountPerPage"=>элементов_на_странице]
                $rez[]=[
                    "uri"=>$this->Router->assemble(["stream"=>$item["category"]], ['name' => 'stream_ru_RU']),
                    "lastmod"=>$item["lastmod"],
                    "changefreq"=>"weekly"
                ];
                //разбиение на страницы
                /*for ($i=1; $i<=floor($item["items"]/$item["itemsCountPerPage"]) ; $i++){
                    $rez[]=[
                        "uri"=>$this->Router->assemble(["stream"=>$item["category"],"page"=>$i+1], ['name' => 'stream_ru_RU']),
                        "lastmod"=>$item["lastmod"],
                        "changefreq"=>"weekly"
                    ];
                }*/
            }

            /*список подробных статей*/
            $items=$this->streamService->getMap();
            foreach ($items as $item){
                $rez[]=[
                    "uri"=>$this->Router->assemble(["stream"=>$item->getCategory(),"url"=>$item->getUrl()], ['name' => 'stream_detal_ru_RU']),
                    "lastmod"=>$item->getLastmod(),
                    "changefreq"=>"weekly"
                ];
            }
            return $rez;
        }
        throw new  Exception("Недопустимый тип sitemap");
	}
	
}
