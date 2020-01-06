<?php
/*
помощник view для вывода последних статей/новостей из ленты

*/

namespace Mf\Stream\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Laminas\View\Model\ViewModel;
use Laminas\Stdlib\ArrayUtils;

/**
 * помощник - вывода последних новостей/статей
 */
class LastStream extends AbstractHelper 
{
	protected $StreamLib;
	protected $_default=[
		"locale"=>"ru_RU",			//имя локали
		"items"=>3,                 //кол-во элементов в выводе последних статей
		"tpl"=>"lastdefault",       //сценарий генерации HTML
	];


/*
* собственног помощник, вызывается в view:
* echo $this->laststream(...........);
* возвращается последние статьи в виде HTML 
*/
public function __invoke($stream_name,array $options=[])
{
	$options=ArrayUtils::merge($this->_default,$options);

    
    $this->StreamLib->setStreamName($stream_name);
	$this->StreamLib->setLocale($options["locale"]);
	$items=$this->StreamLib->loadLastList((int)$options["items"]);

	$view=$this->getView();
	$vm=new ViewModel(["items"=>$items,'options'=>$options]);
	$vm->setTemplate($options["tpl"]);
	
	return $view->render($vm);
}



public function __construct ($StreamLib)
	{
		$this->StreamLib=$StreamLib;
		
	}

}
