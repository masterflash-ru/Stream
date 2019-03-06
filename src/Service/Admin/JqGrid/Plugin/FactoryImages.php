<?php
namespace Mf\Stream\Service\Admin\JqGrid\Plugin;

use Interop\Container\ContainerInterface;
use Mf\Storage\Service\ImagesLib;
/*

*/

class FactoryImages
{

public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
{
	$ImagesLib=$container->get(ImagesLib::class);
    return new $requestedName($ImagesLib);
}
}

