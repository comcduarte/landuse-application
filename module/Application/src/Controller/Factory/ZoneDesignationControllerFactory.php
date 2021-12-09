<?php
namespace Application\Controller\Factory;

use Application\Controller\ListController;
use Application\Form\ZoneDesignationForm;
use Application\Model\ZoneDesignationModel;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ZoneDesignationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $controller = new ListController();
        
        $adapter = $container->get('model-adapter');
        
        $model = new ZoneDesignationModel($adapter);
        $form = $container->get('FormElementManager')->get(ZoneDesignationForm::class);
        
        $controller->setModel($model);
        $controller->setForm($form);
        $controller->setDbAdapter($adapter);
        return $controller;
    }
}