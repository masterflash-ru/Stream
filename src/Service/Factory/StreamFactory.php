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
		 $connection=$container->get('ADO\Connection');
		 $cache = $container->get('DefaultSystemCache');
		 $config = $container->get('Config');
        $stream_config_item_default=$config["stream_config_item_default"];
        return new $requestedName($connection, $cache,$config,$stream_config_item_default);
    }
}

