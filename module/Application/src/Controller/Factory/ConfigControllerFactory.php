<?php
namespace Application\Controller\Factory;

use Application\Controller\ConfigController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ConfigControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $controller = new ConfigController();
        $adapter = $container->get('model-adapter');
        $controller->setDbAdapter($adapter);
        return $controller;
    }
}