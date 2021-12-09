<?php
namespace Application\Controller\Factory;

use Application\Controller\ListController;
use Application\Form\ParcelForm;
use Application\Model\ParcelModel;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ParcelControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $controller = new ListController();
        
        $adapter = $container->get('model-adapter');
        
        $model = new ParcelModel($adapter);
        $form = $container->get('FormElementManager')->get(ParcelForm::class);
        
        $controller->setModel($model);
        $controller->setForm($form);
        $controller->setDbAdapter($adapter);
        return $controller;
    }
}