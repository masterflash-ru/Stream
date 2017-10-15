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
* параметры:
* $stream_name - строка имени потока, например, news
* $item_count - кол-во элементов, по умолчанию 3
* $locale - строка имени локали, по умолчанию ru_RU
*/
public function __invoke($stream_name,$item_count=3,$locale="ru_RU")
{
	$this->StreamLib->SetStreamName($stream_name);
	$this->StreamLib->SetLocale($locale);
	$items=$this->StreamLib->LoadLastList($item_count);
	
	$view=$this->getView();
	$vm=new ViewModel(["items"=>$items]);
	$vm->setTemplate("laststream");
	
	return $view->render($vm);
}



public function __construct ($StreamLib)
	{
		$this->StreamLib=$StreamLib;
		
	}

}
