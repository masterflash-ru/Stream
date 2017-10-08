<?php
namespace Stream\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Stream\Service\Stream;
use Stream\Controller\IndexController;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller.
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $connection=$container->get('ADO\Connection');
        $config = $container->get('Config');
		$stream_service = $container->get(Stream::class);
		return new IndexController($connection,$stream_service,$config);
    }
}



