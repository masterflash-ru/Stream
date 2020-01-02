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
		 $config = $container->get('Config');
		 $connection=$container->get($config["streams"]["config"]["database"]);
		 $cache = $container->get($config["streams"]["config"]["cache"]);
        
        return new $requestedName($connection, $cache,$config);
    }
}

