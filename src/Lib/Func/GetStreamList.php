<?php
namespace Mf\Stream\Lib\Func;
use Exception;

class GetStreamList
{


public function __invoke($obj,$infa,$struct_arr,$pole_type,$pole_dop,$tab_name,$idname,$const,$id,$action)
{
	//выводит список разделов ленты из константы конфигурации
	
	if (!isset($obj->config['streams']["categories"]) || !is_array($obj->config['streams']["categories"]))
		{
			throw new Exception("Секция конфига 'streams' не найдена или она не верного формата");
		}
	
	$l=$obj->config['streams']["categories"];// секция конфига                
	
	$obj->dop_sql['name']=[];
	$obj->dop_sql['id']=[];
	foreach ($l as $id=>$item)
		{
			$obj->dop_sql['name'][]=$item['description'];
			$obj->dop_sql['id'][]=$id;
		}
	//это значение по умолчанию
	if  (!$obj->pole_dop[1]) 
		{
			$obj->pole_dop[1]=$obj->dop_sql['id'][0];
			$obj->pole_dop1=$obj->pole_dop[1];
		}
	return $infa;
}
}