<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Application\Model\ApplicationTypeModel;
use Application\Form\ApplicationTypeForm;
use Application\Controller\ListController;

class ApplicationTypeControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $controller = new ListController();
        
        $adapter = $container->get('model-adapter');
        
        $model = new ApplicationTypeModel($adapter);
        $form = $container->get('FormElementManager')->get(ApplicationTypeForm::class);
        
        $controller->setModel($model);
        $controller->setForm($form);
        $controller->setDbAdapter($adapter);
        return $controller;
    }
}