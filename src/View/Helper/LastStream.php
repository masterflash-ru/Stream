<?php
/*
помощник view для вывода из хранилища фото имени файла фото, готового для вставки в HTML

*/

namespace Stream\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

/**
 * помощник - вывода последних новостей/статей
 */
class LastStream extends AbstractHelper 
{
	protected $StreamLib;


/*
* собственног помощник, вызывается в view:
* echo $this->laststream(...........);
* возвращается последние статьи в виде HTML 
* 
* $stream_name - строка имени потока, например, news
параметры-опции:
* items - кол-во элементов, по умолчанию 3
* locale - строка имени локали, по умолчанию ru_RU
*/
public function __invoke($stream_name,array $options=null)// $item_count=3,$locale="ru_RU")
{
    if (isset($options["locale"])) {
        $locale=$options["locale"];
    }else {
        $locale="ru_RU";
    }
   
    if (isset($options["items"])) {
        $items=(int)$options["items"];
    }else {
        $items=3;
    }

    
    $this->StreamLib->setStreamName($stream_name);
	$this->StreamLib->setLocale($locale);
	$items=$this->StreamLib->loadLastList($items);

	$view=$this->getView();
	$vm=new ViewModel(["items"=>$items,'locale'=>$locale]);
	$vm->setTemplate("laststream");
	
	return $view->render($vm);
}



public function __construct ($StreamLib)
	{
		$this->StreamLib=$StreamLib;
		
	}

}
