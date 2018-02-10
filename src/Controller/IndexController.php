<?php
/**
лента статей новостей
 */

namespace Mf\Stream\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Mf\Stream\Service\Stream;
use Exception;

class IndexController extends AbstractActionController
{
	protected $connection;
	protected $config;
	protected $stream_service;
	protected $config_default=[
              'description'=>'',                      /*Имя ленты*/
              'items_page'=>12,                       /*кол-во элементов при просмотре анонсов*/
              'pagination'=> [                        /*параметры вывода страниц*/
                   'paginationControl' => [
					   'tpl' => 'control_default.phtml', /*шаблон вывода номеров страниц, по умолчанию внутренний*/
                       'ScrollingStyle' => 'Sliding', /*стиль прокрутки номеров, допускается All, Elastic, Jumping, Sliding - по умолчанию*/
                    ],
              ],
             'tpl' => [
                 'index' => 'stream/index/index',     /*шаблон вывода списка статей*/
                 'detal' => 'stream/index/detal',     /*шаблон вывода подробностей статьи*/
             ],
	      ];
	
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
		
		$config=array_replace_recursive($this->config_default,$this->config['streams'][$stream]);
		
		$view= new ViewModel(["paginator"=>$paginator,"locale"=>$locale,'config'=>$config]);
		$view->setTemplate($config["tpl"]['index']);
		return $view;
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
		
		$config=array_replace_recursive($this->config_default,$this->config['streams'][$stream]);
		
		$view=new ViewModel(["item"=>$item,"locale"=>$locale,'config'=>$config]);
		$view->setTemplate($config["tpl"]['detal']);
		return $view;
	}
	catch (\Exception $e) 
		{
			//любое исключение - 404
			$this->getResponse()->setStatusCode(404);
		}

    }




}
