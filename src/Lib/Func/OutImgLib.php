<?php
namespace Mf\Stream\Lib\Func;


class OutImgLib
{


public function __invoke($obj,$infa,&$properties,$col_number,$pole_dop,$tab_name,$idname,$const,$id,$action)
{

	
	$stream_name=$pole_dop[1];
	if (!isset($obj->config['storage']['items'][$pole_dop[1]]))
	{
		throw new \Exception("Нет настроек конфигурации в секции 'storage' для: ".$pole_dop[1]);
	}
	///заменим в 0-м параметре имя секции для поля F32
	$pr=unserialize($properties["properties"]);
	$pr[0]=$stream_name;
	
	
$properties["properties"]=serialize($pr);


}
}