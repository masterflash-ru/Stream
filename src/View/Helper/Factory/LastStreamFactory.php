<?php
namespace Stream\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Stream\Service\Stream;

/**
 * универсальная фабрика для меню
 * 
 */
class LastStreamFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
	   $StreamLib=$container->get(Stream::class);
        return new $requestedName($StreamLib);
    }
}

