<?php
namespace Mf\Stream\Service;

use Zend\Router\Exception\RuntimeException;
/*
сервис обработки прерывания GetControllersInfoAdmin simba.admin
нужен для генерации ссылок для подстановки в меню сайта или админки для визуализации выбора
ВНИМАНИЕ!
возвращаются и ссылки, и спец массив с данными MVC

*/
use Exception;

class GetControllersInfo 
{
	protected $Router;
	protected $options;
	protected $config;
	
    public function __construct($Router,$config,$options) 
    {
		if (empty($config["locale_enable_list"])){
            $config["locale_enable_list"]=[$config["locale_default"]];
        }

		$this->Router=$Router;
		$this->options=$options;
		$this->config=$config;
    }
    
    /**
    * получить все MVC адреса, разбитые по языкам
    */
    public function getMvc()
    {
        
		//данный модуль содержит только сайтовские описатели описатели
		if ($this->options["category"]!="frontend") {return [];}
		//для сайта
		if (!isset($this->config['streams']) || !is_array($this->config['streams'])){
            throw new Exception("Секция конфига 'streams' не найдена или она не верного формата");
        }
		$info["stream"]["description"]="Лента информации";
		$rez['name']=[];
		$rez['url']=[];
		$rez['mvc']=[];

        foreach ($this->config["locale_enable_list"] as $locale){
            foreach ($this->config['streams']["categories"] as $stream_name=>$stream_info) {
                try {
                    $url = $this->Router->assemble(["stream"=>$stream_name], ['name' => 'stream_'.$locale]);
                    $mvc=[
                        "route"=>"stream_".$locale,
                        'params'=>["stream"=>$stream_name]
                    ];
                    $rez["name"][$locale][]=$stream_info['description']." (".$locale.")";
                    $rez["mvc"][$locale][]= serialize($mvc);
                    $rez["url"][$locale][]=$url;
                } catch (RuntimeException $e){
                    //если нет маршрута, тогда будет ошибка, просто пропускаем добавление для это локали
                }
            }
            $info["stream"]["urls"]=$rez;
        }
		return $info;
    }
    
    
    /**
    * устаревший вызов, для получения списка MVC адресов, в админ панели
    */
	public function GetDescriptors()
	{
		//админка стандартная
		if ($this->options["name"]) {return [];}
		if (empty($this->options["locale"])) {$this->options["locale"]=$this->config["locale_default"];}
		//для сайта
		if (!isset($this->config['streams']) || !is_array($this->config['streams'])){
            throw new Exception("Секция конфига 'streams' не найдена или она не верного формата");
        }
		$info["stream"]["description"]="Лента информации";
		$rez['name']=[];
		$rez['url']=[];
		$rez['mvc']=[];

		foreach ($this->config['streams']["categories"] as $stream_name=>$stream_info) {
            $locale=$this->options["locale"];
            
            $url = $this->Router->assemble(["stream"=>$stream_name], ['name' => 'stream_'.$locale]);
            $mvc=[
                "route"=>"stream_".$locale,
                'params'=>["stream"=>$stream_name]
            ];
            $rez["name"][]=$stream_info['description']." (".$locale.")";
            $rez["mvc"][]= serialize($mvc);
            $rez["url"][]=$url;
        }
		$info["stream"]["urls"]=$rez;
		return $info;
	}
	
}
