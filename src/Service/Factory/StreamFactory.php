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
		 $connection=$container->get($config["stream"]["database"]);
		 $cache = $container->get($config["stream"]["cache"]);
        
        return new $requestedName($connection, $cache,$config);
    }
}

