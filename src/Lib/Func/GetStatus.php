<?php
namespace Mf\Stream\Lib\Func;

class GetStatus
{


public function __invoke($obj,$infa,$struct_arr,$col_number,$pole_dop,$tab_name,$idname,$const,$id,$action)
{

    $s=$obj->config["streams"]["config"]["status"];
    foreach ($s as $status=>$name) {
        $obj->dop_sql['name'][]=$name;
        $obj->dop_sql['id'][]=$status;
    }
    return $infa;
}
}