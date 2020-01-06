<?php
namespace Mf\Stream\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Mf\Stream\Service\Stream;

/**
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

