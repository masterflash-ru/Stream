<?php
namespace Stream\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Stream\Service\Stream;


/**
фабрика
 */
class StreamFactory implements FactoryInterface
{

public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
		 $connection=$container->get('ADO\Connection');
		 $cache = $container->get('FilesystemCache');
		 $config = $container->get('Config');
        
        return new Stream($connection, $cache,$config);
    }
}

