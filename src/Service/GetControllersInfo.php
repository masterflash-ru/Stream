<?php
namespace Stream\Service;

/*
сервис обработки прерывания GetControllersInfoAdmin simba.admin
нужен для генерации ссылок для подстановки в меню сайта или админки для визуализации выбора
ВНИМАНИЕ!
возвращаются и ссылки, и спец массив с данными MVC

*/


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
		
		//для сайта
		if (!isset($this->config['streams']) || !is_array($this->config['streams']))
			{
				throw new Exception("Секция конфига 'streams' не найдена или она не верного формата");
			}
		$info["stream"]["description"]="Лента информации";
		$rez['name']=[];
		$rez['url']=[];
		$rez['mvc']=[];

		foreach ($this->config['streams'] as $stream_name=>$stream_info)
			{
				foreach ($this->config["locale_enable_list"] as $locale)
					{//цикл по локалям
						if ($locale==$this->config["locale_default"]) {$locale=NULL;}
						$url = $this->Router->assemble(["stream"=>$stream_name,"locale"=>$locale], ['name' => 'stream']);
						$mvc=[
								"route"=>"stream",
								'params'=>["stream"=>$stream_name,"locale"=>$locale]
							];
						if(empty($locale)) {$locale=" локаль по умолчанию - ".$this->config["locale_default"];}
						$rez["name"][]=$stream_info['description']." - ".$locale;
						$rez["mvc"][]= serialize($mvc);
						$rez["url"][]=$url;
					}
				
			}
		$info["stream"]["urls"]=$rez;
		return $info;
	}
	
}



