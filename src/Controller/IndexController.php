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
      protected $stream_service;

public function __construct ($connection,$stream_service)
{
    $this->connection=$connection;
    $this->stream_service=$stream_service;
}

 /*
 *просмотр списка ленты с пагинацией
 */
 public function indexAction()
 {
    $page=(int)$this->params('page',0);
    $stream=$this->params('stream',NULL);
    $locale=$this->params('locale',$this->stream_service->getDefaultLocale());

    try {
        $this->stream_service->SetLocale($locale);         //новая локаль
        $this->stream_service->SetStreamName($stream);
        $paginator=$this->stream_service->LoadList();      //список элементов
        
        $config=$this->stream_service->getConfigStreamItem();
        $view= new ViewModel([
            "paginator"=>$paginator, /*собственно данные*/
            "locale"=>$locale,       /*имя локали*/
            'config'=>$config,       /*конфиг выбранной ленты*/
            "page"=>$page            /*номер страницы списка элементов*/
        ]);
        $view->setTemplate($config["tpl"]['index']);
        if ($config["layout"]){
            $this->layout($config["layout"]);
        }
        return $view;
    } catch (\Exception $e) {
        //любое исключение - 404
        $this->getResponse()->setStatusCode(404);
    }

}

 /*
 *просмотр подробности
 */
 public function detalAction()
{
    $stream=$this->params('stream',NULL);
    $locale=$this->params('locale',$this->stream_service->getDefaultLocale());
    $url=$this->params('url',NULL);
    
     try {
         $this->stream_service->SetLocale($locale);					//новая локаль
         $this->stream_service->SetStreamName($stream);
         $item=$this->stream_service->LoadDetal($url);				//список элементов
         $config=$this->stream_service->getConfigStreamItem();
         
         $view=new ViewModel([
             "item"=>$item,      /*данные страницы*/
             "locale"=>$locale,  /*имя локали*/
             'config'=>$config   /*конфиг выбранной ленты*/
         ]);
         $view->setTemplate($config["tpl"]['detal']);
         if ($config["layout"]){
             $this->layout($config["layout"]);
         }
         
         return $view;
     } catch (\Exception $e) {
         //любое исключение - 404
         $this->getResponse()->setStatusCode(404);
     }
}

}
