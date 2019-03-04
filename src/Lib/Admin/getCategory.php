<?php
/**
* для админпанели получение списка категорий
*/
namespace Mf\Stream\Lib\Admin;

use Interop\Container\ContainerInterface;

class getCategory
{
    protected $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
    }
    
    /**
    * собственно сам вызов, возвращает списко категорий
    */
    public function __invoke(array $options=[])
    {
        $config=$this->container->get("config");
        $config=$config['streams']["categories"];
        $rez=[];
        if (is_array($config)){
            foreach ($config as $category=>$v){
                $rez[$category]=$v["description"];
            }
        }
        return $rez;
    }
    
    
}
