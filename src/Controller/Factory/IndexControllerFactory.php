<?php
namespace Mf\Stream\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Mf\Stream\Service\Stream;


/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller.
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $connection=$container->get($config["streams"]["config"]["database"]);
        $stream_service = $container->get(Stream::class);
		return new $requestedName($connection,$stream_service);
    }
}