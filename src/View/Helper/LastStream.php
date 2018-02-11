<?php
/*
помощник view для вывода из хранилища фото имени файла фото, готового для вставки в HTML

*/

namespace Mf\Stream\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

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
	$options=array_replace_recursive($this->_default,$options);

    
    $this->StreamLib->setStreamName($stream_name);
	$this->StreamLib->setLocale($options["locale"]);
	$items=$this->StreamLib->loadLastList((int)$options["items"]);

	$view=$this->getView();
	$vm=new ViewModel(["items"=>$items,'locale'=>$options["locale"]]);
	$vm->setTemplate($options["tpl"]);
	
	return $view->render($vm);
}



public function __construct ($StreamLib)
	{
		$this->StreamLib=$StreamLib;
		
	}

}
