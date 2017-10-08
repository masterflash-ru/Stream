<?php
/**
лента статей новостей
 */

namespace Stream\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Stream\Service\Stream;
use Exception;

class IndexController extends AbstractActionController
{
	protected $connection;
	protected $config;
	protected $stream_service;
	
	public function __construct ($connection,$stream_service,$config)
	{
		$this->connection=$connection;
		$this->stream_service=$stream_service;
		$this->config=$config;
	}

   /*
   *просмотр списка ленты с пагинацией
   */
   public function indexAction()
    {
		$page=(int)$this->params('page',0);
		$stream=$this->params('stream',NULL);
		$locale=$this->params('locale',NULL);

	try
	{
		$this->checkLocale();		
		$this->stream_service->SetLocale($locale);					//новая локаль
		$this->stream_service->SetPage($page);					//номер страницы
		$this->stream_service->SetStreamName($stream);
		$paginator=$this->stream_service->LoadList();				//список элементов

		return new ViewModel(["paginator"=>$paginator]);
	}
	catch (\Exception $e) 
		{
			//любое исключение - 404
			$this->getResponse()->setStatusCode(404);
		}

    }

   /*
   *просмотр подробности
   */
   public function detalAction()
    {
		$page=(int)$this->params('page',0);
		$stream=$this->params('stream',NULL);
		$locale=$this->params('locale',NULL);
		$url=$this->params('url',NULL);
	//try
//	{
		$this->checkLocale();
		$this->stream_service->SetLocale($locale);					//новая локаль
		$this->stream_service->SetPage($page);					//номер страницы
		$this->stream_service->SetStreamName($stream);
		$item=$this->stream_service->LoadDetal($url);				//список элементов

		return new ViewModel(["item"=>$item]);
//	}
//	catch (\Exception $e) 
//		{
			//любое исключение - 404
			$this->getResponse()->setStatusCode(404);
	//	}

    }


/*
проверяет допустимость локали, что бы не было дубликатов страниц
если есть дуюликат, то исключение
*/
protected function checkLocale()
{
	$locale=$this->params('locale',NULL);
	//получим дефолтную локаль, что бы проверить передана ли она в URL
	//это нужно для исключения дубляжей URL
	$default_locale=$this->stream_service->GetDefaultLocale();	//разрешенные локали
		
	if ($locale && $this->stream_service->isMultiLocale() && $default_locale==$locale) {throw new Exception("Запрещено использовать в URL локаль, которая установлена по умолчанию, для исключения дубляжей URL");}
	if ($locale && !$this->stream_service->isMultiLocale()) {throw new Exception("Запрещено использовать в URL локаль для моноязычного сайта");}
}


}
