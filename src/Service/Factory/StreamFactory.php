<?php
namespace Mf\Stream\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
фабрика
 */
class StreamFactory implements FactoryInterface
{

public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
		 $connection=$container->get('DefaultSystemDb');
		 $cache = $container->get('DefaultSystemCache');
		 $config = $container->get('Config');
        
        return new $requestedName($connection, $cache,$config);
    }
}

