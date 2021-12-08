<?php
namespace Application\Controller\Factory;

use Application\Controller\ApplicationController;
use Application\Form\ApplicationForm;
use Application\Model\ApplicationModel;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ApplicationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $controller = new ApplicationController();
        
        $adapter = $container->get('model-adapter');
        
        $model = new ApplicationModel($adapter);
        $form = $container->get('FormElementManager')->get(ApplicationForm::class);
        
        $controller->setModel($model);
        $controller->setForm($form);
        $controller->setDbAdapter($adapter);
        return $controller;
    }
}