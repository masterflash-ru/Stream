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
		$locale=$this->params('locale',$this->config["locale_default"]);

	try
	{
		$this->stream_service->SetLocale($locale);					//новая локаль
		$this->stream_service->SetPage($page);					//номер страницы
		$this->stream_service->SetStreamName($stream);
		$paginator=$this->stream_service->LoadList();				//список элементов

		
		return new ViewModel(["paginator"=>$paginator,"locale"=>$locale]);
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
	try
	{

		$this->stream_service->SetLocale($locale);					//новая локаль
		$this->stream_service->SetPage($page);					//номер страницы
		$this->stream_service->SetStreamName($stream);
		$item=$this->stream_service->LoadDetal($url);				//список элементов

		return new ViewModel(["item"=>$item,"locale"=>$locale]);
	}
	catch (\Exception $e) 
		{
			//любое исключение - 404
			$this->getResponse()->setStatusCode(404);
		}

    }




}
