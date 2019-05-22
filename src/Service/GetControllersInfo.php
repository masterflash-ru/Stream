<?php
namespace Mf\Stream\Service;

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
		
		$this->Router=$Router;
		$this->options=$options;
		$this->config=$config;
    }
    
	
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
