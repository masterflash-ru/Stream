<?php
namespace Stream\Lib\Func;
use Images\Service\ImagesLib;

class ImgLib
{


public function __invoke($obj,$infa,$struct_arr,$col_number,$pole_dop,$tab_name,$idname,$const,$id,$action)
{
	
	$stream_name=$pole_dop[1];
	$media_info=$obj->config['streams'][$pole_dop[1]]['images_array'];

	$ImgLib=$obj->container->get(ImagesLib::class);

	/*
	*чтение производится по особенному алгоритму, 
	*функция вызывается ОДИН раз для всей колонки!!!, в $id - массив ID таблицы
	*нужно вернуть массив данных! 
	*массив со сквозной нумерацией, номера это номера строк
	*/
	if($action==1)
		{//\Zend\Debug\Debug::dump($id);
			//чтение
			$infa=[];
			foreach ($id as $_id)
				{
					$infa[]=$ImgLib->loadImage($stream_name,$_id,"admin_img");
				}
			return $infa;
		}


	if ($action==2)
		{//запись
			if (!empty($_FILES[$struct_arr["pole_name"][$col_number]."0"]["name"][$id]))
				{
					$ImgLib->setMediaInfo([
											"razdel"=>$stream_name, 			//строка, например, news
											"razdel_id"=>$id,				//ID новости или статьи
											"size_info"=>$media_info		//[ [метод,новая ширина,новая высота] ]
										]);
					$ImgLib->saveImages($infa);
					
					$infa=$ImgLib->loadImage($stream_name,$id,"admin_img");
				}
			return $infa;
		}
	
	if ($action==3)
		{
			//удаление
			$ImgLib->deleteImage($stream_name,$id);
		}


}
}